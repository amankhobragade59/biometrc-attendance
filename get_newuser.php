<?php
require( 'connectdb.php' );
$data = "<div>
    <table>
        <thead>
            <tr>
                <td>Finger ID</td>
                <td>Name</td>
                <td>G-mail</td>
                <td>Registration Date</td>
            </tr>
        </thead>
        <tbody>";

$sql = 'SELECT * FROM `member` ORDER BY `serialnumber` DESC LIMIT 1';
$result = mysqli_query( $conn, $sql );
if ( !$result )
{
    echo 'error fetching';
} 
else 
{
    $num = mysqli_num_rows( $result );
    if ( $num>0 )
    {
        while( $row = mysqli_fetch_assoc( $result ) )
        {
            $data = $data."<tr>
                            <td>".$row[ 'serialnumber' ].'</td>'
                          .'<td>'.$row[ 'name' ].'</td>'
                          .'<td>'.$row[ 'gmail' ].'</td>'
                          .'<td>'.$row[ 'registrationdate' ]."</td>
                           </tr>";
        }
        $data = $data."</tbody>
                       </table>
                       </div>";
    }
    echo $data;
}

?>
