<?php
require( 'connectdb.php' );
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'GET' )
{
    $sql1='SELECT DISTINCT `event` FROM `d_punch`';
    $sql2='SELECT DISTINCT `sname` FROM `s_punch`';
    $result1=mysqli_query($conn,$sql1);
    $result2=mysqli_query($conn,$sql2);
    if ( !$result1 || !$result2 )
    {
        echo 'error fetching';
    } 
    else 
    {
        $num1 = mysqli_num_rows( $result1 );
        $num2 = mysqli_num_rows( $result2 );
        $data = array();
        if ( $num1>0 || $num2>0 )
        {
            if ( $num1>0 )
            {
              while( $row = mysqli_fetch_assoc( $result1 ) )
              {
                $data[] = $row;
              }
            }
            if ( $num2>0 )
            {
              while( $row = mysqli_fetch_assoc( $result2 ) )
              {
                $data[] = $row;
              }
            }
            header( 'Content-Type: application/json' );
            echo json_encode( $data );
        } 
        else 
        {
            echo -1;
        }

    }
}
?>