<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	require_once '../config/config.php';
	mysqli_set_charset( $conn, 'utf8');	

    $itm_id = $_GET['itm_id'];
    $itm_name = $_GET['itm_name'];
    $itm_price = $_GET['itm_price'];
    $itm_amount = $_GET['itm_amount'];
    $itm_is_hot = $_GET['itm_is_hot'];
    $itm_group_id = $_GET['itm_group_id'];
    $itm_img = $_GET['itm_img'];
    $alias = $_GET['alias'];    

    $sql = "SELECT * FROM items";

    $result = mysqli_query($conn, $sql);
	$results = array();
	while($row = mysqli_fetch_array($result))
	{
	   $results[] = array(
		  'itm_id' =>    $row['itm_id'],
		  'itm_name' =>    $row['itm_name'],
		  'itm_price' =>    $row['itm_price'],
		  'itm_amount' =>    $row['itm_amount'],
		  'itm_is_hot' =>    $row['itm_is_hot'],
          'itm_group_id' =>    $row['itm_group_id'],
          'itm_img' =>    $row['itm_img'],
          'alias' =>    $row['alias']
        );
	}
	echo json_encode($results);

}
?>
