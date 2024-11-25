<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "internship";
$conn = mysqli_connect($servername,$username,$password,$database);
if (!$conn)
{
    die("error connecting ".mysql_connect_error());
}

?>
