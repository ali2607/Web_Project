<?php

    if(isset($_GET['action']))
    {   
        switch($_GET['action'])
        { 
            case 'savepb':
                echo 'test';
                SavePersonalBest();
                break;
        }
    }

    // Récupération du meilleur score actuel
    function GetPersonalBest()
    {
        include('../database/db.php');
        if(isset($_SESSION["logged_in"])){
            $idUser = $_SESSION['idUser'];
            $query = "SELECT personalBest FROM score WHERE idUser = '$idUser' AND idJeu = 1";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_assoc($result);
                $res = $row['personalBest'];
                return $res;   
            }                   
        }
    }
    
    function SavePersonalBest(){
        session_start();
        include('../database/db.php');
        $score = $_GET['score'];
        if (isset($_SESSION["logged_in"])){
            $idJoueur = $_SESSION['idUser'];
            $query = "UPDATE score SET personalBest ='$score' WHERE idUser = '$idJoueur' AND idJeu = 1";
            $result = mysqli_query($conn, $query);            
        }        
        header("Location:../front/Jeu_Countdown.php");
    }   

?>
