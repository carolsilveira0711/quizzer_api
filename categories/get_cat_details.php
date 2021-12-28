<?php 

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	require_once '../config/config.php';
	mysqli_set_charset( $conn, 'utf8');

    $cat_id = $_GET['cat_id'];

    $sql = "SELECT * FROM categories
            WHERE cat_id = '" . ($cat_id) . "'";

    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    echo json_encode($row);

}

?>