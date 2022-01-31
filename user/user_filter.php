<?php

require '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $data_json = file_get_contents("php://input");
	$data = json_decode($data_json, true);
    $filter_col = ($data['column']);
    $search_input = ($data['search_input']);
    $u= mysqli_query($conn, "SELECT usr_id, usr_name, usr_email  FROM users WHERE $filter_col LIKE '%".$search_input."%'");
    $numrows = mysqli_num_rows($u);

        if ($numrows == 0) {
            mysqli_close($conn);
            echo 'não';
        } else {
            $results = array();
	        while($row = mysqli_fetch_array($u)){
                $results[] = array(
                'usr_id' =>    $row['usr_id'],
                'usr_name' =>    $row['usr_name'],
                'usr_email' =>    $row['usr_email'],
                'usr_create_time' =>    $row['usr_create_time'],
                'usr_nick' =>    $row['usr_nick'],
                'usr_is_premium' =>    $row['usr_is_premium']);                
	            }
            }  
        
}

        echo json_encode($results);    
        
?>