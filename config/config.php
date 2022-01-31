
<?php

$conn = mysqli_connect("localhost", "quizze33_dani", "l33th4x0", "quizze33_homo");

// Check connection

if ($conn->connect_error) {
    echo "Connection to database failed!";
} else {
    mysqli_set_charset($conn, 'utf8');
}
?>