<?php
 session_start();
 $host = 'localhost';
 $user = 'root';
 $pass = '';
 $db = 'tadwinat';

 $conn = mysqli_connect($host,$user,$pass,$db);
 // Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error()  ;
}
