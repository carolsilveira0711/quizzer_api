<?php
require_once '../config_hmg/config_hmg.php';
mysqli_set_charset($conn, 'utf8');	

$data_json = file_get_contents("php://input");
$data = json_decode($data_json, true);

$user_id = ($data['usr_id']);
$exp_amount = ($data['exp_amount']);

// Pegar nivel atual do jogador

$user_current_level = mysqli_query($conn, "SELECT * FROM users 
                                            JOIN user_lvl ON user_lvl.users_usr_id=users.usr_id 
                                            JOIN level ON level.level_id=user_lvl.level_lvl_id
                                            WHERE usr_id='" . ($user_id) . "'");
$user_levels = array();
$current_level = 1;

while($row = mysqli_fetch_array($user_current_level))
{
    $current_level = $row['level_lvl_id'];
    $user_country = $row['usr_country'];
}

//nivel homologação configurado e testado no wb


// Atualiza EXP do usuário para o conteúdo de exp_amount - homologação testado no wb

$update_user_exp = mysqli_query($conn, "UPDATE user_exp 
                                        SET exp_current = exp_current + '" . ($exp_amount) . "',
                                        usr_country = '" . ($user_country) . "'
                                        WHERE users_usr_id = '" . ($user_id) . "'");


// Se a EX

$user_exp_result = mysqli_query($conn, "SELECT exp_current FROM user_exp 
                                        WHERE users_usr_id = '" . ($user_id) . "'");
$user_exp_array = mysqli_fetch_assoc($user_exp_result);
$user_exp = $user_exp_array['exp_current'];

// echo $user_exp;

// validação do update de xp precisa ser testada dentro do app

$updated_user_level = mysqli_query($conn,  "SELECT * FROM level 
                                            WHERE exp_need <= '" . ($user_exp) . "' ORDER BY ID DESC LIMIT 1");
$results = array();
$updated_level = 1;
while($row = mysqli_fetch_array($updated_user_level))
{
    $updated_level = $row['usr_lvl_id'];
}

mysqli_query($conn, "UPDATE user_lvl 
                    SET usr_lvl_id = " . $updated_level . " 
                    WHERE users_usr_id='$user_id'");

// echo "Updated Level: '" . ($updated_level) . "'";
// echo "Current Level: '" . ($current_level) . "'";

$user = new \stdClass();
$user->has_leveled_up = $updated_level > $current_level;
$user->exp_points = $user_exp;
$user->old_level = $current_level;
$user->new_level = $updated_level;
              
$userJson = json_encode($user);
            
echo $userJson;




?>