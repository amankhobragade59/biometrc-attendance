<?php
require( 'connectdb.php' );
require( 'connectdb.php' );
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
    echo "yes";
    // $data = file_get_contents( 'php://input' );
    // $mydata = json_decode( $data, true );
    // $srn =$mydata['sid'];

    // $sql = "UPDATE `member` SET `name` = NULL, `gmail` = NULL, `registrationdate` = NULL WHERE `serialnumber` = '$srn'";
    // $result =mysqli_query($conn,$sql);
    // if($result)
    // {
    //     echo TRUE;
    // }
    // else
    // {
    //     echo FALSE;
    // }
}
else
{echo "no";}
?>