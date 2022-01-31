<?php
require_once '../config/config.php';
mysqli_set_charset($conn, 'utf8');	

$data_json = file_get_contents("php://input");
$data = json_decode($data_json, true);

$user_id = ($data['usr_id']);
$exp_amount = ($data['exp_amount']);

// Pegar nivel atual do jogador

$user_current_level = mysqli_query($conn, "SELECT * FROM users 
                                            JOIN user_lvl ON user_lvl.users_usr_id=users.usr_id 
                                            JOIN level ON level.lvl_id=user_lvl.level_lvl_id
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
                                        SET exp_current = exp_current + '$exp_amount'                                     
                                        WHERE users_usr_id = '" . ($user_id) . "'");



//teste carol 24-01-22


//quantidade de xp na tabela user xp

$user_exp_current = mysqli_query($conn, "SELECT exp_current FROM user_exp 
                                        WHERE users_usr_id = '" . ($user_id) . "'");
$user_exp_array = mysqli_fetch_assoc($user_exp_current);

$user_exp = $user_exp_array['exp_current'];

//lvl do usuario

$user_lvl_current = mysqli_query($conn, "SELECT * FROM user_lvl 
                                            WHERE users_usr_id = '" . ($user_id) . "'");
$user_lvl_array = mysqli_fetch_assoc($user_lvl_current);

$user_lvl = $user_lvl_array['level_lvl_id'];


//quantidade de xp necessaria na tabela lvl

$exp_need_level = mysqli_query($conn,  "SELECT * FROM level ");

$row = mysqli_fetch_array($updated_user_level);

$level_exp = $row['exp_need'];
$updated_level = $row['lvl_id'];


//validando se a current exp do usuário é igual ou maior que a exp need

if($user_exp >= $level_exp && $$updated_level < $user_lvl){
    echo $user_exp;
    echo $level_exp;
    $updated_user_level = mysqli_query($conn, "UPDATE user_lvl 
                                                SET level_lvl_id = level_lvl_id + 1 
                                                WHERE users_usr_id ='$user_id'");
}else{
    echo $level_exp;
};






// // Se a EX

// $user_exp_result = mysqli_query($conn, "SELECT exp_current FROM user_exp 
//                                         WHERE users_usr_id = '" . ($user_id) . "'");
// $user_exp_array = mysqli_fetch_assoc($user_exp_result);
// $user_exp = $user_exp_array['exp_current'];

// // echo $user_exp;

// // validação do update de xp precisa ser testada dentro do app

// $updated_user_level = mysqli_query($conn,  "SELECT * FROM level 
//                                             WHERE exp_need <= '" . ($user_exp) . "' ORDER BY ID DESC LIMIT 1");
// $results = array();

// while($row = mysqli_fetch_array($updated_user_level))
// {
//     $updated_level = $row['lvl_id'];
// }

// mysqli_query($conn, "UPDATE user_lvl 
//                     SET level_lvl_id = level_lvl_id +  " . $updated_level . " 
//                     WHERE users_usr_id='$user_id'");

// // echo "Updated Level: '" . ($updated_level) . "'";
// // echo "Current Level: '" . ($current_level) . "'";

$user = new \stdClass();
$user->has_leveled_up = $updated_level > $current_level;
$user->exp_points = $user_exp;
$user->old_level = $current_level;
$user->new_level = $updated_level;
              
$userJson = json_encode($user);
            
echo $userJson;




?>