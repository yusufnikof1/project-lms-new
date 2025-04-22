<?php
$host = 'localhost:4306';
$user = 'root';
$pass = '';
$db = 'manajemen_modul';

$con = mysqli_connect($host, $user, $pass, $db);

if (!$con) {
    die("Connection Failed" . mysqli_connect_error());
    echo "Connection Failed";
}
