<?php
$host = "localhost:3306"; // O el IP de tu servidor
$user = "root";
$pass = "";
$basededatos = "deportes_kids";

$conn = mysqli_connect ($host, $user, $pass, $basededatos);

if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}
?>