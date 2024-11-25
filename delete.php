<?php
require( 'connectdb.php' );
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{

    $data = file_get_contents( 'php://input' );
    $mydata = json_decode( $data, true );
    $srn =$mydata['sid'];

    $sql = "UPDATE `member` SET `name` = '', `gmail` = '', `registrationdate` = '00:00:00' WHERE `serialnumber` = '$srn'";
    $result =mysqli_query($conn,$sql);
    if($result)
    {
        echo TRUE;
    }
    else
    {
        echo FALSE;
    }
}
?>