<?php

require '../config/config.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $filter_col =  $_GET['column'];
    $search_input = $_GET['search_input'];

    $u = mysqli_query ($conn, "SELECT * FROM items WHERE $filter_col LIKE '%".$search_input."%'");

    $numrows = mysqli_num_rows($u);

    if ($numrows == 0){
        mysqli_close($conn);
        echo 'não';
    }else{
        $results = array();

        while($row = mysqli_fetch_array($u)){
            $results[] = array (
                'itm_id' =>    $row['itm_id'],
                'itm_name' =>    $row['itm_name'],
                'itm_price' =>    $row['itm_price'],
                'itm_amount' =>    $row['itm_amount'],
                'itm_is_hot' =>    $row['itm_is_hot'],
                'itm_group_id' =>    $row['itm_group_id'],
                'itm_img' =>    $row['itm_img'],
                'alias' =>    $row['alias']);
        }
    }
}
    echo json_encode($results); 
?>