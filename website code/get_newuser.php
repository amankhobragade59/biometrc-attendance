<?php
require("connectdb.php");
$sql = "SELECT * FROM `member` ORDER BY `serialnumber` DESC LIMIT 1 ";
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
        $data = array();
        while($row = mysqli_fetch_assoc($result))
        {
            $data[]=$row;
        }
     }
     header('Content-Type: application/json');
     echo json_encode($data);
}
?>