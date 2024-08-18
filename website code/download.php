<?php
require( 'connectdb.php' );
    // $data = file_get_contents( 'php://input' );
    // $mydata = json_decode( $data, true );
    // $date = $mydata['date'];
    session_start();
    $date= $_SESSION['date'];
    $sql = "SELECT `member`.*,`punch`.* FROM `member` INNER JOIN `punch` ON `member`.`serialnumber`= `punch`.`srn` WHERE `date`= '$date'";
    $result = mysqli_query( $conn, $sql );
    if(!$result)
    {
        echo "error fetching";
    }
    else
    {
        $num = mysqli_num_rows($result);
        if($num>0)
        {
            $str= "<table>
        <thead>
            <tr>
                <td>Date</td>
                <td>Name</td>
                <td>G-mail</td>
                <td>Punch In</td>
                <td>Punch Out</td>
            </tr>
        </thead>
        <tbody>";
            while($row = mysqli_fetch_assoc($result))
            {
                $str.= "<tr>
        <td>".$row['date']."</td>
        <td>".$row['name']."</td>
        <td>".$row['gmail']."</td>
        <td>".$row['punchin']."</td>
        <td>".$row['punchout']."</td>
    </tr>";
            }
            $str.= "</tbody></table>";
        }

        // Set headers to prompt a file download
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=report'.$date.'.xls');
        echo $str;
        session_unset();
    }
    ?>