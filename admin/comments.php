<?php
session_start();
$pageTittle = 'commnets';
// si tu deja faire une inscription redirect to dashbord
if (isset($_SESSION['Username'])){
    include 'init.php';
    $do = isset($_GET['do']) ? $_GET['do'] :'Manage';

    if ($do == 'Manage'){ //manage members page

        // pour les Mmebres No active

    

        // ajouter les membre qui groupeid egale pas 1
    
        $stmt =$db->prepare("SELECT
                                  comments.* , items.Name AS Item_Name, user.Username AS Member
                            FROM
                                comments
                            INNER JOIN
                                items
                            ON
                                items.item_ID = comments.item_id
                            INNER JOIN
                                user
                            ON
                                user.UserID = comments.user_id");

        $stmt->execute();

        $rows = $stmt->fetchAll();
    
    
    ?>

<h1 class="text-center">Manage Comments</h1>
    <div class="container">
        <div class="table-responsive">
            <table class="main-table text-center table table-bordered">
                <tr>
                    <td>ID</td>
                    <td>Comment</td>
                    <td>Item Name</td>
                    <td>User Name</td>
                    <td>Added Dtae</td>
                    <td>Control</td>
                </tr>

                <?php 
                foreach($rows as $row){
                    echo "<tr>";
                    echo "<td>" .$row['c_id'] ."</td>";
                       echo "<td>" .$row['comment'] ."</td>";
                       echo "<td>" .$row['Item_Name'] ."</td>";
                       echo "<td>" .$row['Member'] ."</td>";
                       echo "<td>" .$row['comment_date'] ."</td>";
                       echo "<td>
                       <a href='comments.php?do=Edit&comid=" . $row['c_id'] . "' class='btn btn-success'> <i class='fa fa-edit'></i>Edit</a>
                       <a href='comments.php?do=Delete&comid=" . $row['c_id'] . "'class='btn btn-danger confirm '> <i class='fa fa-close'></i>Delete</a>";
                       if($row['status'] == 0){

                     echo " <a href='comments.php?do=Approve&comid=" . $row['c_id'] . "'class='btn btn-info '> <i class='fa fa-check'></i>Approve</a>";

                       }
                     echo "</td>";

                    echo "</tr>";
                }
                ?>
                <tr>
            </table>
        </div>
        <?php
       
    } elseif ($do == 'Edit') {    //Edite Page 

            // il y'a un nomber afficher si non afficher false
            $comid =  isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']):0;

            // select id from data pour afficher

            $stmt = $db->prepare("SELECT * FROM comments WHERE c_id = ? ");

            // l'execution

            $stmt->execute(array($comid));

            // fetch dans Data

            $row = $stmt ->fetch();

            //  su il y'a un changment ou nn 

            $count = $stmt->rowCount();

            // il y'a un value dans database > 0 afficher

        if($stmt->rowCount() > 0){ ?>

            <h1 class="text-center">Edit Comment</h1>

            <div class="container">
                <form class="form-horizontal" action="?do=Update" method="POST">
                    <input type="hidden" name="comid" value=" <?php  echo  $comid ?>"/>
                    <div class="form-group form-groupe-lg">
                        <label class="col-sm-2 control-label">Comment</label>
                        <div class="col-sm-10 col-md-10">
                        <textarea class="form-control" name="comment"><?php echo $row['comment']?></textarea>
                    </div>
                    </div>

          
                    <div class="form-group form-groupe-lg">
                        <div class=" col-sm-offset-2 col-sm-10 ">
                            <input type="submit" value="save" class="btn btn-primary"/>
                        </div>
                    </div>
                </form>

            </div>


        <?php
        } else {
             
            echo "<div class='container'>";

           $theMsg = ' <div class= "alert alert-danger">thers No Such ID </div>';

            redirectHome($theMsg);

            echo "</div>";

        }
        
    } elseif ($do == 'Update'){//Update Page

            echo   "<h1 class='text-center'>Update Comment</h1>";
            echo   "<div class='container'>";


            

            if ($_SERVER['REQUEST_METHOD'] == 'POST'){

                $comid    =$_POST['comid'];
                $comment   =$_POST['comment'];
               

             

              

             


                    //UPDATE Dant DataBase

                    $stmt =$db->prepare("UPDATE comments SET comment = ?  WHERE c_id = ?");
                    $stmt->execute(array($comment, $comid));
                    

                    //Echo Seccess Message


                $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';

                    // redirectHome($theMsg, 'back', 4);
                    redirectHome($theMsg, 'back');

            

        }else {

            // $errorMsg ='Sorry';

            echo "<div class='container'>";

            $theMsg = ' <div class= "alert alert-danger"> Sorry You Cant Browse This Page Directly</div>';
 
             redirectHome($theMsg);
 
             echo "</div>";
 

            // redirectHome("$errorMsg");
        }

        echo "</div>";


    
    } elseif ($do == 'Delete'){ //Delete Member Page


        echo   "<h1 class='text-center'>Delete Comment</h1>";
        echo   "<div class='container'>";
        // il y'a un nomber afficher si non afficher false

        $comid =  isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']):0;

        $check = checkItem ('c_id', 'comments' , $comid);

    if($check > 0){ 

        $stmt = $db->prepare("DELETE FROM comments WHERE c_id = :zid");

        $stmt->bindParam(":zid",  $comid);

        $stmt->execute();

        $theMsg =  "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted</div>';

        redirectHome($theMsg, 'back');


    } else {

        // echo 'Not Exist';
        echo "<div class='container'>";

        $theMsg = ' <div class= "alert alert-danger"> Sorry  This ID Not Exist</div>';

         redirectHome($theMsg);

         echo "</div>";
    }

        echo'</div>';




        } elseif ($do == 'Approve'){

            
        echo   "<h1 class='text-center'>Approve Comment</h1>";
        echo   "<div class='container'>";
        // il y'a un nomber afficher si non afficher false

        $comid =  isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']):0;

        $check = checkItem('c_id', 'comments',$comid);

        if($check > 0){
            $stmt = $db->prepare(" UPDATE comments SET status = 1 WHERE c_id = ?");

            $stmt->execute(array($comid));

            $count = $stmt->rowCount();
    

        
            $theMsg =  "<div class='alert alert-success'>" . $stmt->rowCount() . ' Comment Approve</div>';

            redirectHome($theMsg,'back');
      


        

    } else {

        // echo 'Not Exist';
        echo "<div class='container'>";

        $theMsg = ' <div class= "alert alert-danger"> Sorry  This ID Not Exist</div>';

         redirectHome($theMsg);

         echo "</div>";
    }
        }

        include $tpl . 'footer.php';

} else {
 
        header('Location: index.php');
        exit();
}
