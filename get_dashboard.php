<?php
require("connectdb.php");
require('mode.php');

if($mode == "day"||$mode=="subject"||$mode=="intern")
{
    $day="<div>
    <table>
        <thead>
            <tr>
                <td>Name</td>
                <td>G-mail</td>
                <td>Event</td>
                <td>Incharge Faculty</td>
                <td>Date</td>
                <td>Punch In</td>
                <td>Punch Out</td>
            </tr>
        </thead>
        <tbody>";
    
        $intern="<div>
    <table>
        <thead>
            <tr>
                <td>Name</td>
                <td>G-mail</td>
                <td>Event</td>
                <td>Incharge Faculty</td>
                <td>Date</td>
                <td>Punch In</td>
                <td>Punch Out</td>
            </tr>
        </thead>
        <tbody>";
    
        $subject="<div>
        <table>
            <thead>
                <tr>
                    <td>Name</td>
                    <td>G-mail</td>
                    <td>Subject</td>
                    <td>Incharge Faculty</td>
                    <td>Date</td>
                    <td>Punch In</td>
                </tr>
            </thead>
            <tbody>";
    if($mode == "day")
    {
        $sql = "SELECT `member`.*,`d_punch`.* FROM `member` INNER JOIN `d_punch` ON `member`.`serialnumber`= `d_punch`.`srn` WHERE `working_date`= CURDATE() AND `event`='$subject_or_event'";
        $result = mysqli_query($conn,$sql);
        if(!$result)
        {
            echo "error fetching";
        }
        else
        {
            $num = mysqli_num_rows($result);
            if($num>0)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    $day= $day."<tr>
                                 <td>".$row['name']."</td>"
                                ."<td>".$row['gmail']."</td>"
                                ."<td>".$row['event']."</td>"
                                ."<td>".$row['tname']."</td>"
                                ."<td>".$row['working_date']."</td>"
                                ."<td>".$row['punchin']."</td>"
                                ."<td>".$row['punchout']."</td>
                                </tr>";
                }
                
            }
            $day= $day."
                              </tbody>
                              </table>
                              </div>";
            echo $day;
        } 
    }
    elseif($mode=="subject")
    {
        $sql = "SELECT `member`.*,`s_punch`.* FROM `member` INNER JOIN `s_punch` ON `member`.`serialnumber`= `s_punch`.`srn` WHERE `working_date`= CURDATE() AND `sname`='$subject_or_event'";
        $result = mysqli_query($conn,$sql);
        if(!$result)
        {
            echo "error fetching";
        }
        else
        {
            $num = mysqli_num_rows($result);
            if($num>0)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    $subject= $subject."<tr>
                                 <td>".$row['name']."</td>"
                                ."<td>".$row['gmail']."</td>"
                                ."<td>".$row['sname']."</td>"
                                ."<td>".$row['tname']."</td>"
                                ."<td>".$row['working_date']."</td>"
                                ."<td>".$row['punchin']."</td>
                                 </tr>";
                }
                
            }
            $subject= $subject."
                              </tbody>
                              </table>
                              </div>";
            echo $subject;
        } 
    }
    elseif($mode == "intern")
    {
        $sql = "SELECT `member`.*,`i_punch`.* FROM `member` INNER JOIN `i_punch` ON `member`.`serialnumber`= `i_punch`.`srn` WHERE `working_date`= CURDATE() AND `event`='$subject_or_event'";
        $result = mysqli_query($conn,$sql);
        if(!$result)
        {
            echo "error fetching";
        }
        else
        {
            $num = mysqli_num_rows($result);
            if($num>0)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    $intern= $intern."<tr>
                                 <td>".$row['name']."</td>"
                                ."<td>".$row['gmail']."</td>"
                                ."<td>".$row['event']."</td>"
                                ."<td>".$row['tname']."</td>"
                                ."<td>".$row['working_date']."</td>"
                                ."<td>".$row['punchin']."</td>"
                                ."<td>".$row['punchout']."</td>
                                </tr>";
                }
                
            }
            $intern= $intern."
                              </tbody>
                              </table>
                              </div>";
            echo $intern;
        } 
        } 
    }
else
{ 
    echo '<div class="alert alert-danger " role="alert"><strong>Select any mode to start the system!!!</strong><buttontype="button" class="close" data-dismiss="alert" aria-label="Close"></button></div>';
}
?>
