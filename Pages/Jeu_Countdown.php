<?php
  session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <title>Bootstrap Example</title>
    <style>
      .btn_target{
        top:-110px;
        position:relative;
        font-size:30px;
        opacity:0;
      }

      .btn_timer{
        top:0px;
        position:relative;
        font-size:50px;
      }

      .btn_result{
        top:0px;
        position:relative;
        font-size:15px;
        opacity:0;
      }

      .btn_retry{
        top:80px;
        position:relative;
        font-size:20px;
        opacity:100;
      }

      .bloc_color{
        background-color:#55595c;
      }

    </style>
</head>

<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="Accueil.php">
        <img src="..\images\logo.png" alt="..." height="30">
      </a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item ">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Login.php">Dashboard</a>
          </li>
        </ul>
        <div class="form-inline ms-auto">
            <?php
            if (isset($_SESSION["logged_in"]) && ($_SESSION["logged_in"])){?>
              <label class="text-light mx-3" ><?php echo "Hello ".$_SESSION["username"];?></label>
              <a class="btn btn-outline-light btn-sm" href="Login.php">Logout</a>
              <?php
            }
            else{
              ?>
              <a class="btn btn-outline-light btn-sm mx-2" href="Login.php">Login</a>
              <a class="btn btn-primary btn-sm" href="SignUp.php">Sign Up</a>
              <?php
            }
            ?>            
        </div>
      </div>
    </div>
  </nav>

  <script>
    var startTime;
    var timer; 
    var etat = 0;
    var target_time;
    var stop = false;

   function jeuStart() {               

        // Start
        if (etat == 0) { //Si on est en off
            
          document.getElementById("fond_timer").style.background = 'rgb(' + 85 + ',' + 89 + ',' + 92 + ')';
            random_start = Math.floor(Math.random() * (10-5)+5)*1000;            
            document.getElementById("timer").style.opacity = 100;
            startTime = new Date().getTime();
            timer = setInterval(updateTimer, 10); // update every 10 milliseconds
            
            var target = document.getElementById("target");
            target.innerHTML = "Your target time is <b><span style='color: #ffca18'>" + "0"+ "</span></b> seconds";
            target.style.opacity = 100; 
            document.getElementById("retry").style.opacity = 0; 
            document.getElementById("result").style.opacity = 0; 

            etat = 1; //Passe en on
        }
        // Stop
        else{          
            clearInterval(timer);
            document.getElementById("timer").style.opacity = 0;
            var currentTime = new Date().getTime();
            var elapsed = currentTime - startTime;
            var difference = Math.abs((elapsed)/ 1000);
            var ecart = random_start/1000 - difference;

            var result = document.getElementById("result");
            result.innerHTML = "You were <b>" + ecart.toFixed(2) + "</b> seconds away from the target time.";
            result.style.opacity = 100; 
            var retry = document.getElementById("retry");
            retry.innerHTML = "Click to retry";
            retry.style.opacity = 100; 

            // If the user was exactly on time
            if (difference == 0) {
                result.innerHTML += " Congratulations, you were spot on!";
            }

            stop = false;
            etat = 0; //Passe en off
        }
    }

    function updateTimer() {
            var currentTime = new Date().getTime();
            var elapsed = random_start - (currentTime - startTime);

            var minutes = Math.floor(elapsed / 60000);
            var seconds = Math.floor((elapsed % 60000) / 1000);
            var milliseconds = elapsed % 1000;

            // Add leading zeros to seconds and milliseconds
            if (seconds < 10) {
                seconds = seconds;
            }
            if (milliseconds < 100) {
                milliseconds = "0" + milliseconds;
            }
            if (milliseconds < 10) {
                milliseconds = "0" + milliseconds;
            }
            if (seconds < 0) {
                //stop = true;
                document.getElementById("timer").style.opacity = 0;
                jeuLose();
            }
            
            if (!stop) {
                document.getElementById("timer").innerHTML = seconds + "." + milliseconds;
            }            
    }

    function jeuLose() {
      clearInterval(timer);
      var result = document.getElementById("result");
      result.innerHTML = "You took too much time...";
      result.style.opacity = 100; 
      var retry = document.getElementById("retry");
      retry.innerHTML = "Click to retry";
      retry.style.opacity = 100; 
      document.getElementById("fond_timer").style.background = 'rgb(' + 207 + ',' + 47 + ',' + 53 + ')';
      etat = 0; //Passe en off      
    }

</script>

  <!-- Bloc Gris-->
  <div class="text-center d-flex align-items-center py-5 mb-5 bloc_color" id="fond_timer" onclick="jeuStart();" style="height: 50vh">
    <div class="container">
      <p class="fw-light text-white align-items-top btn_target" id="target">Your target time is x seconds</p>
      <h1 class="fw-light text-white btn_timer" id="timer">Countdown</h1>
      <p class="fw-light text-white btn_result" id="result">You were x seconds away from the target time.</p>
      <p class="fw-light text-white btn_retry" id="retry">Click to start</p>
    </div>    
  </div>

<!-- /.container -->

</body></html>