<?php



require '../config/config.php';



if ($_SERVER['REQUEST_METHOD'] == 'GET') {



    $filter_col =  $_GET['column'];

    $search_input = $_GET['search_input'];





    $u= mysqli_query($conn, "SELECT qst_id, qst_title, asw_1, asw_2, asw_3, asw_4, asw_number, qst_difficulty, categories_cat_id FROM question WHERE $filter_col LIKE '%".$search_input."%'");

    $numrows = mysqli_num_rows($u);   




        if ($numrows == 0) {

            mysqli_close($conn);

            echo 'não';

        } else {

            $results = array();

	        while($row = mysqli_fetch_array($u)){

                $results[] = array(

                'qst_id' =>    $row['qst_id'],

                'qst_title' =>    $row['qst_title'],

                'asw_1' =>    $row['asw_1'],

                'asw_2' =>    $row['asw_2'],

                'asw_3' =>    $row['asw_3'],

                'asw_4' =>    $row['asw_4'],

                'asw_number' =>    $row['asw_number'],

                'qst_difficulty' =>    $row['qst_difficulty'],

                'categories_cat_id' =>    $row['categories_cat_id']);

	            }

            }          

}

        echo json_encode($results);    

        

?>