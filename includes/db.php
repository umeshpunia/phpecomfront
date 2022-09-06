<?php
session_start();

define('HOST', 'localhost');
define('USERNAME', 'root');
define('PASS', '');
define('DBNAME', '10am');


$conn=mysqli_connect(HOST,USERNAME,PASS,DBNAME);

?>