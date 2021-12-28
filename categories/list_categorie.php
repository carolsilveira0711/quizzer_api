<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	require_once '../config/config.php';
	mysqli_set_charset( $conn, 'utf8');	

    $cat_id = $_GET['cat_id'];
    $cat_name = $_GET['cat_name'];
    $cat_color = $_GET['cat_color'];
    $cat_icon = $_GET['cat_icon'];
   
    $sql = "SELECT * FROM categories";

    $result = mysqli_query($conn, $sql);
	$results = array();
	while($row = mysqli_fetch_array($result))
	{
	   $results[] = array(
		  'cat_id' =>    $row['cat_id'],
		  'cat_name' =>    $row['cat_name'],
		  'cat_color' =>    $row['cat_color'],
		  'cat_icon' =>    $row['cat_icon']
		 	   );
	}
	echo json_encode($results);

}
?>
