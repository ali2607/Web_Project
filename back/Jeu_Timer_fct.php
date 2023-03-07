<?php

    // Récupération du meilleur score actuel
    function GetPersonalBest()
    {
        include('../database/db.php');
        if(isset($_SESSION["logged_in"])){
            $idUser = $_SESSION['idUser'];
            $query = "SELECT personalBest FROM _score WHERE idUser = '$idUser' AND idJeu = 2";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_assoc($result);
                $res = $row['personalBest'];
                return $res;   
            }                   
        }
    }   

    function GetLeaderBoard()
    {
        include('../database/db.php');
        if(isset($_SESSION["logged_in"])){
            $query = "SELECT username FROM _user,_score WHERE _user.idUser = _score.idUser AND _score.idJeu=2 AND _score.personalBest IS NOT NULL ORDER BY _score.personalBest  ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $res = $row['username'];
            //echo $res;
            //return $res;   
        }
    }

?>