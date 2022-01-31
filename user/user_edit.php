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

    $iusr_is_premium = ($data['usr_is_premium']);

    $iusr_ip = ($data['usr_ip']); 



    $iusr_country_code = ($data['usr_country_code']);

    $iusr_ddd = ($data['usr_ddd']);

    $iusr_number = ($data['usr_number']);



    $ilevel_lvl_id = ($data['level_lvl_id']);

    $iexp_current = ($data['exp_current']);



    $iusr_coins = ($data['usr_coins']);

    $iuser_itm_lives = ($data['user_itm_lives']);

    $iitem_change_question = ($data['item_change_question']);

    $iitem_next_question = ($data['item_next_question']);

    $iitem_gain_time = ($data['item_gain_time']);

    $iitem_erase_options = ($data['item_erase_options']);

    

    $sql = "UPDATE users 

            INNER JOIN user_phone 

            ON user_phone.users_usr_id=users.usr_id

            JOIN user_lvl

            ON user_lvl.users_usr_id=users.usr_id 

            JOIN user_exp 

            ON user_exp.users_usr_id=users.usr_id 

            JOIN user_itm 

            ON user_itm.users_usr_id=users.usr_id                

        

            SET

            usr_id = '" . ($usr_id) . "',

            usr_name = '" . ($iusr_name) . "',

            usr_nick = '" . ($iusr_nick) . "',

            usr_email = '" . ($iusr_email) . "',

            usr_country = '" . ($iusr_country) . "',

            usr_avatar_url = '" . ($iusr_avatar_url) . "',

            usr_rec_password = '" . ($iusr_rec_password) . "',

            usr_is_premium = '" . ($iusr_is_premium) . "',

            usr_ip = '" . ($iusr_ip) . "',

            

            usr_country_code = '" . ($iusr_country_code) . "',

            usr_ddd = '" . ($iusr_ddd) . "',

            usr_number = '" . ($iusr_number) . "',



            level_lvl_id = '" . ($ilevel_lvl_id) . "',



            exp_current = '" . ($iexp_current) . "',



            usr_coins = '" . ($iusr_coins) . "',

            user_itm_lives = '" . ($iuser_itm_lives) . "',

            item_change_question = '" . ($iitem_change_question) . "',

            item_next_question = '" . ($iitem_next_question) . "',

            item_gain_time = '" . ($iitem_gain_time) . "',

            item_erase_options = '" . ($iitem_erase_options) . "'           



            WHERE usr_id = '" . ($usr_id) . "'

            ;";



        $result = mysqli_query($conn,$sql) or die(mysqli_error());



        $sql_get_user = "SELECT * FROM users WHERE usr_id = '" . ($usr_id) . "' ";



        $result_get_user = mysqli_query($conn,$sql_get_user);



        $row = mysqli_fetch_assoc($result_get_user);



        mysqli_error();



        echo json_encode($row);



        mysqli_close($conn);



        



}

?>