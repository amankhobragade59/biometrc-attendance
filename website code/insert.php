<?php
require( 'connectdb.php' );
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{

    $data = file_get_contents( 'php://input' );
    $mydata = json_decode( $data, true );
    $nm = $mydata['name'];
    $gm = $mydata['gmail'];
    $rd = $mydata['registrationdate'];
    $s = 1;
    $sql = "INSERT INTO `member` (`name`, `gmail`, `registrationdate`, `selected`) VALUES ( '$nm', '$gm', '$rd', '$s')";
    $result = mysqli_query( $conn, $sql );
    if ( $result)
    {
        echo 'scan your finger';
    } 
    else 
    {
        echo 'Scan Your finger';
    }
}
?>