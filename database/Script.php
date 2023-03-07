<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projet_web";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Insert 200 user accounts into the `user` table
for ($i = 1; $i <= 200; $i++) {
  $username = "compte_" . $i;
  $password = "test";

  $sql = "INSERT INTO user (username, password) VALUES ('$username', '$password')";

  if ($conn->query($sql) === TRUE) {
    echo "Record created successfully for user $username <br>";
  } else {
    echo "Error creating record: " . $conn->error;
  }
}

// Set the score for the users
$games = array(
  array("id" => 1, "min" => 0, "max" => 3),
  array("id" => 2, "min" => -10, "max" => 0)
);

foreach ($games as $game) {
  $idJeu = $game["id"];
  $min = $game["min"];
  $max = $game["max"];

  $sql = "SELECT idUser FROM user";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $idUser = $row["idUser"];
      $score = $min + mt_rand() / mt_getrandmax() * ($max - $min);

      $sql = "INSERT INTO score (idUser, idJeu, personalBest) VALUES ('$idUser', '$idJeu', $score)";

      if ($conn->query($sql) === TRUE) {
        echo "Record created successfully for user $idUser and game $idJeu <br>";
      } else {
        echo "Error creating record: " . $conn->error;
      }
    }
  } else {
    echo "No users found in the database";
  }
// Generate random scores for each user
for ($i = 1; $i <= 200; $i++) {
  $idJeu = rand(1, 3);
  $personalBest = $idJeu == 1 ? round(rand(0, 3000) / 1000, 3) : round(rand(-500, 500) / 1000, 3);
  $idUser = $i;
  
  // Insert score into the database
  $sql = "INSERT INTO score (idJeu, personalBest, idUser) VALUES ($idJeu, $personalBest, $idUser)";
  $result = $conn->query($sql);
  
  if (!$result) {
    echo "Error inserting score for user $idUser: " . $conn->error;
  }
}
}

$conn->close();
?>
