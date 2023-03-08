<?php
// Connexion à la base de données
$host = "localhost";
$username = "root";
$password = "";
$dbname = "projet_web";
$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// 
// // Insert 200 users into the `user` table
// for ($i = 1; $i <= 200; $i++) {
//     $username = "user" . $i;
//     $password = 'test';


//     $sql = "INSERT INTO user (`username`, `password`) VALUES ('$username', '$password')";

//     if ($conn->query($sql) === FALSE) {
//         echo "Error: " . $sql . "<br>" . $conn->error;
//     }
// }

// // Get the ids of all the users
// $userIds = array();
// $sql = "SELECT `idUser` FROM user";
// $result = $conn->query($sql);
// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         array_push($userIds, $row["idUser"]);
//     }
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }

// // Get the ids of all the games
// $gameIds = array();
// $sql = "SELECT `idJeu` FROM `jeu`";
// $result = $conn->query($sql);
// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         array_push($gameIds, $row["idJeu"]);
//     }
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }

// // Set scores for each user and game
// foreach ($userIds as $userId) {
//     foreach ($gameIds as $gameId) {
//         $score = round(mt_rand(0, 3500) / 1000, 3); // Random score between 0 and 3.5
//         $sql = "INSERT INTO score (`idUser`, `idJeu`, `personalBest`)
//                 VALUES ('$userId', '$gameId', '$score')";

//         if ($conn->query($sql) === FALSE) {
//             echo "Error: " . $sql . "<br>" . $conn->error;
//         }
//     }
// }

// // Set high scores for some users and games
// $highScoreUserIds = array_slice($userIds, 0, 10); // Top 10 users
// $highScoreGameIds = array_slice($gameIds, 0, 5); // Top 5 games
// foreach ($highScoreUserIds as $userId) {
//     foreach ($highScoreGameIds as $gameId) {
//         $score = round(mt_rand(3500, 5000) / 1000, 3); // Random high score between 3.5 and 5
//         $sql = "UPDATE score
//                 SET `personalBest` = '$score'
//                 WHERE `idUser` = '$userId' AND `idJeu` = '$gameId'";

//         if ($conn->query($sql) === FALSE) {
//             echo "Error: " . $sql . "<br>" . $conn->error;
//         }
//     }
// }

// mysqli_close($conn);
?>