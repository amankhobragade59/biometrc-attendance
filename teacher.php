<?php
require( 'connectdb.php' );
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{

    $data = file_get_contents( 'php://input' );
    $mydata = json_decode( $data, true );
    $sn = $mydata['subject'];
    $tn = $mydata['teacher'];
    $sql = "SELECT * FROM `subjects` WHERE `sname`='$sn'";
    $result = mysqli_query( $conn, $sql );
    $num=mysqli_num_rows($result);
    if($num>0)
    {
        echo "exist";
    }
    else
    {
        $sql = "INSERT INTO `subjects` (`sname`, `tname`) VALUES ( '$sn', '$tn')";
        $result = mysqli_query( $conn, $sql );
        if ( $result)
        {
        echo 'done';
        } 
        else 
        {
        echo 'Error in server';
        }
    }
    
}
?>