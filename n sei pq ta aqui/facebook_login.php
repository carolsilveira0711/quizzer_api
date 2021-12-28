<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require_once '../config/config.php';
	
	$data_json = file_get_contents("php://input");
	$data = json_decode($data_json, true);
	$email = ($data['email']);
	$name = ($data['name']);
	$avatar_url = ($data['avatar_url']);
	$facebook_id = ($data['facebook_id']);
	$country = ($data['country']);

	// $password_data = md5(($data['password']));
	
	$query = mysqli_query($conn, "SELECT * FROM users WHERE email =	'$email' AND facebook_id = '$facebook_id'");
	$numrows = mysqli_num_rows($query);

	if ($numrows == 0) {
		$sql = "INSERT INTO users VALUES (DEFAULT, 
		'" . ($name) . "',
		'" . ($email) . "',
		'Facebook', '" . ($facebook_id) . "', now(), 1, '" . ($avatar_url) . "', 0, 10, 0, '" . ($country) . "', now(), 0, 0, 0, 0);";
	
		if (mysqli_query($conn, $sql)) {	
			$user = new \stdClass();
			$user->name = $name;
			$user->nickname = $nickname;
			$user->email = $email;
			$user->level_id = 1;
			$user->lives = 10;
			$user->facebook_id = $facebook_id;
			$user->coins = 0;
			$user->country = $country;
			$user->avatar_url = $avatar_url;
			$user->create_time = now();
			$user->is_premium = false;
			$user->lives_available = now();
			$user->item_change_question = 0;
			$user->item_erase_options = 0;
			$user->item_gain_time = 0;
			$user->item_next_question = 0;
	
			echo json_encode($user);
    	} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    	}
	
		mysqli_close($conn);
	} else {
		$result = array();

		$query_update_time = "UPDATE users SET avatar_url = '" . ($avatar_url) . "', name = '" . ($name) . "' where facebook_id ='" . ($facebook_id) . "'";
		$update_lives = mysqli_query($conn, $query_update_time);

		while($ingredient = mysqli_fetch_assoc($query)){
		$result = $ingredient;
	 }
	  	echo json_encode($result);
		mysqli_close($conn);
	}

}
?>