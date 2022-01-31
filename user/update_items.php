<?php
require_once '../config_hmg/config_hmg.php';
mysqli_set_charset($conn, 'utf8');	

$data_json = file_get_contents("php://input");
$data = json_decode($data_json, true);

$user_id = ($data['users_usr_id']);
$item_id = ($data['itm_id']);
$item_amount = ($data['item_amount']);

$updated_user_item = mysqli_query($conn, "UPDATE user_itm SET '" . ($item_id) . "' = '" . ($item_amount) . "' WHERE id='" . ($user_id) . "'");



$user = new \stdClass();
$user->has_leveled_up = $updated_level > $current_level;
              
$userJson = json_encode($user);
            
echo $userJson;




?>