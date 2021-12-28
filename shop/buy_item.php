<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require_once '../config/config.php';
	mysqli_set_charset( $conn, 'utf8');	

	$data_json = file_get_contents("php://input");
	$data = json_decode($data_json, true);
	$usr_id = $data['usr_id'];
	$itm_id = $data['itm_id'];

	//user quantidade de coins

	$user_coins = "SELECT users.usr_id, users.usr_coins, user_itm.user_itm_lives, user_itm.item_change_question, user_itm.item_next_question, user_itm.item_gain_time, user_itm.item_erase_options 
					FROM  users
					JOIN user_itm ON users.usr_id=user_itm.users_usr_id
					WHERE usr_id = '" . ($usr_id) . "'";

	$result_get_user = mysqli_query($conn, $user_coins);
	$row = mysqli_fetch_assoc($result_get_user);

	//fim moedas

	//items item selecionado

	$get_selected_item_query = "SELECT itm_id, itm_name, itm_price, itm_amount, itm_img, alias 
								FROM items 
								WHERE itm_id = '" . ($itm_id) . "'";

	$result_get_item = mysqli_query($conn, $get_selected_item_query);
	$row_selected_item = mysqli_fetch_assoc($result_get_item);

	//fim item


	//quantidade de moedas x valor do item
	if ($row_selected_item['itm_price'] <= $row['usr_coins']){	
		
		//valor do item / nome do item/ quantidade do item
		$item_price = $row_selected_item['itm_price'];
		$item_name = $row_selected_item['alias'];
		$item_amount = $row_selected_item['itm_amount'];
		//fim do valor do item

		//seleção do item na tabela usr_itm
		$get_user_item_amount = "SELECT '" . ($item_name) . "' FROM usr_itm WHERE users_usr_id = '" . ($usr_id) . "'";
		$get_user_item_amount_result = mysqli_query($conn, $get_user_item_amount);
		$row_user_item_amount = mysqli_fetch_assoc($get_user_item_amount_result);	
		$item_total_amount = $row_user_item_amount[$item_name];
		//fim da seleção do item 
 
		//cálculo da moeda - valor do item 
		$update_user_query = "UPDATE users SET usr_coins = usr_coins - '" . ($item_price) . "' , $item_name = $item_total_amount + $item_amount WHERE usr_id = '" . ($usr_id) . "'";
		$result_updated_user_coins = mysqli_query($conn, $update_user_query);
		//fim do calculo da moeda

		//atribui resultado da compra
		$final_query = "SELECT usr_coins FROM users where usr_id = '" . ($usr_id) . "'";
		$result_final_query = mysqli_query($conn, $final_query);
		$row_result = mysqli_fetch_assoc($result_final_query);
		

		$result = new \stdClass();
		$result->coins = $row_result['usr_coins'];
		$result->item_amount = $item_amount;
		$result->item_name = $row_selected_item['itm_name'];
		$result->item_price = $row_selected_item['itm_price'];
		$result->item_image = $row_selected_item['itm_img'];
		$result->message = "Item comprado com sucesso!";
		$result->status = 1;
		echo json_encode($result);
	} else {
		$result = new \stdClass();
		$result->message = "Item falhado com sucesso!";
		$result->status = 0;
		echo json_encode($result);
	}

	
		//echo json_encode($items);
}
?>