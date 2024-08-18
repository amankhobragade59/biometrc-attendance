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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <?php
      require("connectdb.php");
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
                <li>
                    <input type="text" size="6" placeholder=" Type... ">
                    <button type="button"><a href="#">search</a></button>
                </li>
            </ul>
        </nav>
    </header>
    </div>
    <div class="container d-flex justify-content-center mt-4">
        <div class="border border-5 border-info col-md-12">
            <h3 class="border rounded-pill border-warning mb-4 text-center alert-success p-2 mt-3">Entry table</h3>
        <table class="table table-bordered equal-width-table">
            <thead>
                <tr>
                    <td class="text-center">Finger ID</td>
                    <td class="text-center">Name</td>
                    <td class="text-center ">Gmail</td>
                    <td class="text-center">Entry Date</td>
                    <td class="text-center">Punch In</td>
                    <td class="text-center">Punch Out</td>
                </tr>
            </thead>
            <tbody id="dash" class="text-center"></tbody>

        </table>
        </div>
        
    </div>
    <script src="js/bootstrap.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/dashboard.js"></script>
</body>

</html>