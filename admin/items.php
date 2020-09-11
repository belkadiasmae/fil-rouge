
<?php

session_start();

$pageTitle ='Items';

if (isset($_SESSION['Username'])){

    include 'init.php';
    $do = isset($_GET['do']) ? $_GET['do'] :'Manage';

    if ($do == 'Manage'){ //manage members page

     

        // ajouter les membre qui groupeid egale pas 1
    
        $stmt =$db->prepare("SELECT 

                                items.* ,
                             categorie.Name AS categorie_name,
                             user.Username AS item_user 
                            FROM 
                                items

                            INNER JOIN 
                                categorie 
                            ON categorie.ID = items.Cat_ID


                            INNER JOIN 

                                 user 
                            ON user.UserID = items.Member_ID             ");

        $stmt->execute();

        $items = $stmt->fetchAll();
    
    
    ?>

<h1 class="text-center">Manage Items</h1>
    <div class="container">
        <div class="table-responsive">
            <table class="main-table text-center table table-bordered">
                <tr>
                    <td>#ID</td>
                    <td>Name</td>
                    <td>Description</td>
                    <td>Price</td>
                    <td>Adding Date</td>
                    <td>categorie</td>
                    <td>Username</td>
                    <td>Control</td>
                </tr>

                <?php 
                foreach($items as $item){
                    echo "<tr>";
                    echo "<td>" .$item['item_ID'] ."</td>";
                       echo "<td>" .$item['Name'] ."</td>";
                       echo "<td>" .$item['Description'] ."</td>";
                       echo "<td>" .$item['Price'] ."</td>";
                       echo "<td>" .$item['Add_Date'] ."</td>";
                       echo "<td>" .$item['categorie_name'] ."</td>";
                       echo "<td>" .$item['item_user'] ."</td>";
                       echo "<td>
                       <a href='items.php?do=Edit&itemid=" . $item['item_ID'] . "' class='btn btn-success'> <i class='fa fa-edit'></i>Edit</a>
                       <a href='items.php?do=Delete&itemid=" . $item['item_ID'] . "'class='btn btn-danger confirm '> <i class='fa fa-close'></i>Delete</a>";
                       if($item['Approve'] == 0){
                                 echo " <a href='items.php?do=Approve&itemid=" . $item['item_ID'] . "'class='btn btn-info '> <i class='fa fa-check'></i>Approve</a>";
   
                          }
                     echo "</td>";

                    echo "</tr>";
                }
                ?>
                <tr>
             
                
            </table>
        </div>
       <a href="items.php?do=Add" class=" btn btn-primary"><i class="fa fa-plus"></i> New Item</a>

            </div>
            <?php
    }

elseif ($do == 'Add'){ ?>

    <h1 class="text-center">Add New Item </h1>
    
    <div class="container">
        <form class="form-horizontal" action="?do=Insert" method="POST" enctype='multipart/form-data'>
            <div class="form-group form-groupe-lg">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10 col-md-10">
                    <input type="text" name="name" class="form-control"  />
                </div>
            </div>
            <div class="form-group form-groupe-lg">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10 col-md-10">
                    <input type="text" name="description" class="form-control"  />
                </div>
            </div>
            <div class="form-group form-groupe-lg">
                <label class="col-sm-2 control-label">Price</label>
                <div class="col-sm-10 col-md-10">
                    <input type="text" name="price" class="form-control" />
                </div>
            </div>
            <!-- <div class="form-group form-groupe-lg">
                <label class="col-sm-2 control-label">Add_Date</label>
                <div class="col-sm-10 col-md-10">
                    <input type="text" name="date" class="form-control"  required="required"/>
                </div>
            </div> -->
            <div class="form-group form-groupe-lg">
                <label class="col-sm-2 control-label">country</label>
                <div class="col-sm-10 col-md-10">
                    <input type="text" name="country" class="form-control" />
                </div>
            </div>
            <div class="form-group form-groupe-lg">
                <label class="col-sm-2 control-label">Image</label>
                <div class="col-sm-10 col-md-10">
                    <input type="file" name="image" class="form-control"  required="required"/>
                </div>
            </div>
        



            <div class="form-group form-groupe-lg">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10 col-md-10">
                    <select class="form-control" name="status" > 
                        <option value="0">...</option>   
                        <option value="1">New</option>  
                        <option value="2">Like New</option>  
                        <option value="3">Used</option> 
                        <option value="4">Very Old</option>  
                    </select>         

                </div>
            </div>


            <div class="form-group form-groupe-lg">
                <label class="col-sm-2 control-label">Member</label>
                <div class="col-sm-10 col-md-10">
                    <select class="form-control" name="member" > 
                        <option value="0">...</option>   
                        <?php 
                            $stmt =$db->prepare("SELECT * FROM User");
                            $stmt->execute();
                            $user =$stmt->fetchAll();

                                foreach ($user as $user) {

                                    echo "<option value='" . $user['UserID'] . "'>" . $user['Username'] . "</option>";
                                }
                            

                        ?>
                    </select>
                </div>
            </div>

           


            <div class="form-group form-groupe-lg">
                <label class="col-sm-2 control-label">categorie</label>
                <div class="col-sm-10 col-md-10">
                    <select class="form-control" name="categorie" > 
                        <option value="0">...</option>   
                        <?php 
                            $stmt2 =$db->prepare("SELECT * FROM categorie");
                            $stmt2->execute();
                            $cats =$stmt2->fetchAll();

                                foreach ($cats as $cat) {

                                    echo "<option value='" . $cat['ID'] . "'>" . $cat['Name'] . "</option>";
                                }
                            

                        ?>
                </select>
                </div>
            </div> 
         
            <div class="form-group form-groupe-lg">
                <div class=" col-sm-offset-2 col-sm-10 ">
                    <input type="submit" value="Add item" class="btn btn-primary"/>
                </div>
            </div>
    
        </form>
    
    </div>
    
    
    
    
                    <?php

    }

    elseif ($do == 'Insert'){ 

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            echo   "<h1 class='text-center'>Insert Item</h1>";
            echo   "<div class='container'>";
    
            $name  =$_POST['name'];
            $desc   =$_POST['description'];
            $price  =$_POST['price'];
            $country   =$_POST['country'];
            $status   =$_POST['status'];
            $member  =$_POST['member'];
            $cat   =$_POST['categorie'];
            $image = $_FILES['image']['name'];
            $target_dir = "upload/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $extensions_arr = array("jpg","jpeg","png","gif");

            // $hashPass = sha1($_POST['possword']);
        
            // valadate the Form
            
            $formErrors = array();


            if (empty($name)) {
                $formErrors[] = 'Name can\'t be <strong>Empty</strong>';
            }

            if (empty($desc)) {
            
                $formErrors[] = 'Description can\'t be <strong>Empty</strong>';
            }
            if (empty($price)) {
            
                $formErrors[] = 'Price can\'t be <strong>Empty</strong>';
            }
            if (empty($country)) {
            
                $formErrors[] = 'Country can\'t be <strong>Empty</strong>';
            }
            if ($status == 0) {
            
                $formErrors[] = 'You Must choose the<strong>Status</strong>';
            }
            if ($member == 0) {
            
                $formErrors[] = 'You Must choose the <strong> Member</strong>';
            }
            if ($cat == 0) {
            
                $formErrors[] = 'You Must choose the <strong>Categorie </strong>';
            }
        
            if( !in_array($imageFileType,$extensions_arr) ){

                $formErrors[] = 'You Must choose A valid <strong>Image </strong>';

            }
            // vérifer les erreurs
            foreach($formErrors as $error){
            
                echo'<div class=" alert alert-danger ">' .  $error . '</div>';
            }
        
            //  check si il'ya no erreur fait les modification
            
            if (empty($formErrors)) {
                $stmt =$db->prepare("INSERT INTO items (Name, Description, Price, Country_Made, Status, Add_Date, Cat_ID, Member_ID, Image) VALUES(:zname, :zdesc, :zprice, :zcountry, :zstatus, now(), :zcat, :zmember, :zimage)");
                $stmt->execute(array(
                    'zname' => $name,
                    'zdesc' => $desc,
                    'zprice' => $price,
                    'zcountry' => $country,
                    'zstatus' => $status,
                    'zcat' => $cat,
                    'zmember' => $member,
                    'zimage' => $image
                ));
                move_uploaded_file($_FILES['image']['tmp_name'],$target_dir.$image);
                
                //Echo Seccess Message
                
                $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted</div>';
                redirectHome($theMsg, 'back', 3);        
            }

        
        }else {

            echo "<div class ='container'>";
        
           $theMsg ='<div class=" alert alert-danger">Sorry you cant browse this Page Directly  </div>';
         
            redirectHome($theMsg);

            echo "</div>";
        }
        
        echo "</div>"; 

    }

    elseif ($do == 'Edit'){ 

            $itemid =  isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']):0;

            // select id from data pour afficher

            $stmt = $db->prepare("SELECT * FROM items WHERE item_ID = ?");

            // l'execution

            $stmt->execute(array($itemid));

            // fetch dans Data

            $item = $stmt ->fetch();

            //  su il y'a un changment ou nn 

            $count = $stmt->rowCount();

            // il y'a un value dans database > 0 afficher

        if($stmt->rowCount() > 0){ ?>

    <h1 class="text-center">Edit Item </h1>
        
        <div class="container">
            <form class="form-horizontal" action="?do=Update" method="POST">
            <input type="hidden" name="itemid" value=" <?php  echo  $itemid ?>"/>

                <div class="form-group form-groupe-lg">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10 col-md-10">
                        <input type="text" name="name" class="form-control" value="<?php echo $item['Name'] ?>"  />
                    </div>
                </div>
                <div class="form-group form-groupe-lg">
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10 col-md-10">
                        <input type="text" name="description" class="form-control" value="<?php echo $item['Description'] ?>"  />
                    </div>
                </div>
                <div class="form-group form-groupe-lg">
                    <label class="col-sm-2 control-label">Price</label>
                    <div class="col-sm-10 col-md-10">
                        <input type="text" name="price" class="form-control" value="<?php echo $item['Price'] ?>"  />
                    </div>
                </div>
                <!-- <div class="form-group form-groupe-lg">
                    <label class="col-sm-2 control-label">Add_Date</label>
                    <div class="col-sm-10 col-md-10">
                        <input type="text" name="date" class="form-control"  required="required"/>
                    </div>
                </div> -->
                <div class="form-group form-groupe-lg">
                    <label class="col-sm-2 control-label">country</label>
                    <div class="col-sm-10 col-md-10">
                        <input type="text" name="country" class="form-control" value="<?php echo $item['Country_Made'] ?>"  />
                    </div>
                </div>
                <!-- <div class="form-group form-groupe-lg">
                    <label class="col-sm-2 control-label">Image</label>
                    <div class="col-sm-10 col-md-10">
                        <input type="text" name="image" class="form-control"  required="required"/>
                    </div>
                </div> -->
            



                <div class="form-group form-groupe-lg">
                    <label class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10 col-md-10">
                        <select class="form-control" name="status" > 
                            <option value="0">...</option>   
                            <option value="1" <?php if ($item['Status'] ==1) {echo 'selected';} ?>> New</option>  
                            <option value="2" <?php if ($item['Status'] ==2) {echo 'selected';} ?>>Like New</option>  
                            <option value="3" <?php if ($item['Status'] ==3) {echo 'selected';} ?>>Used</option> 
                            <option value="4" <?php if ($item['Status'] ==4) {echo 'selected';} ?>>Very Old</option>  
                        </select>         

                    </div>
                </div>


                <div class="form-group form-groupe-lg">
                    <label class="col-sm-2 control-label">Member</label>
                    <div class="col-sm-10 col-md-10">
                        <select class="form-control" name="member" > 
                            <option value="0">...</option>   
                            <?php 
                                $stmt =$db->prepare("SELECT * FROM User");
                                $stmt->execute();
                                $user =$stmt->fetchAll();

                                    foreach ($user as $user) {

                                        echo "<option value='" . $user['UserID'] . "'"; 
                                         if ($item['Member_ID'] == $user['UserID']) {echo 'selected';}
                                          echo">" . $user['Username'] . "</option>";
                                    }
                                

                            ?>
                        </select>
                    </div>
                </div>

            


                <div class="form-group form-groupe-lg">
                    <label class="col-sm-2 control-label">categorie</label>
                    <div class="col-sm-10 col-md-10">
                        <select class="form-control" name="categorie" > 
                            <option value="0">...</option>   
                            <?php 
                                $stmt2 =$db->prepare("SELECT * FROM categorie");
                                $stmt2->execute();
                                $cats =$stmt2->fetchAll();

                                    foreach ($cats as $cat) {

                                        echo "<option value='" . $cat['ID'] . "'";
                                        if ($item['Cat_ID'] == $cat['ID']) {echo 'selected';}
                                        echo ">" . $cat['Name'] . "</option>";
                                    }
                                

                            ?>
                    </select>
                    </div>
                </div> 
            
                <div class="form-group form-groupe-lg">
                    <div class=" col-sm-offset-2 col-sm-10 ">
                        <input type="submit" value="Save item" class="btn btn-primary"/>
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


    }

    elseif ($do == 'Update'){ 

                echo   "<h1 class='text-center'>Update Item</h1>";
                echo   "<div class='container'>";


                

                if ($_SERVER['REQUEST_METHOD'] == 'POST'){

                    $id =  $_POST['itemid'];
                    $name  =$_POST['name'];
                    $desc   =$_POST['description'];
                    $price  =$_POST['price'];
                    $country   =$_POST['country'];
                    $status   =$_POST['status'];
                    $cat   =$_POST['categorie'];
                    $member  =$_POST['member'];

                   
                $formErrors = array();

                if (empty($name)) {
                    $formErrors[] = 'Name can\'t be <strong>Empty</strong>';
                }

                if (empty($desc)) {
                
                    $formErrors[] = 'Description can\'t be <strong>Empty</strong>';
                }
                if (empty($price)) {
                
                    $formErrors[] = 'Price can\'t be <strong>Empty</strong>';
                }
                if (empty($country)) {
                
                    $formErrors[] = 'Country can\'t be <strong>Empty</strong>';
                }
                if ($status == 0) {
                
                    $formErrors[] = 'You Must choose the<strong>Status</strong>';
                }
                if ($member == 0) {
                
                    $formErrors[] = 'You Must choose the <strong> Member</strong>';
                }
                if ($cat == 0) {
                
                    $formErrors[] = 'You Must choose the <strong>Categorie </strong>';
                }

                    // vérifer les erreurs
                    foreach($formErrors as $error){

                        echo'<div class=" alert alert-danger ">' .  $error . '</div>';

                    }

                    //  check si il'ya no erreur fait les modification

                    if (empty($formErrors)){


                        //UPDATE Dant DataBase

                        $stmt =$db->prepare("UPDATE 
                                                items 
                                            SET 
                                            Name = ?, 
                                            Description = ?, 
                                            Price = ?, 
                                            Country_Made = ?,
                                            Status = ?, 
                                            Cat_ID = ?, 
                                            Member_ID = ? 
                                        WHERE 
                                            item_ID = ?");
                        $stmt->execute(array($name, $desc, $price, $country, $status, $cat, $member, $id));
                        

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


    }

    if ($do == 'Delete'){ 


        echo   "<h1 class='text-center'>Delete Items</h1>";
        echo   "<div class='container'>";
        // il y'a un nomber afficher si non afficher false

        $itemid =  isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']):0;

        $check = checkItem('item_ID', 'items', $itemid);

       
      


    if($check > 0){ 

        $stmt =$db->prepare("DELETE FROM items WHERE item_ID = :zid");

        $stmt->bindParam(":zid",  $itemid);

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

    if ($do == 'Approve'){ 

        echo   "<h1 class='text-center'>Approve Items</h1>";
        echo   "<div class='container'>";
        // il y'a un nomber afficher si non afficher false

        $itemid =  isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']):0;

        $check = checkItem('item_ID', 'items', $itemid);

        if($check > 0){
            
            $stmt = $db->prepare(" UPDATE items SET Approve = 1 WHERE item_ID = ?");

            $stmt->execute(array($itemid));

            $count = $stmt->rowCount();
    

        
            $theMsg =  "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Activated</div>';

            redirectHome($theMsg, 'back');
      


        

    } else {

        // echo 'Not Exist';
        echo "<div class='container'>";

        $theMsg = ' <div class= "alert alert-danger"> Sorry  This ID Not Exist</div>';

         redirectHome($theMsg);

         echo "</div>";
    }
        }
        

    

    include $tpl . 'footer.php';

}else {

    header ('Location : index.php');

    exit();
}






?>
     