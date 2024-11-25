<?php
require( 'connectdb.php' );
global $mode;
global $subject_or_event;
global $teacher;
$sql = 'SELECT * FROM `temp`';
$result = mysqli_query( $conn, $sql );
if ( $result )
{
    $num = mysqli_num_rows( $result );
    if ( $num == 1 )
    {
        $row = mysqli_fetch_assoc( $result );
        $mode = $row[ 'mode' ];
        $subject_or_event = $row[ 'subject' ];
        $teacher = $row[ 'tname' ];
    }
}
?>