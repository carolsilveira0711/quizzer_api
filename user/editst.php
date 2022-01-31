<?php

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {

    require_once '../config/config.php';

    $data_json = file_get_contents("php://input");

    $data = json_decode($data_json, true);

    $usr_id = ($data['usr_id']);
    $iusr_name = ($data['usr_name']);
    $iusr_nick = ($data['usr_nick']);
    $iusr_email = ($data['usr_email']);
    $iusr_country = ($data['usr_country']);
    $iusr_avatar_url = ($data['usr_avatar_url']);
    $iusr_rec_password = ($data['usr_rec_password']);

    $iusr_country_code = ($data['usr_country_code']);
    $iusr_ddd = ($data['usr_ddd']);
    $iusr_number = ($data['usr_number']);

    $sql = "UPDATE users 
    JOIN user_phone 
    ON user_phone.users_usr_id=users.usr_id
    JOIN user_lvl
    ON user_lvl.users_usr_id=users.usr_id 
    JOIN user_exp 
    ON user_exp.users_usr_id=users.usr_id 
    JOIN user_itm 
    ON user_itm.users_usr_id=users.usr_id                
    SET 
    usr_id = '$usr_id',      
    usr_name = '$iusr_name',
    usr_nick = '$iusr_nick',
    usr_email = '$iusr_email',
    usr_country = '$iusr_country',
    usr_avatar_url = '$iusr_avatar_url',
    usr_rec_password = '$iusr_rec_password',
    
    usr_country_code = '$iusr_country_code',
    usr_ddd = '$iusr_ddd',
    usr_number = '$iusr_number'
    
    WHERE usr_id = '$usr_id';";

    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $sql_get_user = "SELECT * FROM users WHERE usr_id = '" . ($usr_id) . "' ";

        $result_get_user = mysqli_query($conn,$sql_get_user);

        $row = mysqli_fetch_assoc($result_get_user);

        echo json_encode($row);

        mysqli_close($conn);

}

?>