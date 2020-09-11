<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php getTittle()?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" /> 
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $css; ?>backend.css"/>
    <!-- <link rel="stylesheet" href="layout/backend.css"> -->

 
  
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Ecommerce</a>
  <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#mobilenavbar" aria-controls="mobilenavbar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="mobilenavbar ">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <!-- <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a> -->
      </li>
      <?php
        foreach (getCat() as $cat) {
          echo '<li><a class="nav-link" href="categorie.php?pageid=' .$cat['ID'] . '&pagename=' .str_replace(' ', '-', $cat['Name']) .'">
          ' . $cat['Name'] .'</a></li>';
        }
      ?>
        <!-- <a class="nav-link" href="contact.php">Contact </a> -->

    </ul>
    <ul class="navbar-nav">
      <!-- <form>
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
            </li>
      </form> -->
      <form class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search" name="search">
                                <button class="btn btn-secondary my-2 my-sm-0 " type="submit" name="Search">Search</button>
                            </form>

      <li class="nav-item">
        <a class="nav-link" href="cart.php" ><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
      </li>
     
        <?php
        if (isset($_SESSION['user'])){ ?>
          <div class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo $_SESSION['user']?>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="members.php?do=Edit&userid=<?php echo $_SESSION['ID']?>">Edit Profile</a>
                <a class="dropdown-item" href="logout.php">Logout</a>
              </div>
            </div>
          </div>
        <?php } else { ?>
          <li class="nav-item">
        <a class="nav-link" href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i></a>
        </li>
      <?php } ?>
    </ul> 
  </div>
</nav>
