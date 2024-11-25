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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <?php
      require("connectdb.php");
      session_start();
      if(isset($_SESSION['login']))
        {
            if($_SESSION['login']!=true)
            {
                header("location: signin.php");
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
                <li><button Type="button" id="logout_btn"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</button></li>
            </ul>
        </nav>
    </header>
    <div id="sm">select mode</div>
    <div id="mode">
        <button Type="button" class="buttons" id="smode">Subject mode</button>
        <button Type="button" class="buttons" id="dmode">Day mode</button>
        <button Type="button" class="buttons" id="intern">Intern mode</button>
    </div>
    <div class="label" id="label">
    </div>
    <div class="container d-flex justify-content-center mt-4">
        <div class="col-md-12">
            <h3 class="border rounded-pill border-warning mb-2 text-center alert-success p-2 mt-3">Entry table</h3>
        <div id="dash" class="col-md-12"></div>
    </div>  
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
    <script src="js/active.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/dashboard.js"></script>
</body>

</html>