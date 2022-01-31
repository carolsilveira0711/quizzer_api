<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	require_once '../config/config.php';
	mysqli_set_charset( $conn, 'utf8');	

	$usr_id = $_GET['usr_id'];

	$query_coins = mysqli_query($conn, "SELECT * FROM coins");

	while($row = mysqli_fetch_assoc($query_coins)) {
		$items[] = array(
			'coin_price' =>  $row['coi_price'],
			'coin_name' => $row['coi_name'],
			'coin_amount' => $row['coi_amount'],
			'coin_img' => $row['coi_img']
		);
	}

	$user_coins = "SELECT usr_coins FROM users WHERE usr_id = '" . ($usr_id) . "'";

	$result_get_user = mysqli_query($conn, $user_coins);
	$row = mysqli_fetch_assoc($result_get_user);

	$result = new \stdClass();
	$result->user_coins_amount = $row['usr_coins'];
	$result->items = $items;
	echo json_encode($result);
}
?>