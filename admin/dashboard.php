<?php
// ob-start();
session_start();

// si tu deja faire une inscription redirect to dashbord
if (isset($_SESSION['Username'])) {

  $pageTittle = 'Dashboard';
  include 'init.php';

  // From last user

  $numUser = 5 ;

  $latestUsers = getLatest("*", "user", "UserID", $numUser);

  $numItems = 6;

  $latestItems = getLatest("*", 'items', 'item_ID', $numItems);

  ?>

    <div class="container Home-stats d-flex flex-column justify-content-center text-center">
      <h2>Dashboard</h2>
      <div class= "row" >
        <div  class="col-md-3">
          <a class="stat st_members" href="members.php">
            <i class="fa fa-users fa-5x" aria-hidden="true"></i>
            <span>Total Members</span>
            <span class="stat_number"><?php echo countItems('UserID', 'user')?></span>
          </a>
        </div>
        <div class="col-md-3">
          <a class="stat st_pending" href="members.php?do=Manage&page=Pending">
            <i class="fa fa-check-circle-o fa-5x" aria-hidden="true"></i>
            <span>Pending Members</span>
            <span class="stat_number"><?php echo checkItem("RegStatus", "user", 0)?></span>
          </a>
        </div>
        <div class="col-md-3">
          <a class="stat st_total" href="items.php">
            <i class="fa fa-info-circle fa-5x" aria-hidden="true"></i>
            <span>Total Items</span>
            <span class="stat_number"><?php echo countItems('item_ID', 'items')?></span>
          </a>
        </div>
        
      </div>
    </div>
   <!-- <div class="latest">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <div class="card card-default">
            <div class="card-header">
              <i class="fa fa-users"> Latest <?php echo $numUser?> Registerd Users </i>
            </div>
            <div class="card-body">
                  <ul class="list-unstyled latest-users">
            <?php 

                    $latestUsers = getLatest("*", "user", "UserID", $numUser);

                    foreach ($latestUsers as $user) {

                      echo '<li>' ;
                      echo   $user['Username'] ; 
                      echo  '<a href="members.php?do=Edit&userid=' . $user['UserID'] .'">';
                      echo '<span class="btn btn-success pull-right">';
                    echo '<i class="fa fa-edit"></i>Edite';
                    if($user['RegStatus'] == 0){

                      echo " <a href='members.php?do=Activate&userid=" . $user['UserID'] . "'class='btn btn-info  pull-right '> <i class='fa fa-check'></i>Activate</a>";

                        }
              echo '</span>';
                echo   '</a>';
                    echo '</li>';
                      

                    }
                  
                  ?>
            </ul>
              </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card card-default">
            <div class="card-header">
              <i class="fa fa-tag"> Latest Items  </i>
            </div>
            <div class="card-body">



            <ul class="list-unstyled latest-users">
            <?php 

                    $latestItems = getLatest ("*", 'items', 'item_ID', $numItems);

                    foreach ($latestItems as $item) {

                      echo '<li>' ;
                      echo   $item['Name'] ; 
                      echo  '<a href="items.php?do=Edit&itemid=' . $item['item_ID'] .'">';
                      echo '<span class="btn btn-success pull-right">';
                    echo '<i class="fa fa-edit"></i>Edite';
                    if($item['Approve'] == 0){

                      echo " <a href='items.php?do=Approve&itemid=" . $item['item_ID'] . "'class='btn btn-info  pull-right '> <i class='fa fa-check'></i>Approve</a>";

                        }
              echo '</span>';
                echo   '</a>';
                    echo '</li>';
                      

                    }
                  
                  ?>
            </ul>
              </div>
          </div>
        </div>
      </div>
    </div>
   </div> -->

  <?php
    include $tpl . 'footer.php';
} 
else {
 
    header('Location: index.php');
    exit();
}
// ob_end_flush();
?>