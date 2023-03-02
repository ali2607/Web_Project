<?php
// Initialize the session
session_start();

if (isset($_POST['start'])) {
  // Generate a random start time between 3 and 8 seconds
  $start_time = microtime(true);
  $end_time = $start_time + 3 + rand(0, 5) + (rand(0, 1000) / 1000.0);

  // Save the end time in the session
  $_SESSION['end_time'] = $end_time;

  // Save the start time in the session for calculating elapsed time
  $_SESSION['start_time'] = $start_time;
}

if (isset($_POST['stop'])) {
  // Calculate the elapsed time
  $elapsed_time = microtime(true) - $_SESSION['start_time'];
  $remaining_time = $_SESSION['end_time'] - microtime(true);

  // Check if the remaining time is negative
  if ($remaining_time < 0) {
    $remaining_time = 0;
  }

  // Display the remaining time
  echo "Remaining Time: " . number_format($remaining_time, 3) . " seconds<br>";

  // Display the difference from zero
  $difference = abs($remaining_time - 0);
  echo "Difference from 0: " . number_format($difference, 3) . " seconds<br>";

  // Unset the end time to start a new countdown
  unset($_SESSION['end_time']);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Mini Game</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
    }
    h1 {
      font-size: 40px;
      margin-top: 50px;
    }
    #timer {
      font-size: 60px;
      margin-top: 50px;
    }
    button {
      font-size: 24px;
      padding: 10px 20px;
      margin-top: 20px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover {
      background-color: #3e8e41;
    }
  </style>
</head>
<body>
  <h1>Mini Game</h1>

  <?php if (isset($_SESSION['end_time'])) { ?>
    <div id="timer">
      <?php
        $remaining_time = $_SESSION['end_time'] - microtime(true);
        if ($remaining_time < 0) {
          $remaining_time = 0;
        }
        echo number_format($remaining_time, 3);
      ?>
    </div>
    <form method="post">
      <button type="submit" name="stop">Stop</button>
    </form>
  <?php } else { ?>
    <form method="post">
      <button type="submit" name="start">Start</button>
    </form>
  <?php } ?>

  <?php if (!isset($_SESSION['end_time'])) { ?>
    <form method="post">
      <button type="submit" name="play_again">Play Again</button>
    </form>
  <?php } ?>

</body>
</html>
