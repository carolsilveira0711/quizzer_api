<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	require_once '../config/config.php';
	mysqli_set_charset( $conn, 'utf8');	

	$usr_id = $_GET['usr_id'];
	
	$sql = "SELECT * from user_exp inner join users on users.usr_id = user_exp.users_usr_id join user_lvl on user_lvl.users_usr_id = users.usr_id ORDER BY user_exp.exp_current desc limit 0,10";

	$result = mysqli_query($conn, $sql);
	$results = array();

	
while($row = mysqli_fetch_array($result))
{
	
	
   $results[] = array(
	  'exp' =>    $row['exp_current'],
	  'id' =>    $row['users_usr_id'],
	  'level_id' =>    $row['level_lvl_id'],
	  'nickname' =>    $row['usr_nick'],
	  'avatar_url' =>    $row['usr_avatar_url'],
	  'country' =>    $row['usr_country']
   );  
}

$world_rank_query = "SELECT users_usr_id from user_exp group by users_usr_id order by exp_current desc";

	$execute_world_rank_query = mysqli_query($conn, $world_rank_query);



    while($rozona = mysqli_fetch_array($execute_world_rank_query)){

        $world_rank[] = $rozona['users_usr_id'];

        }

		$world_position = array_search($usr_id, $world_rank) + 1;

$user_rank = new \stdClass();

$user_sql = mysqli_query ($conn, "SELECT users.usr_id, user_exp.exp_current, users.usr_nick, users.usr_avatar_url, user_lvl.level_lvl_id
from user_exp
join users on users.usr_id = user_exp.users_usr_id
join user_lvl on user_lvl.users_usr_id = users.usr_id
where usr_id  = '$usr_id'"); 

$row_user_rank = mysqli_fetch_assoc ($user_sql);

$user_rank -> user_id = $row_user_rank ['usr_id'];
$user_rank -> user_exp = $row_user_rank ['exp_current'];
$user_rank -> user_nick = $row_user_rank ['usr_nick'];
$user_rank -> user_avatar = $row_user_rank ['usr_avatar_url'];
$user_rank -> user_lvl = $row_user_rank ['level_lvl_id'];
$user_rank -> user_position = $world_position;




$user_rank -> rank = $results;

echo json_encode($user_rank);


}
?>