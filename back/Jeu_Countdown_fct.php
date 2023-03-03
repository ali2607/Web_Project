<?php

    // Récupération du meilleur score actuel
    function GetPersonalBest()
    {
        include('../database/db.php');
        if(isset($_SESSION["logged_in"])){
            $idUser = $_SESSION['idUser'];
            $query = "SELECT personalBest FROM score WHERE idUser = $idUser AND idJeu = 1";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_assoc($result);
                $res = $row['personalBest'];
                return $res;   
            }                   
        }
    }
    
    // Enregistrement d'un meilleur score
  
    function SaveNewRecord($score){
        include('../database/db.php');
        if (isset($_SESSION["logged_in"])){
          $idJoueur = $_SESSION['idUser'];
          $query = "UPDATE score SET personalBest ='$score' WHERE idUser = '$idJoueur' AND idJeu = 1";
          $result = mysqli_query($conn, $query);
          $aResult['result'] = $score;
          echo json_encode($aResult);
        }
    }

?>
