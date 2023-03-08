<?php
    if (isset ($_GET['action'])){
        switch($_GET['action'])
    { 
        case 'login':
            Login();
            break;

        case 'signup':
            SignUp();
            break;

        case 'logout':
            Logout();
            break;
    }
    }

// Enregistrement d'un nouvel utilisateur
function SignUp()
{
    include('../database/db.php');

    if (isset($_POST["SignUp_Username"]) && isset($_POST["SignUp_Password"])) {
        $pseudo = $_POST['SignUp_Username'];
        $mdp = $_POST['SignUp_Password'];

        $query = "SELECT * FROM user WHERE username = '$pseudo' ";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // User already exists
            session_start();
            $_SESSION['errormsg'] = "User already exists";
            header("Location: ../front/SignUp.php");
            exit();
        }

        if (empty($_POST["SignUp_Username"])) {
            session_start();
            $_SESSION['errormsg'] = "username is empty";
            header("Location: ../front/SignUp.php");
            exit();
        } else if (empty($_POST["SignUp_Password"])) {
            session_start();
            $_SESSION['errormsg'] = "password is empty";
            header("Location: ../front/SignUp.php");
            exit();
        } else if ($_POST["SignUp_Password"] != $_POST["SignUp_ConfirmPassword"]) {
            session_start();
            $_SESSION['errormsg'] = "Password and confirmation password incorrect";
            header("Location: ../front/SignUp.php");
            exit();
        } else {
            $query = "INSERT INTO user (username, password) VALUES ('$pseudo', '$mdp')";

            if (mysqli_query($conn, $query)) {
                // Enregistrement réussi
                $query = "SELECT idUser from user where username = '$pseudo' and password = '$mdp'";
                $result = mysqli_query($conn, $query);
                echo mysqli_num_rows($result);
                if (mysqli_num_rows($result) == '1') {
                    $row = mysqli_fetch_assoc($result);
                    $idUser = $row['idUser'];
                    echo $idUser;
                }

                header("Location: ../front/Login.php");
                $query = "INSERT INTO score (idUser, idJeu) VALUES ('$idUser', '1')";
                mysqli_query($conn, $query);
                $query = "INSERT INTO score (idUser, idJeu) VALUES ('$idUser', '2')";
                mysqli_query($conn, $query);
                header("Location: ../front/Login.php");
            } else {
                // Enregistrement échoué
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        }
    }

    mysqli_close($conn);
}

    // Connexion d'un utilisateur existant
    function Login()
    {
        include('../database/db.php');

        if (isset($_POST["Login_Username"])  && isset($_POST["Login_Password"])) {
            $pseudo = $_POST['Login_Username'];
            $mdp = $_POST['Login_Password'];
    
            $query = "SELECT * FROM user WHERE username = '$pseudo' AND password = '$mdp'";
            $result = mysqli_query($conn, $query);
    
            if (mysqli_num_rows($result) == 1) {
                // Connexion réussie
                session_start();
                // Récupérer une seule ligne
                while ($row = mysqli_fetch_row($result)) {
                    $_SESSION["logged_in"] = true;
                    $_SESSION["idUser"] = $row[0];
                    $_SESSION["username"] = $row[1];
                }
                mysqli_free_result($result);
    
                header("Location: ../front/Accueil.php");
            } else {
            // Connexion échouée
            session_start();
            $_SESSION['errormsg'] = "Incorrect username or password";
            header("Location: ../front/Login.php");
            }

        }

        mysqli_close($conn);
    }

    // Déconnexion d'un utilisateur
    function Logout()
    {
        session_start();
        session_destroy();
        header("Location: ../front/Accueil.php");
    }
