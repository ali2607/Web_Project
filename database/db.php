<?php
// Connexion à la base de données
$host = "localhost";
$username = "root";
$password = "";
$dbname = "bddprojetweb";
$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
    
?>

