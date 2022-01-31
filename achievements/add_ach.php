<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
require_once '../config/config.php';

$data_json = file_get_contents("php://input");
$data = json_decode($data_json, true);

$ach_name = ($data['ach_name']);
$ach_desc = ($data['ach_desc']);
$ach_icon_url = ($data['ach_icon_url']);
$ach_exp_grant = ($data['ach_exp_grant']);

$sql = "INSERT INTO achievements VALUES (DEFAULT,  
'" . ($ach_name) . "',
'" . ($ach_desc) . "',
'" . ($ach_icon_url) . "',
'" . ($ach_exp_grant) . "');";

$result = mysqli_query($conn,$sql) or die(mysqli_error());

$sql_get_ach = "SELECT * FROM achievements WHERE ach_name = '" . ($ach_name) . "'  ";

$result_get_ach = mysqli_query($conn,$sql_get_ach);
$row = mysqli_fetch_assoc($result_get_ach);
mysqli_error();
echo json_encode($row);
mysqli_close($conn);

}

?>