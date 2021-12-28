<?php
session_start(); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require_once '../config/config.php';
	

	$data_json = file_get_contents("php://input");
	$data = json_decode($data_json, true);
	$email = ($data['usr_email']);
	$password_data = md5(($data['usr_rec_password']));

	$_SESSION['usr_email'] = $email;
	$_SESSION['usr_rec_password'] = $data['usr_rec_password'];

	$query = mysqli_query($conn, "SELECT * FROM users WHERE usr_email =	'$email' AND usr_rec_password = '$password_data'");
	$numrows = mysqli_num_rows($query);
	
	if ($numrows == 0) {
		echo "ok";
		mysqli_close($conn);
	} else {
		$result = array();
		while($ingredient = mysqli_fetch_assoc($query)){
		$result = $ingredient;
		$_SESSION['usr_name'] = $result['usr_name'];
		$_SESSION['usr_avatar_url'] = $result['usr_avatar_url'];
		$_SESSION['logged_in'] = 'SIM';
	 }

	  	echo json_encode($result);
		mysqli_close($conn);
	}

}

?>