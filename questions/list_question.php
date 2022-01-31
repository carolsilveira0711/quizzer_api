<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	require_once '../config/config.php';
	mysqli_set_charset( $conn, 'utf8');	

    $qst_id = $_GET['qst_id'];
    $qst_title = $_GET['qst_title'];
    $asw_1 = $_GET['asw_1'];
    $asw_2 = $_GET['asw_2'];
    $asw_3 = $_GET['asw_3'];
    $asw_4 = $_GET['asw_4'];
    $asw_number = $_GET['asw_number'];
    $qst_difficulty = $_GET['qst_difficulty'];
    $categories_cat_id = $_GET['categories_cat_id'];

    $sql = "SELECT * FROM question";

    $result = mysqli_query($conn, $sql);
	$results = array();
	while($row = mysqli_fetch_array($result))
	{
	   $results[] = array(
		  'qst_id' =>    $row['qst_id'],
		  'qst_title' =>    $row['qst_title'],
		  'asw_1' =>    $row['asw_1'],
		  'asw_2' =>    $row['asw_2'],
		  'asw_3' =>    $row['asw_3'],
          'asw_4' =>    $row['asw_4'],
          'asw_number' =>    $row['asw_number'],
          'qst_difficulty' =>    $row['qst_difficulty'],
          'categories_cat_id' =>    $row['categories_cat_id']
	   );
	}
	echo json_encode($results);

}
?>
