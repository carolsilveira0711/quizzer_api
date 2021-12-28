<?php
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
	require_once '../config/config.php';
	
	$data_json = file_get_contents("php://input");
	$data = json_decode($data_json, true);

    $qst_id = ($data['qst_id']);
    $qst_title = ($data['qst_title']);
    $asw_1 = ($data['asw_1']);
    $asw_2 = ($data['asw_2']);
    $asw_3 = ($data['asw_3']);
    $asw_4 = ($data['asw_4']);
    $asw_number = ($data['asw_number']);
    $qst_difficulty = ($data['qst_difficulty']);
    $categories_cat_id = ($data['categories_cat_id']);
            
    $sql = "UPDATE question SET 
        qst_id = '" . ($qst_id) . "',
        qst_title = '" . ($qst_title) . "',
	    asw_1 = '" . ($asw_1) . "',
	    asw_2 = '" . ($asw_2) . "',
        asw_3 = '" . ($asw_3) . "',
        asw_4 = '" . ($asw_4) . "',
        asw_number = '" . ($asw_number) . "',
        qst_difficulty = '" . ($qst_difficulty) . "',
        categories_cat_id = '" . ($categories_cat_id) . "' 
        WHERE qst_id = '" . ($qst_id) . "'
        ;";

    $result = mysqli_query($conn,$sql) or die(mysqli_error());

	$sql_get_question = "SELECT * FROM question WHERE qst_id = '" . ($qst_id) . "' ";

	$result_get_question = mysqli_query($conn,$sql_get_question);
	$row = mysqli_fetch_assoc($result_get_question);
	mysqli_error();
	echo json_encode($row);
	mysqli_close($conn);

}
?>
