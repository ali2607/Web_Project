<?php
    if(isset($_GET['action']))
    {   
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

        //echo $_POST["SignUp_Username"];
        if (empty($_POST["SignUp_Username"])) {
        echo "Error: username empty";
    }
    else if (empty($_POST["SignUp_Password"])) {
        echo "Error: pass empty";
    }
        else if (isset($_POST["SignUp_Username"]) && isset($_POST["SignUp_Password"])) {
            $pseudo = $_POST['SignUp_Username'];
            $mdp = $_POST['SignUp_Password'];
    
            if($_POST["SignUp_Password"] != $_POST["SignUp_ConfirmPassword"] )
            {
                echo "Error: Password and confirmation password incorrect";
            }
            else
            {
                $query = "INSERT INTO user (username, password) VALUES ('$pseudo', '$mdp')";
    
                if (mysqli_query($conn, $query)) {
                    // Enregistrement réussi
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
?>