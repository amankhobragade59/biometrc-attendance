<?php
require( 'connectdb.php' );
require( 'mode.php' );
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
    $data = file_get_contents( 'php://input' );
    $mydata = json_decode( $data, true );
    $mode = $mydata[ 'mode' ];

    if ( $mode == 'subject' )
    {
        $teacher = $mydata[ 'teacher' ];
        $subject = $mydata[ 'subject' ];
        if ( $mydata[ 'teacher' ] != '' && $mydata[ 'subject' ] != '' )
        {
            $sql = "SELECT * FROM `subjects` WHERE `tname` = '$teacher' AND `sname`= '$subject'";
            $result = mysqli_query( $conn, $sql );
            if ( $result )
            {
                $num = mysqli_num_rows( $result );
                if ( $num>0 )
                {
                    $sql = 'SELECT * FROM `temp`';
                    $result = mysqli_query( $conn, $sql );
                    if ( $result )
                    {
                        $num = mysqli_num_rows( $result );
                        if ( $num == 1 )
                        {
                            $sql = "UPDATE `temp`SET `mode`= '$mode',`subject`='$subject',`tname`='$teacher' WHERE `id`=1";
                            $result = mysqli_query( $conn, $sql );
                            if ( $result )
                            {
                                echo 'Subject Mode';
                            }
                            else
                            {
                                echo 'Database error!!';
                            }
                        }
                        else
                        {
                            $sql = "INSERT INTO `temp`(`mode`,`subject`,`tname`) VALUES ('$mode','$subject','$teacher')";
                            $result = mysqli_query( $conn, $sql );
                            if ( $result )
                            {
                                echo 'Subject Mode';
                            }
                            else
                            {
                                echo 'Database error!!';
                            }
                        }
                    }
                    else
                    {
                        echo 'error';
                    }
                }
                else
                {
                    echo 'Subject not matched with Teacher';
                }
            }
        } 
        else
        {
            echo 'plz fill all fields';
        }
    }
    elseif ($mode == 'day') 
        {
            if ( $mydata[ 'teacher' ] != '' && $mydata[ 'event' ] != '' )
            {
                $event = $mydata[ 'event' ];
                $teacher = $mydata[ 'teacher' ];
                $sql = 'SELECT * FROM `temp`';
                $result = mysqli_query( $conn, $sql );
                if ( $result )
                {
                    $num = mysqli_num_rows( $result );
                    if ( $num == 1 )
                    {
                        $sql = "UPDATE `temp`SET `mode`= '$mode',`subject`='$event',`tname`='$teacher' WHERE `id`=1";
                        $result = mysqli_query( $conn, $sql );
                        if ( $result )
                        {
                            echo 'Day Mode';
                        }
                        else
                        {
                            echo 'Database error!!';
                        }
                    }
                    else
                    {
                        $sql = "INSERT INTO `temp`(`mode`,`subject`,`tname`) VALUES ('$mode','$event','$teacher')";
                        $result = mysqli_query( $conn, $sql );
                        if ( $result )
                        {
                            echo 'Day Mode';
                        }
                        else
                        {
                            echo 'Database error!!';
                        }
                    }

                }
               
            }
            else
            echo 'plz fill all fields';    
        }
        elseif ($mode == 'intern') 
        {
                $subject = $mydata[ 'subject' ];
                $teacher = $mydata[ 'teacher' ];
                $sql = 'SELECT * FROM `temp`';
                $result = mysqli_query( $conn, $sql );
                if ( $result )
                {
                    $num = mysqli_num_rows( $result );
                    if ( $num == 1 )
                    {
                        $sql = "UPDATE `temp`SET `mode`= '$mode',`subject`='$subject',`tname`='$teacher' WHERE `id`=1";
                        $result = mysqli_query( $conn, $sql );
                        if ( $result )
                        {
                            echo 'Intern Mode';
                        }
                        else
                        {
                            echo 'Database error!!';
                        }
                    }
                    else
                    {
                        $sql = "INSERT INTO `temp`(`mode`,`subject`,`tname`) VALUES ('$mode','$subject','$teacher')";
                        $result = mysqli_query( $conn, $sql );
                        if ( $result )
                        {
                            echo 'Intern Mode';
                        }
                        else
                        {
                            echo 'Database error!!';
                        }
                    }

                }  
        }
}
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'GET' )
{
    $value='<div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>'.$mode.' mode stopped'.'</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

    $sql = "DELETE FROM `temp` WHERE `id`=1";
    $result = mysqli_query( $conn, $sql );
    if ( $result )
    {
        echo $value;
    }
    else
    {
        echo 'Database error!!';
    }
}
?>
