<?php
require( 'connectdb.php' );
session_start();
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
    $data = file_get_contents( 'php://input' );
    $mydata = json_decode( $data, true );
    $_SESSION['edate1'] = $mydata[ 'date1' ];
    $_SESSION['edate2'] = $mydata[ 'date2' ];
    $_SESSION['sub_event'] = $mydata[ 'subject' ];
    $sub_event=$_SESSION['sub_event'];
    $edate1=$_SESSION['edate1'];
    $edate2=$_SESSION['edate2'];
    $daytbl = "<div>
 <table>
     <thead>
         <tr>
             <td>Date</td>
             <td>Name</td>
             <td>G-mail</td>
             <td>Punch In</td>
             <td>Punch Out</td>
             <td>Incharge Faculty</td>
             <td>Event</td>
         </tr>
     </thead>
     <tbody>";
     $itbl = '<div id="dicon"><a href="download.php"><button type="button"><i class="fa fa-download" aria-hidden="true"></i> Download</button></a></div>
     <div>
     <table>
         <thead>
             <tr>
                 <td>Date</td>
                 <td>Name</td>
                 <td>G-mail</td>
                 <td>Punch In</td>
                 <td>Punch Out</td>
                 <td>Incharge Faculty</td>
                 <td>Event</td>
             </tr>
         </thead>
         <tbody>';
$subjecttbl = "<div>
     <table>
         <thead>
             <tr>
                 <td>Date</td>
                 <td>Name</td>
                 <td>G-mail</td>
                 <td>Punch In</td>
                 <td>Incharge Faculty</td>
                 <td>Subject</td>
             </tr>
         </thead>
         <tbody>";
    if ( $edate1 == '' ||$edate2 == '' || $sub_event == '' )
    {
        echo -1;
    }
    else
    {
        $d_sql = "SELECT `member`.*,`d_punch`.* FROM `member` INNER JOIN `d_punch` ON `member`.`serialnumber`= `d_punch`.`srn` WHERE `working_date` BETWEEN '$edate1' AND '$edate2' AND `event`='$sub_event'";
        $s_sql = "SELECT `member`.*,`s_punch`.* FROM `member` INNER JOIN `s_punch` ON `member`.`serialnumber`= `s_punch`.`srn` WHERE `working_date` BETWEEN '$edate1' AND '$edate2' AND `sname`='$sub_event'";
        $i_sql = "SELECT `member`.*,`i_punch`.* FROM `member` INNER JOIN `i_punch` ON `member`.`serialnumber`= `i_punch`.`srn` WHERE `working_date` BETWEEN '$edate1' AND '$edate2' AND `event`='$sub_event'";
        $d_result = mysqli_query( $conn, $d_sql );
        $s_result = mysqli_query( $conn, $s_sql );
        $i_result = mysqli_query( $conn, $i_sql );
        if ( $d_result && $s_result && $i_result )
        {
            $d_num = mysqli_num_rows( $d_result );
            $s_num = mysqli_num_rows( $s_result );
            $i_num = mysqli_num_rows( $i_result );
            if ( $d_num>0 )
            {
                while( $row = mysqli_fetch_assoc( $d_result ) )
                {
                    if($row[ 'name' ]!='')
                    {
                        $daytbl = $daytbl."<tr>
                                 <td>".$row[ 'working_date' ].'</td>'
                               .'<td>'.$row[ 'name' ].'</td>'
                               .'<td>'.$row[ 'gmail' ].'</td>'
                               .'<td>'.$row[ 'punchin' ].'</td>'
                               .'<td>'.$row[ 'punchout' ].'</td>'
                               .'<td>'.$row[ 'tname' ].'</td>'
                               .'<td>'.$row[ 'event' ]."</td>
                                </tr>";
                    }
                    
                }
                $daytbl = $daytbl."
                              </tbody>
                              </table>
                              </div>";
                echo $daytbl;
            }
            else if ( $i_num>0 )
            {
                while( $row = mysqli_fetch_assoc( $i_result ) )
                {
                    if($row[ 'name' ]!='')
                    {
                        $itbl = $itbl."<tr>
                                 <td>".$row[ 'working_date' ].'</td>'
                               .'<td>'.$row[ 'name' ].'</td>'
                               .'<td>'.$row[ 'gmail' ].'</td>'
                               .'<td>'.$row[ 'punchin' ].'</td>'
                               .'<td>'.$row[ 'punchout' ].'</td>'
                               .'<td>'.$row[ 'tname' ].'</td>'
                               .'<td>'.$row[ 'event' ]."</td>
                                </tr>";
                    }
                    
                }
                $itbl = $itbl."
                              </tbody>
                              </table>
                              </div>";
                echo $itbl;
            }
             else if ( $s_num>0 )
            {
                while( $row = mysqli_fetch_assoc( $s_result ) )
                {
                    if($row[ 'name' ]!='')
                    {
                        $subjecttbl = $subjecttbl."<tr>
                                 <td>".$row[ 'working_date' ].'</td>'
                               .'<td>'.$row[ 'name' ].'</td>'
                               .'<td>'.$row[ 'gmail' ].'</td>'
                               .'<td>'.$row[ 'punchin' ].'</td>'
                               .'<td>'.$row[ 'tname' ].'</td>'
                               .'<td>'.$row[ 'sname' ]."</td>
                                </tr>";
                    }
                }
                $subjecttbl = $subjecttbl."
                              </tbody>
                              </table>
                              </div>";
                echo $subjecttbl;
            } 
            else
            {
                echo 0;
            }   
        } 
        else 
        {
            echo 'error in database';
        }
    }

}



?>