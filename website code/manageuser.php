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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <?php
include("connectdb.php");
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
    <div class="container col-sm-12 md-10 mt-5">
        <div class="row ">
            <div class="border border-start-0 border-bottom-0 border-top-0 border-success col-md-4 p-4">
                <h5 class="border rounded-pill border-success mb-4 text-center alert-success p-2">Enter The Details</h5>
                <div id="msg"></div>
                <form>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" autocomplete="on" id="name" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label for="gmail">Gmail</label>
                        <input type="email" class="form-control" autocomplete="on" id="gmail" placeholder="Enter Gmail">
                    </div>
                    <div class="form-group">
                        <label for="registrationDate">Registration Date</label>
                        <input type="date" class="form-control" autocomplete="on" id="registrationDate">
                    </div>
                    <button type="submit" id="submit" class="btn btn-primary">Add user</button>
                </form>
            </div>
            <div class="col-md-8 p-4">
                <h5 class="border rounded-pill border-warning mb-4 text-center alert-info p-2">Recent New User</h5>
                <table class="table ">
                    <thead>
                        <tr>
                            <td class ="text-center">Finger ID</td>
                            <td class ="text-center">Name</td>
                            <td class ="text-center">Gmail</td>
                            <td class ="text-center">Registration Date</td>
                        </tr>
                    </thead>
                    <tbody id="newuser" class ="text-center"></tbody>

                </table>
            </div>
        </div>
    </div>


    <script src="js/bootstrap.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/click.js"></script>
    <script src="js/newuser.js"></script>
</body>

</html>