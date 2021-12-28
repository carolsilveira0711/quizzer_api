<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require_once '../config/config.php';
	
	$data_json = file_get_contents("php://input");
	$data = json_decode($data_json, true);

	$nickname = ($data['usr_nick']);
	$user_id = ($data['usr_id']);
	
	$query = mysqli_query($conn, "SELECT * FROM users WHERE usr_nick =	'$nickname'");
	$numrows = mysqli_num_rows($query);

	if ($numrows == 0) {
		echo "não existe";
		$insert_user_query = mysqli_query($conn, "UPDATE users SET usr_nick = '" . ($nickname) . "' WHERE usr_id =	'" . ($user_id) . "'");
		$result = false;
	} else {
		echo "existe";
		$result = true;
	 }

	 $createNickname = new \stdClass();
	 $createNickname->result = $result;

	 echo json_encode($createNickname);

	 mysqli_close($conn);
}
?>