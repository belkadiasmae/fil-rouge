<?php
ob_start();
session_start();
$noNavbar ='';
$pageTittle = 'Login';
// si tu deja faire une inscription redirect to dashbord

if (isset($_SESSION['Username'])){
    header('Location: dashboard.php');
}
include'init.php';
// include $tpl .'header.php';
// check if user coming from HTTP post request

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['user'];
    $possword = $_POST['pass'];
    $hashedPass = sha1($possword);

    // check if the user exist in database
 
    $stmt = $db->prepare("SELECT 
                               UserID, Username, Possword
                             FROM 
                                  user 
                            WHERE 
                                  Username = ? 
                            AND 
                                  Possword = ?
                             AND 
                                  GroupID = 1
                             LIMIT  1");
    $stmt->execute(array($username, $hashedPass));
    $row = $stmt ->fetch();
    $count = $stmt->rowCount();
  
    //if count > 0 this Mean the Database contain Record About This Username
    if ($count > 0){
        $_SESSION['Username'] = $username; //register session name
        $_SESSION['ID'] = $row['UserID'];
        header('Location: dashboard.php');
        exit();
    }
 
}
?>
<form class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
    <h4 class="text-center">Admin Login</h4>
    <input class="form-control" type="text" name="user" placeholder="Username" autocomplete="off/">
    <input class="form-control" type="password" name="pass" placeholder="password" autocomplete="new-password">
    <input class="btn btn-primary btn-block" type="submit" value="Login" />
</form>
<?php
include $tpl . 'footer.php';
ob_end_flush();
?>