<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


	require_once '../config/config.php';


	


	$data_json = file_get_contents("php://input");


	$data = json_decode($data_json, true);





    $qst_title = ($data['qst_title']);


    $asw_1 = ($data['asw_1']);


    $asw_2 = ($data['asw_2']);


    $asw_3 = ($data['asw_3']);


    $asw_4 = ($data['asw_4']);


    $asw_number = ($data['asw_number']);


    $qst_difficulty = ($data['qst_difficulty']);


    $categories_cat_id = ($data['categories_cat_id']);


        


        $sql = "INSERT INTO question VALUES (DEFAULT, 


        '" . ($qst_title) . "',


	    '" . ($asw_1) . "',


	    '" . ($asw_2) . "',


        '" . ($asw_3) . "',


        '" . ($asw_4) . "',


        '" . ($asw_number) . "',


        '" . ($qst_difficulty) . "',


        '" . ($categories_cat_id) . "');"; 





    $result = mysqli_query($conn,$sql) or die(mysqli_error());





	$sql_get_question = "SELECT * FROM question WHERE qst_title = '" . ($qst_title) . "'  ";





		$result_get_question = mysqli_query($conn,$sql_get_question);


		$row = mysqli_fetch_assoc($result_get_question);


		mysqli_error();


		echo json_encode($row);


		mysqli_close($conn);





}


?>


