<?php
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
	require_once '../config/config.php';
	
	$data_json = file_get_contents("php://input");
	$data = json_decode($data_json, true);

    $itm_id = ($data['itm_id']);
    $itm_name = ($data['itm_name']);
    $itm_price = ($data['itm_price']);
    $itm_amount = ($data['itm_amount']);
    $itm_is_hot = ($data['itm_is_hot']);
    $itm_group_id = ($data['itm_group_id']);
    $itm_img = ($data['itm_img']);
    $alias = ($data['alias']);    
            
    $sql = "UPDATE items SET 
        itm_id = '" . ($itm_id) . "',
        itm_name = '" . ($itm_name) . "',
	    itm_price = '" . ($itm_price) . "',
	    itm_amount = '" . ($itm_amount) . "',
        itm_is_hot = '" . ($itm_is_hot) . "',
        itm_group_id = '" . ($itm_group_id) . "',
        itm_img = '" . ($itm_img) . "',
        alias = '" . ($alias) . "'
        WHERE itm_id = '" . ($itm_id) . "'       
        ;";

    $result = mysqli_query($conn,$sql) or die(mysqli_error());

	$sql_get_question = "SELECT * FROM items WHERE itm_id = '" . ($itm_id) . "' ";

	$result_get_question = mysqli_query($conn,$sql_get_question);
	$row = mysqli_fetch_assoc($result_get_question);
	mysqli_error();
	echo json_encode($row);
	mysqli_close($conn);

}
?>
