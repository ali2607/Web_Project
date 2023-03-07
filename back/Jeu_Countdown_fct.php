<?php

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

    function GetLeaderBoard()
    {
        include('../database/db.php');
        if(isset($_SESSION["logged_in"])){
            $query = "SELECT username FROM user,score WHERE user.idUser = score.idUser AND score.idJeu=1 AND score.personalBest IS NOT NULL ORDER BY score.personalBest  ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $res = $row['username'];
            echo $res;
            //return $res;   
        }
    }

?>
