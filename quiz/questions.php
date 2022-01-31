<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	require_once '../config/config.php';
	mysqli_set_charset( $conn, 'utf8');	

	$category_id = $_GET['categories_cat_id'];
	$difficulty = $_GET['qst_difficulty'];
	$question_amount = $_GET['qst_amount'];
	
	$min_amount = 0;
	
	$sql = "SELECT * FROM question 
			WHERE categories_cat_id = '$category_id'
			AND qst_difficulty = '$difficulty' 
			AND LIMIT $min_amount, $question_amount";

echo $question_amount;

	if ($difficulty == 0) {
		$exp_points = 5;
	} elseif ($difficulty == 1){
		$exp_points = 10;
	} elseif ($difficulty == 2) {
		$exp_points = 15;
	} elseif ($difficulty == 3) {
		$exp_points = 20;
	} 

	$result = mysqli_query($conn, $sql);
	$results = array();
while($row = mysqli_fetch_array($result))
{
   $results[] = array(
	  'qst_title' =>    $row['qst_title'],
	  'exp_points' =>  $exp_points,
	  'answers_list' => array([
             'asw_1' => $row['asw_1'],
			 'asw_2' => $row['asw_2'],
			 'asw_3' => $row['asw_3'],
			 'asw_4' => $row['asw_4']
            ]),
	  'correct_answer' => $row['asw_number'],
   );
}
echo json_encode($results);
	
}
?>