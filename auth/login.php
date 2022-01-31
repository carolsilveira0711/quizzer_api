<?php



session_start(); 



if ($_SERVER['REQUEST_METHOD'] == 'POST') {


	require_once '../config/config.php';

	$data_json = file_get_contents("php://input");

	$data = json_decode($data_json, true);

	$usr_id = ($data['usr_id']);

	$facebook = ($data['usr_facebook']);

	$countrycode = ($data['usr_country_code']);

    $ddd = ($data['usr_ddd']);

    $number = ($data['usr_number']);

	$ip = ($data['usr_ip']);

	$avatar = ($data['usr_avatar_url']);


    $_SESSION['usr_facebook'] = $facebook;



    $_SESSION['usr_country_code'] = $countrycode;



    $_SESSION['usr_ddd'] = $ddd;



    $_SESSION['usr_number'] = $number;





	if ($facebook == null){

		$query = mysqli_query($conn, "SELECT * FROM users 



										JOIN user_phone ON user_phone.users_usr_id = users.usr_id



										WHERE  usr_country_code = '" . ($countrycode) . "' AND usr_ddd = '" . ($ddd) . "' AND usr_number = '" . ($number) . "'");



		$numrows = mysqli_num_rows($query);



	} else {

		$query = mysqli_query($conn, "SELECT * FROM users 



										WHERE  usr_facebook = '" . ($facebook) . "'");



		$numrows = mysqli_num_rows($query);

	}	



	if ($numrows == 0) {

		$sql = "INSERT INTO users VALUES (DEFAULT, 



		null,



		null,



		null,



		'" . ($facebook) . "', 



		now(), 



		'".($avatar)."',



		null, 



		null,



		0,



		now(),



		'" . ($ip) . "',



		0);";

			

		$result = mysqli_query($conn,$sql);

		$user_id = mysqli_insert_id($conn);



		$insert_phone_query = "UPDATE user_phone SET usr_country_code = '".$countrycode."', usr_ddd = '".$ddd."', usr_number = '".$number."' WHERE users_usr_id = '".$user_id."'";				

		$phone_query_result = mysqli_query($conn, $insert_phone_query);

		$row = "SELECT * FROM users

		JOIN user_phone ON user_phone.users_usr_id = users.usr_id

		WHERE usr_country_code = '" . ($countrycode) . "' AND usr_ddd = '" . ($ddd) . "' AND usr_number = '" . ($number) . "'

		OR usr_facebook = '" . ($facebook) . "'";

		$final_result = array();

		$get_user_data_query = mysqli_query($conn, $row);

		while ($row_result = mysqli_fetch_assoc($get_user_data_query)){

			$final_result = $row_result;

		}

		echo json_encode($final_result);



		mysqli_close($conn);



	} else {

		$result = array();



		while($ingredient = mysqli_fetch_assoc($query)){



		$result = $ingredient;	



        $_SESSION['usr_facebook'] = $facebook;



		$_SESSION['logged_in'] = 'SIM';



        $_SESSION['usr_country_code'] = $countrycode;



        $_SESSION['usr_ddd'] = $ddd;



        $_SESSION['usr_number'] = $number;



	 }



	  	echo json_encode($result);



		mysqli_close($conn);



	}







}







?>