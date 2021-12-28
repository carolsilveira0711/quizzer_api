<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require_once '../config/config.php';
	
	$data_json = file_get_contents("php://input");
	$data = json_decode($data_json, true);
	
	$usr_name = ($data['usr_name']);
	$usr_email = ($data['usr_email']);
	$usr_rec_password = ($data['usr_rec_password']);
	$password_encrypted = md5($password);
	$usr_avatar_url = ($data['usr_avatar_url']);
	$usr_country = ($data['usr_country']);
	$usr_nick = ($data['usr_nick']);
	$usr_is_premium = ($data['usr_is_premium']);
	$usr_ip = ($data['usr_ip']);
	$usr_coins = ($data['usr_coins']);
	
	$usr_country_code = ($data['usr_country_code']);
	$usr_ddd = ($data['usr_ddd']);
    $usr_number= ($data['usr_number']);
	
	$user_itm_lives = ($data['user_itm_lives']);
	$item_change_question = ($data['item_change_question']);
	$item_next_question = ($data['item_next_question']);
	$item_gain_time = ($data['item_gain_time']);
	$item_erase_options = ($data['item_erase_options']);

	$query = mysqli_query($conn, "SELECT * from users WHERE usr_email =	'" . ($usr_email) . "' ");
	$numrows = mysqli_num_rows($query);

	if ($numrows == 0) {
	$sql = "INSERT INTO users VALUES (DEFAULT, 
	'" . ($usr_name) . "',
	'" . ($usr_email) . "',
	'" . ($password_encrypted) . "', 
	null,
	now(), 
	'" . ($usr_avatar_url) . "',
	'" . ($usr_country) . "', 
	'" . ($usr_nick) . "',
	'" . ($usr_is_premium) . "',
	now(),
	'" . ($usr_ip) . "',
	'" . ($usr_coins) . "');";

	$result = mysqli_query($conn,$sql) or die (mysqli_error($conn));

	$get_user_query = mysqli_query($conn, "SELECT * from users WHERE usr_nick =	'" . ($usr_nick) . "' ");

	$row = mysqli_fetch_assoc($get_user_query);
	echo json_encode($row);
	mysqli_close($conn);
	
	} else {
		echo "ja existe usuario cadastrado com este e-mail!";
		mysqli_close($conn);
	}

}
?>