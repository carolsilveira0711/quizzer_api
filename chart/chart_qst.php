<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	require_once '../config/config.php';
	mysqli_set_charset( $conn, 'utf8');	

    $sql = "SELECT COUNT(qst_id), categories. cat_name from question join categories on question.categories_cat_id=categories.cat_id where categories_cat_id = cat_id group by cat_name;";

    $result = mysqli_query($conn, $sql);

    $data = array();
    foreach ($result as $row){
        $data[] = $row;
    }

    echo json_encode($data);
}

?>