<?php
session_start(); 	
    
    function getQuestionData(){       
        require_once 'config.php';

        $array = array();
        $q= mysqli_query($conn, "SELECT * FROM question;");
        $numrows = mysqli_num_rows($q);
        while($row = mysqli_fetch_assoc($q)) {         

            array_push($array,$row);
        }
        
        return $array;
    }

?>