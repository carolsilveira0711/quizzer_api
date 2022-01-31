<?php



if ($_SERVER['REQUEST_METHOD'] == 'GET') {

	require_once '../config/config.php';

	mysqli_set_charset( $conn, 'utf8');	

    $usr_id = $_GET['usr_id'];



    $sql_grp = mysqli_query($conn, "SELECT * FROM itm_grp");  



    $results_grp = array();



	  while($row = mysqli_fetch_assoc($sql_grp)){

      $groupId = $row['itm_grp_id'];

      $groupName = $row['itm_grp_name'];

      $groupDesc = $row['itm_grp_desc'];



      $results_itm = array();

      $sql_itm = mysqli_query($conn, "SELECT * FROM items WHERE itm_grp_itm_grp_id =  '$groupId' ");



      while($row_2 = mysqli_fetch_assoc($sql_itm)){

        $results_itm[] = array(

          'itm_id' =>    $row_2['itm_id'],

          'itm_name' =>    $row_2['itm_name'],

          'itm_price' =>    $row_2['itm_price'],

          'itm_amount' =>    $row_2['itm_amount'],                  

          'itm_img' =>    $row_2['itm_img']

            );
      }



      $grp_array[] = array(

        'itm_grp_id' => $groupId,

        'title' => $groupName,

        'description' => $groupDesc,

        'items' =>  $results_itm

      );

	}



  $user = new \stdClass();

  $sql_usr_itm = mysqli_query($conn, "SELECT users.usr_id, users.usr_coins, user_itm.users_usr_id, user_itm.items_itm_id, SUM(user_itm.user_itm_amount), user_itm.user_itm_name
                                      FROM  users
                                      JOIN user_itm ON users.usr_id=user_itm.users_usr_id
                                      WHERE usr_id = '$usr_id'
                                      GROUP BY user_itm_name");
  $row_user_item = mysqli_fetch_assoc($sql_usr_itm);
                                      
  if( strcmp($row_user_item['user_itm_name'], 'item_change_question') == 0){
    $user->item_change_question = $row_user_item['SUM(user_itm.user_itm_amount)'];
   
  }

  while($row_result_item = mysqli_fetch_assoc($sql_usr_itm)){  
    if( strcmp($row_result_item['user_itm_name'], 'item_next_question') == 0){
      $user->item_next_question = $row_result_item['SUM(user_itm.user_itm_amount)'];
    }
    if( strcmp($row_result_item['user_itm_name'], 'item_gain_time') == 0){
      $user->item_gain_time = $row_result_item['SUM(user_itm.user_itm_amount)'];
    }
    if( strcmp($row_result_item['user_itm_name'], 'item_erase_options') == 0){
      $user->item_erase_options = $row_result_item['SUM(user_itm.user_itm_amount)'];
    }
    if( strcmp($row_result_item['user_itm_name'], 'lives') == 0){
      $user->lives = $row_result_item['SUM(user_itm.user_itm_amount)'];
    }
        
  }  

	$user->shop = $grp_array;

	echo json_encode($user);



  mysqli_error();





}

?>