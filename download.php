<?php
require( 'connectdb.php' );
session_start();
$sub_event = $_SESSION[ 'sub_event' ];
$edate1 = $_SESSION[ 'edate1' ];
$edate2 = $_SESSION[ 'edate2' ];
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
if ( $sub_event == 'Internship' )
{
    $i_sql = "SELECT `member`.*,`i_punch`.* FROM `member` INNER JOIN `i_punch` ON `member`.`serialnumber`= `i_punch`.`srn` WHERE `working_date` BETWEEN '$edate1' AND '$edate2' AND `event`='$sub_event'";
    $i_result = mysqli_query( $conn, $i_sql );
    if ( $i_result )
    {
        $i_num = mysqli_num_rows( $i_result );

        if ( $i_num>0 )
        {
            while( $row = mysqli_fetch_assoc( $i_result ) )
            {
                if ( $row[ 'name' ] != '' )
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

            $daytbl = $daytbl.'</tbody></table></div>';
            // Set headers to prompt a file download
            header( 'Content-Type: application/xls' );
            header( 'Content-Disposition: attachment; filename=report'.$edate1.' to '.$edate2.'.xls' );
            echo $daytbl;
        }

    }
} else {
    $d_sql = "SELECT `member`.*,`d_punch`.* FROM `member` INNER JOIN `d_punch` ON `member`.`serialnumber`= `d_punch`.`srn` WHERE `working_date` BETWEEN '$edate1' AND '$edate2' AND `event`='$sub_event'";
    $s_sql = "SELECT `member`.*,`s_punch`.* FROM `member` INNER JOIN `s_punch` ON `member`.`serialnumber`= `s_punch`.`srn` WHERE `working_date` BETWEEN '$edate1' AND '$edate2' AND `sname`='$sub_event'";

    $d_result = mysqli_query( $conn, $d_sql );
    $s_result = mysqli_query( $conn, $s_sql );
    if ( $d_result && $s_result )
    {
        $d_num = mysqli_num_rows( $d_result );
        $s_num = mysqli_num_rows( $s_result );
        if ( $d_num>0 )
        {
            while( $row = mysqli_fetch_assoc( $d_result ) )
            {
                if ( $row[ 'name' ] != '' )
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

            $daytbl = $daytbl.'</tbody></table></div>';
            // Set headers to prompt a file download
            header( 'Content-Type: application/xls' );
            header( 'Content-Disposition: attachment; filename=report'.$edate.'.xls' );
            echo $daytbl;
        } else if ( $s_num>0 )
        {
            while( $row = mysqli_fetch_assoc( $s_result ) )
            {
                if ( $row[ 'name' ] != '' )
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

            $subjecttbl = $subjecttbl.'</tbody></table></div>';
            // Set headers to prompt a file download
            header( 'Content-Type: application/xls' );
            header( 'Content-Disposition: attachment; filename=report '.$edate.'.xls' );
            echo $subjecttbl;
        }

    }
}

?>