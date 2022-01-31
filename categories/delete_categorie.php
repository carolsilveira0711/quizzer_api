<?php

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

	require_once '../config/config.php';
    mysqli_set_charset( $conn, 'utf8');	

    $data_json = file_get_contents("php://input");

	$data = json_decode($data_json, true);


    $cat_id = $data['cat_id'];

    $sql = "DELETE FROM categories WHERE cat_id = '" . ($cat_id) . "'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
      } else {
        echo "Error deleting record: " . $conn->error;
      }
      
      $conn->close();
}

?>