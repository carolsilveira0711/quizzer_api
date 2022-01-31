<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	require_once '../config/config.php';
	mysqli_set_charset( $conn, 'utf8');	

    $qst_id = $_GET['qst_id'];

    $sql = "SELECT * FROM question WHERE qst_id = '" . ($qst_id) . "'";

    $result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);

    echo json_encode($row);

}

?>