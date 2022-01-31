
<?php

$conn = mysqli_connect;

// Check connection

if ($conn->connect_error) {
    echo "Connection to database failed!";
} else {
    mysqli_set_charset($conn, 'utf8');
}
?>
