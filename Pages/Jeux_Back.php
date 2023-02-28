<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

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

    function get_score(){
        
    }
    // Récupère meilleur score
    if (isset($_SESSION["logged_in"]) && ($_SESSION["logged_in"])){
        $score = $_POST['score'];
        $idJoueur = $_SESSION['idUser'];
        $query = "SELECT personalBest FROM score WHERE idUser = '$idJoueur'";
        $result = mysqli_query($conn, $query);
        echo $result;
      }

    // Enregistrement d'un meilleur score
    if (isset($_SESSION["logged_in"]) && ($_SESSION["logged_in"]) && isset($_POST["score"])){
      $score = $_POST['score'];
      $idJoueur = $_SESSION['idUser'];
      $query = "SELECT personalBest FROM score WHERE idUser = '$idJoueur'";
      $result = mysqli_query($conn, $query);
      echo $result;
    }


?>

  </body>
</html>