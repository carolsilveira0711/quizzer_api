<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require_once '../config/config.php';
	
	$data_json = file_get_contents("php://input");
	$data = json_decode($data_json, true);
	
	$name = ($data['usr_name']);
	$email = ($data['usr_email']);
	$password = ($data['usr_rec_password']);
	$password_encrypted = md5($password);
	$face = ($data['usr_facebook']);
	$country = ($data['usr_country']);
	$nickname = ($data['usr_nick']);
	$ip= ($data['usr_ip']);	
	$countrycode = ($data['usr_country_code']);
	$ddd = ($data['usr_ddd']);
	$number= ($data['usr_number']);
	

	if ($face != null){
		
		$query = mysqli_query($conn, "SELECT * from users JOIN user_phone ON user_phone.users_usr_id = users.usr_id WHERE usr_email =	'" . ($email) . "' ");
		$numrows = mysqli_num_rows($query);

		$avatar_url = "http://quizzer-app.com.br/images/ic_man.png";

		if ($numrows == 0) {
		$sql = "INSERT INTO users VALUES (DEFAULT, 
		'" . ($name) . "',
		'" . ($email) . "',
		'" . ($password_encrypted) . "',
		'" . ($face) . "', 
		now(), 
		'" . ($avatar_url) . "',
		'" . ($country) . "', 
		'" . ($nickname) . "',
		0,
		now(),
		'" . ($ip) . "',
		0);";
				
		$result = mysqli_query($conn,$sql);

		$sql_get_user = "SELECT * from users JOIN user_phone ON user_phone.users_usr_id = users.usr_id WHERE usr_number =	'" . ($number) . "' ";

			$result_get_user = mysqli_query($conn,$sql_get_user);
			$row = mysqli_fetch_assoc($result_get_user);
			$user_id = $row['usr_id'];

			$insert_phone_query = "UPDATE user_phone SET
			usr_ddd = '" . ($countrycode) . "',
			usr_number = '" . ($ddd) . "',
			usr_ip = '" . ($number) . "';";	
				
				

			$phone_query_result = mysqli_query($conn, $insert_phone_query);
			
			mysqli_error();
			echo json_encode($row);
			mysqli_close($conn);

		} else {

			echo "ja existe usuario cadastrado com este e-mail!";
			mysqli_close($conn);
		}
	}
	

	if($number != null){
		$query = mysqli_query($conn, "SELECT * from users JOIN user_phone ON user_phone.users_usr_id = users.usr_id WHERE usr_email =	'" . ($email) . "' ");
		$numrows = mysqli_num_rows($query);

		$avatar_url = "http://quizzer-app.com.br/images/ic_man.png";

		if ($numrows == 0) {
		$sql = "INSERT INTO users VALUES (DEFAULT, 
		'" . ($name) . "',
		'" . ($email) . "',
		'" . ($password_encrypted) . "',
		'" . ($face) . "', 
		now(), 
		'" . ($avatar_url) . "',
		'" . ($country) . "', 
		'" . ($nickname) . "',
		0,
		now(),
		'" . ($ip) . "'
		);";

				
		$result = mysqli_query($conn,$sql);
		$sql_get_user = "SELECT * from users JOIN user_phone ON user_phone.users_usr_id = users.usr_id WHERE usr_number =	'" . ($number) . "' ";

		$result_get_user = mysqli_query($conn,$sql_get_user);
		$row = mysqli_fetch_assoc($result_get_user);
		$user_id = $row['usr_id'];

		$insert_phone_query = "INSERT INTO user_phone VALUES(
			'" . ($user_id) . "',
			'" . ($countrycode) . "',
			'" . ($ddd) . "',
			'" . ($number) . "')";

		$phone_query_result = mysqli_query($conn, $insert_phone_query);

		mysqli_error();
		echo json_encode($row);
		mysqli_close($conn);
		}
	}
}

?>