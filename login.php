<?php 
// session_start();

$pageTittle = 'Login';

if (isset($_SESSION['user'])){
    header('Location: index.php');
}
include'init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['signup'])) {
        $user   = $_POST['username'];
        $pass   = $_POST['password'];
        $pass2   = $_POST['password2'];
        $email  = $_POST['email'];

        $formErrors = array();
        if (strlen($user) < 4) {
        
            $formErrors[] = 'user cant be lass than 4 characters';
        }
        if ($pass != $pass2) {
        
            $formErrors[] = 'passwords are not identical';
        }
        if (strlen($email) < 10) {
        
            $formErrors[] = 'email cant be lass than 4 characters';
        }
    
        // vérifer les erreurs
        foreach($formErrors as $error){
        
            echo'<div class=" alert alert-danger ">' .  $error . '</div>';
        }

        if (empty($formErrors)){



            // check if User exist in Database

            $check = checkItem("Username", "user",   $user);

            if($check == 1) {

                echo '<div class = "alert alert-danger">sorry this user is Exist</div>';
    
            

            } else {
        
            //UPDATE Dant DataBase
            
            // $stmt =$db->prepare("INSERT INTO user SET Username = ?, Email = ?, FullName = ?, Possword = ?");
            // $stmt->execute(array($user, $email, $name, $pass));
        
                $stmt =$db->prepare("INSERT INTO user (Username, Possword, Email, RegStatus, Date)VALUES(:zuser, :zpass, :zmail, 1, now())");
                $stmt->execute(array(

                    'zuser' => $user,
                    'zpass' => sha1($pass),
                    'zmail' => $email,


                ));
                echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Account Created</div>';
                    
                header("Location: login.php");
                

            }     
    
        }
        else {

            echo "<div class ='container'>";

            $theMsg ='<div class=" alert alert-danger">Sorry you cant browse this Page Directly  </div>';
        
            redirectHome($theMsg, 'back');

            echo "</div>";
        }
    }

    if (isset($_POST['login'])) {
        $user = $_POST['username'];
        $poss = $_POST['password'];
        $hashedPass = sha1($poss);

        // check if the user exist in database
    
        $stmt = $db->prepare("SELECT 
                                UserID, Username, Possword
                                FROM 
                                    user 
                                WHERE 
                                    Username = ? 
                                AND 
                                    Possword = ?");

        $stmt->execute(array($user, $hashedPass));
        $row = $stmt ->fetch();

        $count = $stmt->rowCount();
    
        //if count > 0 this Mean the Database contain Record About This Username
        if ($count > 0){
            $_SESSION['user'] = $user; //register session name
            $_SESSION['ID'] = $row['UserID'];
            header('Location: index.php');
            exit();
        }
    }
 
}
?>


        <div id="login-page" class="container login-page">
            <h1 class="text-center">
                <span class="selected" data-class="log-in">Login</span> | 
                <span data-class="signup">Signup</span>
            </h1>
            <form class="login log-in"  action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                <input class="form-control" type="text" name="username" autocomplate="off" placeholder="Type your username" />
                <input class="form-control" type="password" name="password" autocomplate="new-password"placeholder="Type your password" />
                <input class="btn btn-primary btn-block" type="submit" name="login" value="login" />
            </form>


            <form class="login signup" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                <input class="form-control" type="text" name="username"  placeholder="Type your username" />
                <input class="form-control" type="email" name="email" autocomplate="off" placeholder="Type your email" />
                <input class="form-control" type="password" name="password" autocomplate="new-password"placeholder="Type your password" />
                <input class="form-control" type="password" name="password2" autocomplate="new-password"placeholder="Type your password again" />
                <input class="btn btn-primary btn-block sign" type="submit" name="signup" value="signup" />
            </form>
            
        </div>

<?php 
include $tpl . 'footer.php';
?>