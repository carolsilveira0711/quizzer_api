<?php
session_start(); 	
    
    function getUserData(){       
        require_once 'config.php';

        $array = array();
        $q= mysqli_query($conn, "SELECT * FROM users;");
        $numrows = mysqli_num_rows($q);
        while($row = mysqli_fetch_assoc($q)) {   

            array_push($array,$row);
        }
        
        return $array;
    }

?>
