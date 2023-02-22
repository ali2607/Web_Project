<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <title>Bootstrap Example</title>
    <style>

    </style>
</head>


<body>
<?php

// Connexion à la base de données
$host = "127.0.0.1:3306";
$username = "root";
$password = "";
$dbname = "projet_web";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected to the database";
// Connexion d'un utilisateur existant
//echo array_search('ali',$_POST);
if (isset($_POST["floatingInput"])) {
  echo" zfezf";
    $username = mysqli_real_escape_string($conn, $_POST["floatingInput"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    echo $username ;
    echo $password ;

    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    echo mysqli_num_rows($result);
    if (mysqli_num_rows($result) == 1) {
        // Connexion réussie
        session_start();
        $_SESSION["logged_in"] = true;
        $_SESSION["username"] = $username;
        echo "CEST BON";
        header("Location: Accueilco.php");
    } else {
        // Connexion échouée
        echo "Incorrect username or password";
    }
}
/*
// Déconnexion d'un utilisateur
if (isset($_GET["logout"])) {
    session_start();
    session_destroy();
    header("Location: login.php");
}
*/
mysqli_close($conn);

?>

</body>
</html>