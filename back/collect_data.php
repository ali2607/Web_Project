<?php

function getRankings()
{

    // Connexion à la base de données
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "projet_web";
    $conn = mysqli_connect($host, $username, $password, $dbname);

    // Check for errors
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    // Query the database for the rankings
    $rankings = array();
    for ($i = 1; $i <= 3; $i++) {
        $query = "SELECT user.username, score.personalBest, jeu.nom as game_name
              FROM score
              INNER JOIN user ON score.idUser = user.idUser
              INNER JOIN jeu ON score.idJeu = jeu.idJeu
              WHERE score.idJeu = $i
              ORDER BY score.personalBest ASC";
        $result = mysqli_query($conn, $query);

        // Add the rankings to the array
        while ($row = mysqli_fetch_assoc($result)) {
            $game_name = $row["game_name"];
            $username = $row["username"];
            $rank = $row["personalBest"];

            if (!isset($rankings[$game_name])) {
                $rankings[$game_name] = array();
            }

            $rankings[$game_name][$username] = $rank;
        }
    }

    // Close the database connection
    mysqli_close($conn);

    // Return the rankings array
    return $rankings;
}
$rankings = getRankings();

$json_data = json_encode($rankings);
$file = 'data.json';

file_put_contents($file, $json_data);
?>