<?php 

session_start();

$pageTitle = 'Categorie';

    if (isset($_SESSION['Username'])){


        include 'init.php';

        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

        if($do == 'Manage'){


         $stmt2 = $db->prepare("SELECT * FROM categorie");

         $stmt2->execute();

         $cats = $stmt2->fetchAll(); ?>

         <h1 class="text-center">Manage Categorie</h1>
         <div class="container categorie">
            <div class="card card-default">
                <h4 class="card-header">Manage Categorie</h4>
                <div class="card-body">
                    <?php 
                        foreach($cats as $cat){
                            echo "<div class='cat'>";
                            echo "<div class='hidden-buttons'>";
                            echo "<a  href='categorie.php?do=Edit&catid=" . $cat['ID'] . "' class='btn btn-xs btn-edit' data-toggle='tooltip' data-placement='top' title='Edit'><i class='fa fa-edit'></i></a>";
                            echo "<a  href='categorie.php?do=Delete&catid=" .$cat['ID'] . "' class='confirm btn btn-xs btn-delete' data-toggle='tooltip' data-placement='top' title='Delete'><i class='fa fa-close'></i></a>";

                            echo "</div>";
                                echo "<h3>"  .$cat['Name'] . '</h3>';
                                echo "<p>" ;if ($cat['Description'] == ''){ echo 'This is Category Has no Description';} else { echo $cat['Description'] ;} echo "</p>";
                                // echo'Orderng is' . $cat['Ordering'] . '<br />';
                                if($cat['Visibility'] == 1) {echo '<span class="visibility">Hidden</span>';}
                                if($cat['Allow_Comment'] == 1) {echo '<span class="commenting">Comment Disable</span>';}
                                if($cat['Allow_Ads'] == 1) {echo '<span class="ads">Ads Disable</span>';}

                            echo "</div>";
                        }
                        ?>

                </div>
            </div>
                    <a class="btn btn-add" href="categorie.php?do=Add"><i class="fa fa-plus"></i>Add New Categorie</a>
         </div>

         <?php

        } elseif ($do == 'Add'){ ?>

<h1 class="text-center">Add New Categorie </h1>

<div class="container">
    <form class="form-horizontal" action="?do=Insert" method="POST">
        <div class="form-group form-groupe-lg">
            <label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10 col-md-10">
                <input type="text" name="name" class="form-control"  required="required"/>
            </div>
        </div>

        
        <div class="form-group form-groupe-lg">
            <label class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10 col-md-10">
                <input type="text" name="description"  class="form-control"  />

            </div>
        </div>
    

        <div class="form-group form-groupe-lg">
            <label class="col-sm-2 control-label">Ordering</label>
            <div class="col-sm-10 col-md-10">
                <input type="text" name="ordering" class="form-control" />
            </div>
        </div>

        <div class="form-group form-groupe-lg">
            <label class="col-sm-2 control-label">Visible</label>
            <div class="col-sm-10 col-md-10">
                <div>
                    <input id ="vis-yes" type="radio" name="visibility" value="0" checked />
                    <label for ="vis-yes">Yes</label>

                </div>
                <div>
                    <input id ="vis-no" type="radio" name="visibility" value="1"  />
                    <label for ="vis-no">No</label>

                </div>

        </div>
        </div>

        <div class="form-group form-groupe-lg">
            <label class="col-sm-2 control-label">Allow Commenting</label>
            <div class="col-sm-10 col-md-10">
                <div>
                    <input id ="com-yes" type="radio" name="commenting" value="0" checked />
                    <label for ="com-yes">Yes</label>

                </div>
                <div>
                    <input id ="com-no" type="radio" name="commenting" value="1"  />
                    <label for ="com-no">No</label>

                </div>

        </div>
        </div>
        <div class="form-group form-groupe-lg">
            <label class="col-sm-2 control-label">Allow Ads</label>
            <div class="col-sm-10 col-md-10">
                <div>
                    <input id ="vis-yes" type="radio" name="ads" value="0" checked />
                    <label for ="vis-yes">Yes</label>

                </div>
                <div>
                    <input id ="ads-no" type="radio" name="ads" value="1"  />
                    <label for ="ads-no">No</label>

                </div>

        </div>
        </div>

        <div class="form-group form-groupe-lg">
            <div class=" col-sm-offset-2 col-sm-10 ">
                <input type="submit" value="Add categorie" class="btn btn-primary"/>
            </div>
        </div>

    </form>

</div>




                <?php

        } elseif ($do == 'Insert') {

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            echo   "<h1 class='text-center'>Insert Categorie</h1>";
            echo   "<div class='container'>";
            
    
            $name       =$_POST['name'];
            $desc       =$_POST['description'];
            $order      =$_POST['ordering'];
            $visible    =$_POST['visibility'];
            $comment    =$_POST['commenting'];
            $ads        =$_POST['ads'];
        
    
                    // check if User exist in Database

                $check = checkItem("Name", "categorie",   $name);

                if($check == 1) {

                    echo "<div class='container'>";

                    $theMsg = ' <div class = "alert alert-danger">sorry this Categorie is Exist</div>';
         
                     redirectHome($theMsg, 'back');


                } else {
            
                //UPDATE Dans DataBase
                
                
                        $stmt =$db->prepare("INSERT INTO categorie (Name, Description, Ordering, Visibility, Allow_Comment, Allow_Ads)VALUES(:zname, :zdesc, :zorder, :zvisible, :zcomment, :zads)");
                        $stmt->execute(array(

                            'zname' => $name,
                            'zdesc' => $desc,
                            'zorder' => $order,
                            'zvisible' => $visible,
                            'zcomment' => $comment,
                            'zads' => $ads


                        ));
                        
                        //Echo Seccess Message
                        
                        
                      $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted</div>';
                    
                        redirectHome($theMsg, 'back', 3);

                    }     
          

        
        }else {

            echo "<div class ='container'>";
        
           $theMsg ='<div class=" alert alert-danger">Sorry you cant browse this Page Directly  </div>';
         
            redirectHome($theMsg, 'back');

            echo "</div>";
        }
        
        echo "</div>"; 

        } elseif ($do == 'Edit'){

            
            // il y'a un nomber afficher si non afficher false
            $catid =  isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']):0;

            // select id from data pour afficher

            $stmt = $db->prepare("SELECT * FROM categorie WHERE ID = ? ");

            // l'execution

            $stmt->execute(array($catid));

            // fetch dans Data

            $cat = $stmt ->fetch();

            //  su il y'a un changment ou nn 

            $count = $stmt->rowCount();

            // il y'a un value dans database > 0 afficher

        if($stmt->rowCount() > 0){  ?>



         
<h1 class="text-center">Edit Categorie </h1>

<div class="container">
    <form class="form-horizontal" action="?do=Update" method="POST">
    <input type="hidden" name="catid" value=" <?php  echo  $catid ?>"/>

        <div class="form-group form-groupe-lg">
            <label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10 col-md-10">
                <input type="text" name="name" class="form-control"  required="required"  value="<?php echo $cat['Name']?>"/>
            </div>
        </div>

        
        <div class="form-group form-groupe-lg">
            <label class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10 col-md-10">
                <input type="text" name="description"  class="form-control" value="<?php echo $cat['Description']?> " />

            </div>
        </div>
    

        <div class="form-group form-groupe-lg">
            <label class="col-sm-2 control-label">Ordering</label>
            <div class="col-sm-10 col-md-10">
                <input type="text" name="ordering" class="form-control"  value="<?php echo $cat['Ordering']?>"/>
            </div>
        </div>

        <div class="form-group form-groupe-lg">
            <label class="col-sm-2 control-label">Visible</label>
            <div class="col-sm-10 col-md-10">
                <div>
                    <input id ="vis-yes" type="radio" name="visibility"  value="0" <?php  if($cat['Visibility'] == 0 ) { echo 'checked';}?> />
                    <label for ="vis-yes">Yes</label>

                </div>
                <div>
                    <input id ="vis-no" type="radio" name="visibility" value="1"  <?php  if($cat['Visibility'] == 0 ) { echo 'checked';}?>/>
                    <label for ="vis-no">No</label>

                </div>

        </div>
        </div>

        <div class="form-group form-groupe-lg">
            <label class="col-sm-2 control-label">Allow Commenting</label>
            <div class="col-sm-10 col-md-10">
                <div>
                    <input id ="com-yes" type="radio" name="commenting" value="0"  <?php  if($cat['Allow_Comment'] == 0 ) { echo 'checked';}?>/>
                    <label for ="com-yes">Yes</label>

                </div>
                <div>
                    <input id ="com-no" type="radio" name="commenting" value="1" <?php  if($cat['Allow_Comment'] == 1 ) { echo 'checked';}?>/>
                    <label for ="com-no">No</label>

                </div>

        </div>
        </div>
        <div class="form-group form-groupe-lg">
            <label class="col-sm-2 control-label">Allow Ads</label>
            <div class="col-sm-10 col-md-10">
                <div>
                    <input id ="vis-yes" type="radio" name="ads" value="0"  <?php  if($cat['Allow_Ads'] == 0 ) { echo 'checked';}?>/>
                    <label for ="vis-yes">Yes</label>

                </div>
                <div>
                    <input id ="ads-no" type="radio" name="ads" value="1"   <?php  if($cat['Allow_Ads'] == 1 ) { echo 'checked';}?> />
                    <label for ="ads-no">No</label>

                </div>

        </div>
        </div>

        <div class="form-group form-groupe-lg">
            <div class=" col-sm-offset-2 col-sm-10 ">
                <input type="submit" value="Add categorie" class="btn btn-primary"/>
            </div>
        </div>

    </form>

        <?php
        } else {
             
            echo "<div class='container'>";

           $theMsg = ' <div class= "alert alert-danger">thers No Such ID </div>';

            redirectHome($theMsg);

            echo "</div>";

        }


        } elseif ($do == 'Update') {

            echo   "<h1 class='text-center'>Update Member</h1>";
            echo   "<div class='container'>";


            

            if ($_SERVER['REQUEST_METHOD'] == 'POST'){

                $id    =$_POST['catid'];
                $name   =$_POST['name'];
                $desc  =$_POST['description'];
                $order   =$_POST['ordering'];

                $visible    =$_POST['visibility'];
                $comment   =$_POST['commenting'];
                $ads   =$_POST['ads'];
              

                //  check si il'ya no erreur fait les modification

        

                    //UPDATE Dant DataBase

                    $stmt =$db->prepare("UPDATE categorie 
                                        SET 
                                        Name = ?, 
                                        Description = ?, 
                                        Ordering = ?, 
                                        Visibility = ?, 
                                        Allow_Comment = ?, 
                                        Allow_Ads = ? 
                                     WHERE 
                                        ID = ?");
                    $stmt->execute(array(  $name, $desc, $order, $visible, $comment, $ads, $id));
                    
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


        } elseif ($do == 'Delete'){

            
        echo   "<h1 class='text-center'>Delete Member</h1>";
        echo   "<div class='container'>";
        // il y'a un nomber afficher si non afficher false

        $catid =  isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']):0;

        $check = checkItem('ID', 'categorie', $catid);

       
      


    if($check > 0){ 

        $stmt =$db->prepare("DELETE FROM categorie WHERE ID = :zid");

        $stmt->bindParam(":zid",  $catid);

        $stmt->execute();

        $theMsg =  "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted</div>';

        redirectHome($theMsg,'back');


    } else {

        // echo 'Not Exist';
        echo "<div class='container'>";

        $theMsg = ' <div class= "alert alert-danger"> Sorry  This ID Not Exist</div>';

         redirectHome($theMsg);

         echo "</div>";
    }

        echo'</div>';


        }

        include $tpl . 'footer.php';

    } else {

        header ('Location : index.php');

        exit();
    }






?>