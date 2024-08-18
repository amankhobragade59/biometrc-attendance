<?php

$servername = "localhost";
$username = "aman";
$password = "1234";
$database = "internship";

$conn = mysqli_connect($servername,$username,$password,$database);
if (!$conn)
{
    die("error connecting ".mysql_connect_error());
}

?>
