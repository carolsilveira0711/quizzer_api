<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    $sql = "INSERT INTO items VALUES (DEFAULT,
        '" . ($itm_name) . "',
	    '" . ($itm_price) . "',
	    '" . ($itm_amount) . "',
        '" . ($itm_is_hot) . "',
        '" . ($itm_group_id) . "',
        '" . ($itm_img) . "',
        '" . ($alias) . "');";

        $result = mysqli_query($conn,$sql);

        $sql_get_items = "SELECT * FROM items WHERE itm_name = '" . ($itm_name) . "'";

        $result_get_items = mysqli_query($conn,$sql_get_items);
		
        $row = mysqli_fetch_assoc($result_get_items);
		
        echo json_encode($row);

		mysqli_close($conn);

}
?>