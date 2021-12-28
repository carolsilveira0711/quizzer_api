<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	require_once '../config_hmg/config_hmg.php';
	mysqli_set_charset( $conn, 'utf8');

	$user_id = $_GET['usr_id'];

	$sql = "SELECT categories.cat_id, categories.cat_color, categories.cat_name, categories.cat_img_url, user_cat.usr_cat_is_unlocked, users.usr_id FROM categories
			JOIN user_cat ON categories.cat_id=user_cat.categories_cat_id
			JOIN users ON users.usr_id=user_cat.users_usr_id 
			WHERE users.usr_id = '" . ($user_id) . "' ";
			
	$result = mysqli_query($conn, $sql);

	if ($result->num_rows === 0) {
		echo json_encode("Error");
	} 

	$results = array();
	while($row = mysqli_fetch_array($result))
	{
	   $results[] = array(
		  'cat_id' =>    $row['cat_id'],
		  'cat_name' =>    $row['cat_name'],
		  'cat_color' =>    $row['cat_color'],
		  'usr_cat_is_unlocked' =>    $row['usr_cat_is_unlocked'],
		  'cat_img_url' =>    $row['cat_img_url'],
	   );
	}
	echo json_encode($results);
	
}
?>