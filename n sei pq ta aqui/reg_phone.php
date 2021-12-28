<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../config/config.php';

    $data_json = file_get_contents("php://input");
	$data = json_decode($data_json, true);
    
    $name = ($data['usr_name']);
    $password = ($data['usr_rec_password']);
	$password_encrypted = md5($password);
    $country = ($data['usr_country']);
	$nickname = ($data['usr_nick']);
    $ip = ($data['usr_ip']);
    $country_code = ($data['usr_country_code']);
    $ddd = ($data['usr_ddd']);
    $number = ($data['usr_number']);

    $query = mysqli_query($conn, "SELECT * FROM users JOIN user_phone ON user_phone.users_usr_id = users.usr_id WHERE usr_number = '" . ($usr_number) . "' ");
	$numrows = mysqli_num_rows($query);

    $avatar_url = "http://quizzer-app.com.br/images/ic_man.png";

    if ($numrows == 0) {
        $sql = "INSERT INTO users VALUES (DEFAULT, 
        '" . ($name) . "',
        null,
        '" . ($password_encrypted) . "',
        null,
        now(),
        '" . ($avatar_url) . "',
        '" . ($country) . "', 
        '" . ($nickname) . "',
        0,
        now(),
        '" . ($ip) . "',
        0 );";

        $result = mysqli_query($conn,$sql);

        $sql_get_user = "SELECT * FROM user_phone JOIN users ON users.usr_id = user_phone.users_usr_id WHERE usr_nick = '" . ($nickname) . "'";	
	    $result_get_user = mysqli_query($conn,$sql_get_user);
        $row = mysqli_fetch_assoc($result_get_user);
        $id = $row['users_usr_id'];
	   
        $ph_sql = "UPDATE user_phone SET 
        usr_country_code = '" . ($country_code) . "',
	    usr_ddd = '" . ($ddd) . "',
	    usr_number = '" . ($number) . "' 
        WHERE users_usr_id = '" . ($id) . "';";
        $insert_phone_query = mysqli_query($conn, $ph_sql);

        $result_get_user_final = mysqli_query($conn,$sql_get_user);
        mysqli_error();
		echo json_encode($result_get_user_final);
        mysqli_close($conn);
		
    }else{
		echo "ja existe usuario cadastrado com este telefone!";
		mysqli_close($conn);
	}
}

?>