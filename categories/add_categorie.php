<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require_once '../config/config.php';	

	$data_json = file_get_contents("php://input");
	$data = json_decode($data_json, true);

    $cat_name = ($data['cat_name']);
    $cat_color = ($data['cat_color']);
    $cat_icon = ($data['cat_icon']);
    
    $sql = "INSERT INTO categories VALUES (DEFAULT,
    '" . ($cat_name) . "',
	'" . ($cat_color) . "', 
    '" . ($cat_icon) . "');"; 

    $result = mysqli_query($conn,$sql) or die(mysqli_error());

    $sql_get_cat = "SELECT * FROM categories WHERE cat_name = '" . ($cat_name) . "'  ";

    $result_get_cat = mysqli_query($conn,$sql_get_cat);
    $row = mysqli_fetch_assoc($result_get_cat);

    mysqli_error();
    echo json_encode($row);
    mysqli_close($conn);

}

?>  