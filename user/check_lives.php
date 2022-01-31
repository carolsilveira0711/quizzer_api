<?php
use Datetime as DT;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	
	require_once '../config/config.php';
	mysqli_set_charset( $conn, 'utf8');	

	$user_id = $_GET['usr_id'];
	
	$sql = "SELECT * FROM users 
			JOIN user_itm ON users.usr_id=user_itm.users_usr_id 
			WHERE usr_id = '" . ($user_id) . "'";

	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);

	$user_lives = $row['user_itm_lives'] - 1;

	if ($row['user_itm_lives'] > 0) {
		$update_lives = "UPDATE user_itm SET user_itm_lives='" . ($user_lives) . "' WHERE users_usr_id = '" . ($user_id) . "'";
		$updated_result = mysqli_query($conn, $update_lives);
		if ($user_lives == 0) {
			$query_update_time = "UPDATE users SET usr_lives_available = ADDTIME(now(), '24:0:0') where usr_id ='" . ($user_id) . "'";
			$update_lives = mysqli_query($conn, $query_update_time);
		}
		$arr = array(
			'response' => true,
			'time' => 'Has Lives'
		);
		echo json_encode($arr);
	} else {
		$get_next_time_query = "SELECT usr_lives_available, NOW() as `now` FROM users WHERE usr_id ='" . ($user_id) . "'";
		$get_next_time_result = mysqli_query($conn, $get_next_time_query);

		while($row = mysqli_fetch_array($get_next_time_result)) {
			$time_formatted = new DateTime($row['usr_lives_available']);
			$now_formatted = new DateTime($row['now']);
			$dteDiff  = $time_formatted->diff($now_formatted);
		}

		$arr = array(
			'response' => false,
			'time' => $dteDiff->format("%H:%I:%S")
		);
		echo json_encode($arr);
	}	
}
?>