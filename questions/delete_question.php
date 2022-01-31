<?php

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

	require_once '../config/config.php';
    mysqli_set_charset( $conn, 'utf8');	

    $data_json = file_get_contents("php://input");

	$data = json_decode($data_json, true);


    $qst_id = $data['qst_id'];

    $sql = "DELETE FROM question WHERE qst_id = '" . ($qst_id) . "'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
      } else {
        echo "Error deleting record: " . $conn->error;
      }
      
      $conn->close();
}

?>