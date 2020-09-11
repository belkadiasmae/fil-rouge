<?php include 'init.php';

$do = isset($_GET['do']) ? $_GET['do'] : "welcome";

if ($do == 'welcome') {


?>

    <div class="container">
       
        <div class="row catb">

            <?php
            global $db;
            if(isset($_GET['Search'])){
                $search = $_GET['search'];
                $data = search($search);
                
                foreach ($data as $item) {


                    echo '<div class="col-sm-6 col-md-4">';
                    echo ' <div class="thumbnail item-box">';
                    echo '<img src="admin/upload/' . $item['Image'] . '" alt="' . $item['Name'] . '" />';
                    echo ' <div class="item-desc">';
                    echo ' <div class="caption">';
                    echo ' <h3>' . $item['Name'] . '</h3>';
                    echo ' <p>' . $item['Description'] . '</p>';
                    echo '</div>';
                    echo ' <div class="d-flex justify-content-between">';
                    echo '<span class="price-tag align-self-center">' . $item['Price'] . ' MAD</span>';
                ?>
                    <form action="#" method="post">
                        <button type="submit" id="addToCart" class="btn btn-add align-self-center"><i class="fas fa-shopping-cart panier"></i></button>
                    </form>
                <?php
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            <?php  
                }else{

               
                foreach (getItems($_GET['pageid']) as $item) {


                    echo '<div class="col-sm-6 col-md-4">';
                    echo ' <div class="thumbnail item-box">';
                    echo '<img src="admin/upload/' . $item['Image'] . '" alt="' . $item['Name'] . '" />';
                    echo ' <div class="item-desc">';
                    echo ' <div class="caption">';
                    echo ' <h3>' . $item['Name'] . '</h3>';
                    echo ' <p>' . $item['Description'] . '</p>';
                    echo '</div>';
                    echo ' <div class="d-flex justify-content-between">';
                    echo '<span class="price-tag align-self-center">' . $item['Price'] . ' MAD</span>';
                ?>
                    <form action="#" method="post">
                        <button  type="submit" id="addToCart" class="btn btn-add align-self-center"><i class="fas fa-shopping-cart panier"></i></button>
                    </form>
                <?php
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>

<?php  }

          

          
            ?>
        </div>
    </div>

<?php
} elseif ($do == "addToCart") {
    
}
?>


<?php include $tpl . 'footer.php'; ?>