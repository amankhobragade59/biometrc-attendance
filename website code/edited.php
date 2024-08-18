<?php
require( 'connectdb.php' );
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{

    $data = file_get_contents( 'php://input' );
    $mydata = json_decode( $data, true );
    echo"yes";
    // $srn =$mydata['id'];
    // $nm =$mydata['name'];
    // $gm =$mydata['gmail'];
    // $rg =$mydata['registrationdate'];
    // console.log($srn);
    // console.log($nm);
    // console.log($gm);
    // console.log($rg);


    // $sql = "UPDATE `member` SET `name` = '$nm', `gmail` = '$gm', `registrationdate` = '$rd' WHERE `serialnumber` = '$srn'";
    // $result =mysqli_query($conn,$sql);
    // if($result)
    // {
    //     echo TRUE;
    // }
    // else
    // {
    //     echo FALSE;
    // }
}else{echo "no";}
?>