<?php
use Datetime as DT;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	require_once '../config/config.php';
	mysqli_set_charset( $conn, 'utf8');	

    $usr_id = $_GET['usr_id'];

    $sql = "SELECT * FROM users JOIN user_phone 
    ON user_phone.users_usr_id=users.usr_id 
    JOIN user_lvl
    ON user_lvl.users_usr_id=users.usr_id 
    JOIN user_exp 
    ON user_exp.users_usr_id=users.usr_id 
    JOIN user_itm 
    ON user_itm.users_usr_id=users.usr_id";

    $result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);

    $time_formatted = new DateTime($row['user_itm_lives_available']);
	$now_formatted = new DateTime();

    $test = date_format($time_formatted,'Y-m-d H:i:s');
	$test2 = date_format($now_formatted,'Y-m-d H:i:s');

    $world_rank_query = "SELECT users_usr_id from user_exp group by users_usr_id order by exp_current desc";
	$execute_world_rank_query = mysqli_query($conn, $world_rank_query);
	while($rozona = mysqli_fetch_array($execute_world_rank_query))
{
   $world_rank[] = $rozona['users_usr_id'];
}
    $user_country = $row['usr_country'];
    $local_rank_query = "SELECT users_usr_id from user_exp JOIN users ON users.usr_id=user_exp.users_usr_id WHERE usr_country = '" . ($user_country) . "' ORDER BY exp desc";
    $execute_local_rank_query = mysqli_query($conn, $local_rank_query);
    while($local_rank_query_row = mysqli_fetch_array($execute_local_rank_query))
{
$local_rank[] = $local_rank_query_row['users_usr_id'];
}

if ($now_formatted > $time_formatted && $row['user_itm_lives'] == 0) {
    $lives = 0;
    if ($row['usr_is_premium'] == "1") {
        $lives = 50;
    } else {
        $lives = 10;
    }
    $query_update_time = "UPDATE users JOIN user_itm 
    on user_itm.user_usr_id=users.usr_id 
    SET user_itm_lives = '" . ($lives) . "' where users_usr_id ='" . ($user_id) . "'";
    $update_lives = mysqli_query($conn, $query_update_time);
    $row['user_itm_lives'] = $lives;
}

    $level_id = $row['lvl_id'];

	$world_position_query = "SELECT * FROM user_exp INNER JOIN users ON
	user_exp.users_usr_id = users.usr_id 
	ORDER BY user_exp.exp_current DESC LIMIT 0, 10 WHERE users.user_id = '" . ($user_id) . "'";

	$result = mysqli_query($conn, $world_position_query);

	$row['world_pos'] = array_search($user_id, $world_rank) + 1;
	$row['local_pos'] = array_search($user_id, $local_rank) + 1;
	
	$previous_exp_needed = mysqli_query($conn, "SELECT exp_need FROM level WHERE lvl_id = '" .  $level_id . "'");
	$previous_exp_needed_array = mysqli_fetch_assoc($previous_exp_needed);
	$previous_user_exp = $previous_exp_needed_array['exp_need'];
	
	$row['usr_id'] = $user_id;
    $row['exp_prev'] = $previous_user_exp;	

    echo json_encode($row);

}

?>
