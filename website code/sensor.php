<?php
require( 'connectdb.php' );

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

        } else {
            echo 'check';
        }
    } else {
        $parts = explode( '=', $value );
        //divide string based on position of '='
        $before = $parts[ 0 ];
        $after = $parts[ 1 ];
        $fingerid = intval( $after );
        if ( $before == 'verified' )
 {
            $sql = "SELECT * FROM `punch` WHERE `date` = CURDATE() AND `srn`='$fingerid'";
            $result = mysqli_query( $conn, $sql );
            if ( $result )
 {
                $num = mysqli_num_rows( $result );
                if ( $num == 1 )
 {
                    $sql = "UPDATE `punch` SET `punchout`=CURTIME() WHERE `srn`='$fingerid'";
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

                } else {
                    $sql = "INSERT INTO `punch` (`date`, `punchin`, `punchout`, `srn`) VALUES (CURDATE(), CURTIME(), '', '$fingerid')";
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

        if ( $before == 'enrolled' )
 {
            $sql = "UPDATE `member` SET `selected`= 0 WHERE `serialnumber`= '$fingerid'";
            $result = mysqli_query( $conn, $sql );
            if ( $result )
 {
                echo 'Enrollment done';
            } else {
                echo 'Enrollment failed';
            }

        }
    }

} else {
    echo 'error h ';
}
?>