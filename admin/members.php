<?php
session_start();
$pageTittle = 'Members';
// si tu deja faire une inscription redirect to dashbord
if (isset($_SESSION['Username'])){
    include 'init.php';
    $do = isset($_GET['do']) ? $_GET['do'] :'Manage';

    if ($do == 'Manage'){ //manage members page

        // pour les Mmebres No active

        $query = '';

        if (isset($_GET['page'])&& $_GET['page'] == 'Pending'){
            

            $query = 'AND RegStatus = 0';
        }

        // ajouter les membre qui groupeid egale pas 1
    
        $stmt =$db->prepare("SELECT * FROM user WHERE GroupID != 1 $query");

        $stmt->execute();

        $rows = $stmt->fetchAll();
    
    
    ?>

<h1 class="text-center">Manage Members</h1>
    <div class="container">
        <div class="table-responsive">
            <table class="main-table text-center table table-bordered">
                <tr>
                    <td>#ID</td>
                    <td>Username</td>
                    <td>Email</td>
                    <td>Full Name</td>
                    <td>Registerd Dtae</td>
                    <td>Control</td>
                </tr>

                <?php 
                foreach($rows as $row){
                    echo "<tr>";
                    echo "<td>" .$row['UserID'] ."</td>";
                       echo "<td>" .$row['Username'] ."</td>";
                       echo "<td>" .$row['Email'] ."</td>";
                       echo "<td>" .$row['FullName'] ."</td>";
                       echo "<td>" .$row['Date'] ."</td>";
                       echo "<td>
                       <a href='members.php?do=Edit&userid=" . $row['UserID'] . "' class='btn btn-success'> <i class='fa fa-edit'></i>Edit</a>
                       <a href='members.php?do=Delete&userid=" . $row['UserID'] . "'class='btn btn-danger confirm '> <i class='fa fa-close'></i>Delete</a>";
                       if($row['RegStatus'] == 0){

                     echo " <a href='members.php?do=Activate&userid=" . $row['UserID'] . "'class='btn btn-info '> <i class='fa fa-check'></i>Activate</a>";

                       }
                     echo "</td>";

                    echo "</tr>";
                }
                ?>
                <tr>
             
                
            </table>
        </div>
       <a href="members.php?do=Add" class=" btn btn-primary"><i class="fa fa-plus"></i>Add New Members</a>
       

   <?php } elseif ($do == 'Add') {  //Add Members Page ?>

        <h1 class="text-center">Add New Membersr</h1>

        <div class="container">
            <form class="form-horizontal" action="?do=Insert" method="POST">
                <div class="form-group form-groupe-lg">
                    <label class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10 col-md-10">
                        <input type="text" name="username" class="form-control"  required="required"/>
                    </div>
                </div>
    
                
                <div class="form-group form-groupe-lg">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10 col-md-10">
                        <input type="password" name="Possword"  class="form-control"  required="required"/>
    
                    </div>
                </div>
            
    
                <div class="form-group form-groupe-lg">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10 col-md-10">
                        <input type="text" name="email" class="form-control"  required="required"/>
                    </div>
                </div>
    
                <div class="form-group form-groupe-lg">
                    <label class="col-sm-2 control-label">Full Name</label>
                    <div class="col-sm-10 col-md-10">
                        <input type="text" name="full" class="form-control"  required="required"/>
                    </div>
                </div>
    
                <div class="form-group form-groupe-lg">
                    <div class=" col-sm-offset-2 col-sm-10 ">
                        <input type="submit" value="Add Members" class="btn btn-primary"/>
                    </div>
                </div>
    
            </form>
        
        </div>

                <?php
    } elseif ($do == 'Insert') {

        
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            echo   "<h1 class='text-center'>Insert Member</h1>";
            echo   "<div class='container'>";
            
        
    
            $user   =$_POST['username'];
            $pass   =sha1($_POST['Possword']);
            $email  =$_POST['email'];
            $name   =$_POST['full'];
        
    
            // $hashPass = sha1($_POST['possword']);
        
            // valadate the Form
            
            $formErrors = array();
            if (strlen($user) < 4) {
            
                $formErrors[] = 'user cant be lass than 4 characters';
            }
            if (strlen($name) < 4) {
            
                $formErrors[] = 'username cant be lass than 10 characters';
            }
            if (strlen($email) < 10) {
            
                $formErrors[] = 'email cant be lass than 4 characters';
            }
        
            // vérifer les erreurs
            foreach($formErrors as $error){
            
                echo'<div class=" alert alert-danger ">' .  $error . '</div>';
            }
        
            //  check si il'ya no erreur fait les modification
            
            if (empty($formErrors)){



                    // check if User exist in Database

                $check = checkItem("Username", "user",   $user);

                if($check == 1) {

                    echo "<div class='container'>";

                    $theMsg = ' <div class = "alert alert-danger">sorry this user is Exist</div>';
         
                     redirectHome($theMsg, 'back');


                } else {
            
                //UPDATE Dant DataBase
                
                // $stmt =$db->prepare("INSERT INTO user SET Username = ?, Email = ?, FullName = ?, Possword = ?");
                // $stmt->execute(array($user, $email, $name, $pass));
                
                        $stmt =$db->prepare("INSERT INTO user (Username, Possword, Email,  FullName, RegStatus, Date)VALUES(:zuser, :zpass, :zmail, :zname, 1, now())");
                        $stmt->execute(array(

                            'zuser' => $user,
                            'zpass' => $pass,
                            'zmail' => $email,
                            'zname' => $name


                        ));
                        
                        //Echo Seccess Message
                        
                        
                      $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted</div>';
                    
                        redirectHome($theMsg, 'back', 3);

                    }     
            
                }

        
        }else {

            echo "<div class ='container'>";
        
           $theMsg ='<div class=" alert alert-danger">Sorry you cant browse this Page Directly  </div>';
         
            redirectHome($theMsg, 'back');

            echo "</div>";
        }
        
        echo "</div>"; 

    } elseif ($do == 'Edit') {    //Edite Page 

            // il y'a un nomber afficher si non afficher false
            $userid =  isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']):0;

            // select id from data pour afficher

            $stmt = $db->prepare("SELECT * FROM user WHERE UserID = ?  LIMIT  1");

            // l'execution

            $stmt->execute(array($userid));

            // fetch dans Data

            $row = $stmt ->fetch();

            //  su il y'a un changment ou nn 

            $count = $stmt->rowCount();

            // il y'a un value dans database > 0 afficher

        if($stmt->rowCount() > 0){ ?>

            <h1 class="text-center">Edit Member</h1>

            <div class="container">
                <form class="form-horizontal" action="?do=Update" method="POST">
                    <input type="hidden" name="userid" value=" <?php  echo  $userid ?>"/>
                    <div class="form-group form-groupe-lg">
                        <label class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10 col-md-10">
                            <input type="text" name="username" class="form-control" value="<?php echo $row['Username']?>" required="required"/>
                        </div>
                    </div>

                    
                    <div class="form-group form-groupe-lg">
                        <label class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10 col-md-10">
                            <input type="hidden" name="oldpossword"  class="form-control" value="<?php echo $row['possword']?>" required="required"/>
                            <input type="password" name="newpossword" class="form-control" />
                        </div>
                    </div>
                    

                    <div class="form-group form-groupe-lg">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10 col-md-10">
                            <input type="text" name="email" class="form-control" value="<?php echo $row['Email']?>" required="required"/>
                        </div>
                    </div>

                    <div class="form-group form-groupe-lg">
                        <label class="col-sm-2 control-label">Full Name</label>
                        <div class="col-sm-10 col-md-10">
                            <input type="text" name="full" class="form-control" value="<?php echo $row['FullName']?>" required="required"/>
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

            echo   "<h1 class='text-center'>Update Member</h1>";
            echo   "<div class='container'>";


            

            if ($_SERVER['REQUEST_METHOD'] == 'POST'){

                $id    =$_POST['userid'];
                $user   =$_POST['username'];
                $email  =$_POST['email'];
                $name   =$_POST['full'];

                //password trick
                $pass= '';
                //   si aucun password fait un nauveau password
                if (empty($_POST['newpossword'])){

                    // si non fait le dernnier

                $pass = $_POST['oldpossword'];

                } else {

                    //  sh1 pour new password

                    $pass = sha1($_POST['newpossword']);
                }

                // valadate the Form

                $formErrors = array();
                // if (strlen($user) < 4) {

                //     $formErrors[] = 'user cant be lass than 4 characters';
                // }
                // if (strlen($name) < 4) {

                //     $formErrors[] = 'username cant be lass than 10 characters';
                // }
                // if (strlen($email) < 10) {

                //     $formErrors[] = 'email cant be lass than 4 characters';
                // }

                // vérifer les erreurs
                foreach($formErrors as $error){

                    echo'<div class=" alert alert-danger ">' .  $error . '</div>';

                }

                //  check si il'ya no erreur fait les modification

                if (empty($formErrors)){


                    //UPDATE Dant DataBase

                    $stmt =$db->prepare("UPDATE user SET Username = ?, Email = ?, FullName = ?, Possword = ? WHERE UserID = ?");
                    $stmt->execute(array($user, $email, $name, $pass, $id));
                    

                    //Echo Seccess Message


                $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';

                    // redirectHome($theMsg, 'back', 4);
                    redirectHome($theMsg, 'back');

            }

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


        echo   "<h1 class='text-center'>Delete Member</h1>";
        echo   "<div class='container'>";
        // il y'a un nomber afficher si non afficher false

        $userid =  isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']):0;

        // select id from data pour afficher

        $stmt = $db->prepare("SELECT * FROM user WHERE UserID = ?  LIMIT  1");

        // l'execution

        $stmt->execute(array($userid));


        //  su il y'a un changment ou nn 

        $count = $stmt->rowCount();

        // il y'a un value dans database > 0 afficher

    if($stmt->rowCount() > 0){ 

        $stmt =$db->prepare("DELETE FROM user WHERE USERID = :zuser");

        $stmt->bindParam(":zuser",  $userid);

        $stmt->execute();

        $theMsg =  "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted</div>';

        redirectHome($theMsg);


    } else {

        // echo 'Not Exist';
        echo "<div class='container'>";

        $theMsg = ' <div class= "alert alert-danger"> Sorry  This ID Not Exist</div>';

         redirectHome($theMsg);

         echo "</div>";
    }

        echo'</div>';




        } elseif ($do == 'Activate'){

            
        echo   "<h1 class='text-center'>Activat Member</h1>";
        echo   "<div class='container'>";
        // il y'a un nomber afficher si non afficher false

        $userid =  isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']):0;

        $check = checkItem('userid', 'user',$userid);

        if($check > 0){
            $stmt = $db->prepare(" UPDATE user SET RegStatus = 1 WHERE UserID = ?");

            $stmt->execute(array($userid));

            $count = $stmt->rowCount();
    

        
            $theMsg =  "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Activated</div>';

            redirectHome($theMsg);
      


        

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
