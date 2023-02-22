<!DOCTYPE html>
<html>

<head>
    <title>Timer Game</title>
    <style>
        body {
            background-color: #f7f7f7;
            font-family: Arial, sans-serif;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
        }

        p {
            margin-top: 20px;
            font-size: 18px;
            text-align: center;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #3e8e41;
        }

        #timer {
            font-size: 24px;
            text-align: center;
            margin-top: 20px;
        }

        #result {
            font-size: 18px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <h1>Timer Game</h1>

    <?php
    // Generate a random target time between 1 and 10 seconds
    $target_time = rand(1, 10);

    // Display the target time to the user
    echo "<p>Your target time is: <strong>" . $target_time . "</strong> seconds</p>";

    // Display a start button
    echo "<button onclick='startTimer()'>Start</button>";

    // Create a div to display the timer
    echo "<div id='timer'></div>";

    // Display a stop button
    echo "<button onclick='stopTimer()'>Stop</button>";

    // Create a div to display the result
    echo "<div id='result'></div>";
    ?>

    <script>
        var startTime;
        var timer;

        function startTimer() {
            startTime = new Date().getTime();
            timer = setInterval(updateTimer, 10); // update every 10 milliseconds
        }

        function updateTimer() {
            var currentTime = new Date().getTime();
            var elapsed = currentTime - startTime;

            var minutes = Math.floor(elapsed / 60000);
            var seconds = Math.floor((elapsed % 60000) / 1000);
            var milliseconds = elapsed % 1000;

            // Add leading zeros to seconds and milliseconds
            if (seconds < 10) {
                seconds = "0" + seconds;
            }
            if (milliseconds < 100) {
                milliseconds = "0" + milliseconds;
            }
            if (milliseconds < 10) {
                milliseconds = "0" + milliseconds;
            }

            document.getElementById("timer").innerHTML = "Elapsed time: " + minutes + ":" + seconds + ":" + milliseconds;
        }

        function stopTimer() {
            clearInterval(timer);
            var currentTime = new Date().getTime();
            var elapsed = currentTime - startTime;
            var difference = Math.abs(Math.round((elapsed - <?php echo $target_time; ?>) / 10) / 100);

            var result = document.getElementById("result");
            result.innerHTML = "You were " + difference.toFixed(2) + " seconds away from the target time.";

            // If the user was exactly on time
            if (difference == 0) {
                result.innerHTML += " Congratulations, you were spot on!";
            }

            // Display a play again button
            result.innerHTML += "<br><button onclick='location.reload()'>Play Again</button>";
        }
    </script>

</body>

</html>