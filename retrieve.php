<?php
require("connectdb.php");
$sql = "SELECT * FROM `member` WHERE `name` IS NOT NULL";
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
            if($row['name']!='')
            {
                $data[]=$row;
            }
            
        }
        header('Content-Type: application/json');
        echo json_encode($data);
    }
     
}
?>