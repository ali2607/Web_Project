
<?php
    session_start();
    include('../database/db.php');
    $score = $_GET['score'];
    if (isset($_SESSION["logged_in"])){
        $idJoueur = $_SESSION['idUser'];
        $query = "UPDATE score SET personalBest ='$score' WHERE idUser = '$idJoueur' AND idJeu = 1";
        $result = mysqli_query($conn, $query);
        
    }
    
    header("Location:../front/Jeu_Countdown.php?ecartFinal=$score");
    die();
?>