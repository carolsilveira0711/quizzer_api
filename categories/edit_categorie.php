<?php

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {

	require_once '../config/config.php';

	$data_json = file_get_contents("php://input");

	$data = json_decode($data_json, true);

    $cat_id = ($data['cat_id']);
    $cat_name = ($data['cat_name']);
    $cat_color  = ($data['cat_color']);
    $cat_icon = ($data['cat_icon']);

    $sql = "UPDATE categories SET 
    cat_id = '" . ($qst_id) . "',
    cat_name = '" . ($cat_name) . "',
    cat_color = '" . ($cat_color) . "',
    cat_icon = '" . ($cat_icon) . "' 
    WHERE cat_id = '" . ($cat_id) . "';";

    $result = mysqli_query($conn,$sql) or die('Error: ' . mysqli_error($myConnection));
    
	$sql_get_cat = "SELECT * FROM categories WHERE cat_id = '" . ($cat_id) . "' ";

	$result_get_cat = mysqli_query($conn,$sql_get_cat);

	$row = mysqli_fetch_assoc($result_get_cat);

	mysqli_error();

	echo json_encode($row);

	mysqli_close($conn);

}

?>

