<?php
require( 'connectdb.php' );
require( 'mode.php' );
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
    $value = file_get_contents( 'php://input' );
    if ( $value == 'ready' )
    {
        $sql = 'SELECT * FROM `member` WHERE `selected`= 1';
        $result = mysqli_query( $conn, $sql );
        $num = mysqli_num_rows( $result );
        if ( $num == 1 )
        {
            $row = mysqli_fetch_assoc( $result );
            $sr = $row[ 'serialnumber' ];
            //get serialnumber where selected = 1
            if ( $result )
            {
                echo 'enroll='.$sr;
            }

        } elseif ( $mode == 'day' || $mode == 'subject'||$mode == 'intern' )
        {
            echo 'check';
        } 
        else 
        {
            echo 'wait';
        }
    } 
    else 
    {
        $parts = explode( '=', $value );
        //divide string based on position of '='
        $before = $parts[ 0 ];
        $after = $parts[ 1 ];
        $fingerid = intval( $after );
        if ( $before == 'verified' )
        {
            if ( $mode == 'subject' )
            {
                $sql = "INSERT INTO `s_punch` (`date`, `punchin`,`srn`,`sname`,`tname`) VALUES (CURDATE(), CURTIME(),'$fingerid','$subject','$teacher')";
                $result = mysqli_query( $conn, $sql );
                if ( $result )
                {
                    $sql = "SELECT * FROM `member` WHERE `serialnumber`='$fingerid'";
                    $result = mysqli_query( $conn, $sql );

                    if ( $result )
                    {
                        $row = mysqli_fetch_assoc( $result );
                        echo  'Welcome '.$row[ 'name' ];
                    }
                }
                else
                {
                    echo "no matching finger print available";
                }
            } 
            elseif ( $mode == 'day' )
            {
                $sql = "SELECT * FROM `d_punch` WHERE `date` = CURDATE() AND `srn`='$fingerid'";
                $result = mysqli_query( $conn, $sql );
                if ( $result )
                {
                    $num = mysqli_num_rows( $result );
                    if ( $num == 1 )
                    {
                        $sql = "UPDATE `d_punch` SET `punchout`=CURTIME() WHERE `srn`='$fingerid'";
                        $result = mysqli_query( $conn, $sql );
                        if ( $result )
                        {
                            $sql = "SELECT * FROM `member` WHERE `serialnumber`='$fingerid'";
                            $result = mysqli_query( $conn, $sql );

                            if ( $result )
                            {
                                $row = mysqli_fetch_assoc( $result );
                                echo  'Good Byeee '.$row[ 'name' ];
                            }
                        }

                    } 
                    else 
                    {
                        $sql = "INSERT INTO `d_punch` (`date`, `punchin`, `punchout`, `srn`,`tname`,`event`) VALUES (CURDATE(), CURTIME(), '', '$fingerid','$teacher','$subject')";
                        $result = mysqli_query( $conn, $sql );
                        if ( $result )
                        {
                            $sql = "SELECT * FROM `member` WHERE `serialnumber`='$fingerid'";
                            $result = mysqli_query( $conn, $sql );

                            if ( $result )
                            {
                                $row = mysqli_fetch_assoc( $result );
                                echo  'Welcome '.$row[ 'name' ];
                            }
                        }
                    }
                }
            }
            elseif ( $mode == 'intern' )
            {
                $sql = "SELECT * FROM `i_punch` WHERE `date` = CURDATE() AND `srn`='$fingerid'";
                $result = mysqli_query( $conn, $sql );
                if ( $result )
                {
                    $num = mysqli_num_rows( $result );
                    if ( $num == 1 )
                    {
                        $sql = "UPDATE `i_punch` SET `punchout`=CURTIME() WHERE `srn`='$fingerid'";
                        $result = mysqli_query( $conn, $sql );
                        if ( $result )
                        {
                            $sql = "SELECT * FROM `member` WHERE `serialnumber`='$fingerid'";
                            $result = mysqli_query( $conn, $sql );

                            if ( $result )
                            {
                                $row = mysqli_fetch_assoc( $result );
                                echo  'Good Byeee '.$row[ 'name' ];
                            }
                        }

                    } 
                    else 
                    {
                        $sql = "INSERT INTO `i_punch` (`date`, `punchin`, `punchout`, `srn`,`tname`,`event`) VALUES (CURDATE(), CURTIME(), '', '$fingerid','$teacher','$subject')";
                        $result = mysqli_query( $conn, $sql );
                        if ( $result )
                        {
                            $sql = "SELECT * FROM `member` WHERE `serialnumber`='$fingerid'";
                            $result = mysqli_query( $conn, $sql );
                            if ( $result )
                            {
                                $row = mysqli_fetch_assoc( $result );
                                echo  'Welcome '.$row[ 'name' ];
                            }
                        }
                    }
                }
            }
        } 
        elseif( $before == 'enrolled' )
        {
            $sql = "UPDATE `member` SET `selected`= 0 WHERE `serialnumber`= '$fingerid'";
            $result = mysqli_query( $conn, $sql );
            if ( $result )
            {
                echo 'Enrollment done';
            } 
            else 
            {
                echo 'Enrollment failed';
            }

        }
    }

} 
else 
{
    echo 'error h ';
}
?>