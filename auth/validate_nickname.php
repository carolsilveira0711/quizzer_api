<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require_once '../config/config.php';

	$data_json = file_get_contents("php://input");

	$data = json_decode($data_json, true);

	$nickname = ($data['usr_nick']);

	$user_id = ($data['usr_id']);

	$user_avatar_url = ($data['usr_avatar_url']);

	$query = mysqli_query($conn, "SELECT * FROM users WHERE usr_nick =	'$nickname'");
	$numrows = mysqli_num_rows($query);

	if ($numrows == 0) {
		$insert_user_query = mysqli_query($conn, "UPDATE users SET usr_nick = '" . ($nickname) . "' WHERE usr_id =	'" . ($user_id) . "'");

		$result = false;

		if($user_avatar_url == null || empty($user_avatar_url)) {
			$update_avatar = mysqli_query($conn, "UPDATE users SET usr_avatar_url = 'https://cdn-icons-png.flaticon.com/512/149/149071.png' WHERE usr_id =	'" . ($user_id) . "'");
		} else {
			$update_avatar = mysqli_query($conn, "UPDATE users SET usr_avatar_url = '". ($user_avatar_url) . "' WHERE usr_id =	'" . ($user_id) . "'");
		}

	} else {
		$result = true;
	 }

	 $createNickname = new \stdClass();
	 $createNickname->result = $result;

	 echo json_encode($createNickname);

	 mysqli_close($conn);
}
?>