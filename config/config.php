<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'apidb');
define('TABLE', 'users');
define('CMuser', 'username'); // CM == Column Name
define('CMpassword', 'pass'); // RT == Row of Table
$con = mysqli_connect(HOST, USER, PASS, DBNAME) or die('Não foi possível conectar');
$statusCon = $con;
if($statusCon){
    $statusCon = 200;
}
?>