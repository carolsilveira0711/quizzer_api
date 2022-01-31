<?php 
require_once '../config/config.php';
mysqli_set_charset( $conn, 'utf8');

$table = 'question';

$primaryKey = 'qst_id';

$columns = array(
    array ('db' => 'qst_id', 'dt' => 0),
    array ('db' => 'qst_title', 'dt' => 1),
    array ('db' => 'asw_1', 'dt' => 2),
    array ('db' => 'asw_2', 'dt' => 3),
    array ('db' => 'asw_3', 'dt' => 4),
    array ('db' => 'asw_4', 'dt' => 5),
    array ('db' => 'asw_number', 'dt' => 6),
    array ('db' => 'qst_difficulty', 'dt' => 7),
    array ('db' => 'categories_cat_id', 'dt' => 8),
 
);

$sql_details = array($conn);

require( 'ssp.class.php' );
 
echo json_encode($_GET, $conn, $sql_details, $table, $primaryKey, $columns );
    
    ?>