<?php
require( 'connectdb.php' );
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
    $data = file_get_contents( 'php://input' );
    $mydata = json_decode( $data, true );
    $nm = $mydata[ 'name' ];
    $gm = $mydata[ 'gmail' ];
    $rd = $mydata[ 'registrationdate' ];
    $s = 1;
    $sql = "SELECT * FROM `member` WHERE `gmail`='$gm'";
    $result = mysqli_query( $conn, $sql );
    $num=mysqli_num_rows($result);
    if($num>0)
    {
        echo "Gmail ID already exists!!!!";
    }
    else
    {
        $sql = "SELECT `serialnumber`FROM `member` WHERE `name`=''";
    $result = mysqli_query( $conn, $sql );
    if ( !$result )
    {
        echo 'error fetching';
    } 
    else 
    {
        $num = mysqli_num_rows( $result );
        if ( $num>0 )
        {
            $row = mysqli_fetch_assoc( $result );
            $sn=$row['serialnumber'];
            $sql = "UPDATE `member` SET `name`='$nm',`gmail`='$gm',`registrationdate`='$rd', `selected`='$s' WHERE `serialnumber`='$sn'";
            $result = mysqli_query( $conn, $sql );
            if ( $result )
            {
                echo 'scan your finger';
            } 
            else 
            {
                echo 'error occured!!!!!';
            }
        } 
        else 
        {
            $sql = "INSERT INTO `member` (`name`, `gmail`, `registrationdate`, `selected`) VALUES ( '$nm', '$gm', '$rd', '$s')";
            $result = mysqli_query( $conn, $sql );
            if ( $result )
            {
                echo 'scan your finger';
            } 
            else 
            {
                echo 'error occured!!!!!';
            }
        }
    }
    }
    
}
    ?>