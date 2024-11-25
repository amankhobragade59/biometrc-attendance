<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script>
    $(document).ready(function() {
        // Enable autocomplete on input and textarea elements
        $('input, textarea').attr('autocomplete', 'on');
    });
    </script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <?php
include("connectdb.php");
session_start();

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
    $sql="SELECT * FROM `account` WHERE `username`='$username'";
    $result=mysqli_query($conn,$sql);
    if($result)
    {
        $num=mysqli_num_rows($result);
        if($num>0)
        {
            $_SESSION['exists']=true;
        }
        else
        {
           if($password != $cpassword)
           {
            $_SESSION['nomatch']=true;
           } 
           else
           {
            $sql = "INSERT INTO `account` (`username`, `password`) VALUES ('$username','$password')";
            $result = mysqli_query( $conn, $sql );
            if ( $result )
            {
                $_SESSION['success']=true;
            }
           }
        }
    }
}
if(isset($_SESSION['login']))
{
    if($_SESSION['login']!=true)
    {
        header("location: index.php");
        exit;
    }
}
?>
</head>

<body>
    <div>
        <h1 class="text-center">BIOMETRIC ATTENDANCE SYSTEM</h1>
    </div>
    <div>
        <header>
            <nav>
                <ul>
                    <li><img src="img/logo.png" height= "60px" width="60px"></li>
                    <li><a class="li" href="index.php">Dashboard</a></li>
                    <li><a class="li" href="userlist.php">User list</a></li>
                    <li><a class="li" href="manageuser.php">Manage Users</a></li>
                    <li><a class="li" href="export.php">Export</a></li>
                    <li><a class="li" href="signup.php">Signup</a></li>
                    <li><button Type="button" id="logout_btn"><a href="logout.php">Logout</a></button></li>
                </ul>
            </nav>
        </header>
    </div>
    <div>
        <?php
        if(isset($_SESSION['exists']))
        {
            if($_SESSION['exists']==true)
            {
               echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Username already exists!! try different username........</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
            unset($_SESSION['exists']); 
            }
        }
        if(isset($_SESSION['nomatch']))
        {
            if($_SESSION['nomatch']==true)
            {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Password do not match!!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
            unset($_SESSION['nomatch']);
            }
        }
        if(isset($_SESSION['success']))
        {
            if($_SESSION['success']==true)
            {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Account has been created now you can proceed to login</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                unset($_SESSION['success']);
            }
            
        }
        ?>
    </div>
            <div id="signuppage">
                <form  id="onlysignupform" action="signup.php" method="post">
                    <p>Sign Up</p>
                    <label for="name">Username</label>
                    <input type="gmail" autocomplete="on" id="username" name="username" placeholder="Type abc@xyz.com.... " required>
                    <label for="password">Password</label>
                    <input type="password" autocomplete="on" id="password" name="password" placeholder="Type password" required>
                    <label for="cpassword">Confirm Password</label>
                    <input type="password" autocomplete="on" id="cpassword" name="cpassword" placeholder="Retype password" required>
                    <button type="submit" class="aman_btn" id="signup">Sign Up</button>
                </form>
            </div>
            
    <footer>
        <div class="main">
            <div class ="left_footer">
                <div><i class="fa fa-map-marker" id="one"></i><span>Hingna,Digdoh,Nagpur,Mharastra 440016</span></div>
                <div><i class="fa fa-envelope-o" id="two"></i> <span>aman.khobragade.cse@ghrietn.raisoni.net</span></div>
                <div><i class="fa fa-phone" id="three"></i> <span>+91 7796419868</span></div>
            </div>
            <div class ="right_footer">
                <h6>About The Company</h6>
                <p>Embedded Solutions & Industry Automation: Expertise in providing top-tier solutions.</p>
                <p>IoT Prototype Development: State-of-the-art</p>  
            </div>
        </div>
        <div class="end">Center of Excellence Embedded IoT  GHRCE, Nagpur</div>
    </footer>
    <script src="js/bootstrap.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/active.js"></script>
    <script src="js/click.js"></script>
</body>

</html>