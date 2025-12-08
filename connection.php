<?php
$host = "localhost";
$user = "root";
$pass = "1234";
$db   = "taskmaster";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>
