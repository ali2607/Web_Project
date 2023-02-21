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
    $pseudo = $_POST['floatingInput'];
    $mdp = $_POST['floatingPassword'];
    $conn = mysqli_connect($host, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected to the database";
    // Enregistrement d'un nouvel utilisateur
    if (isset($_POST["floatingInput"])) {
        //$username = mysqli_real_escape_string($conn, $_POST["username"]);
        //$password = mysqli_real_escape_string($conn, $_POST["password"]);

        if($_POST["floatingPassword"] != $_POST["floatingCPassword"] )
        {
            echo "Error: Password and confirmation password incorrect";
        }
        else
        {
            $query = "INSERT INTO user (username, password) VALUES ('$pseudo', '$mdp')";

            if (mysqli_query($conn, $query)) {
                // Enregistrement réussi
                header("Location: Login.php");
            } else {
                // Enregistrement échoué
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        }
    }

    // Connexion d'un utilisateur existant
    if (isset($_POST["login"])) {
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);

        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            // Connexion réussie
            session_start();
            $_SESSION["logged_in"] = true;
            $_SESSION["username"] = $username;
            header("Location: index.php");
        } else {
            // Connexion échouée
            echo "Incorrect username or password";
        }
    }

    // Déconnexion d'un utilisateur
    if (isset($_GET["logout"])) {
        session_start();
        session_destroy();
        header("Location: login.php");
    }

    mysqli_close($conn);

?>

  </body>
</html>