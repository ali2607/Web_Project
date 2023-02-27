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
        background-color:#55595c!important;
      }

      .bloc_jeux{
        width:375px;
        height:175px;
        background-color:#99cdff;
        color:inherit;
        text-decoration:none;
        margin-left:75px;
        margin-right:75px;
        margin-top:50px;
        margin-bottom:100px;
      }

      .bloc_jeux2{
        width:900px;
        height:175px;
        background-color:#99cdff;
        color:inherit;
        text-decoration:none;
        transition: transform 0.5s;
        margin-left:75px;
        margin-right:75px;
        margin-bottom:100px;        
      }

      .center{
        margin-left:auto;
        margin-right:auto;
      }

      .title_score{
        position:relative;
        bottom:40px;
        right:150px;
        font-size:30px;
      }

      .title_pr{
        position:relative;
        bottom:30px;
        right:115px;
        font-size:17px;
      }

      .title_cd{
        position:relative;
        top:7px;
        font-size:40px;
      }

      .title_ldb{
        position:relative;
        top:5px;
        right:5px;
        font-size:17px;
      }

      .title_top{
        position:relative;
        top:20px;
        left:10px;
        font-size:22px;
      }

      .title_rank{
        position:relative;
        vertical-align: middle;
        left:60px;
        bottom:30px;
        font-size:30px;
      }

      .title_rules{
        position:relative;
        bottom:40px;
        right:13px;
        font-size:30px;        
      }

      .title_text{
        font-size:17px;
        position:relative;
        bottom:25px;
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
            
            target_time = Math.floor(Math.random() * (20-10)+10);            
            
            startTime = new Date().getTime();
            timer = setInterval(updateTimer, 10); // update every 10 milliseconds
            
            var target = document.getElementById("target");
            target.innerHTML = "Your target time is <b><span style='color: #ffca18'>" + target_time+ "</span></b> seconds";
            target.style.opacity = 100; 
            document.getElementById("retry").style.opacity = 0; 
            document.getElementById("result").style.opacity = 0; 

            etat = 1; //Passe en on
        }
        // Stop
        else{          
            clearInterval(timer);
            var currentTime = new Date().getTime();
            var elapsed = currentTime - startTime;
            var difference = Math.abs(Math.round((target_time - elapsed) / 10) / 100);
            var ecart = target_time - difference;

            var result = document.getElementById("result");
            result.innerHTML = "You were <b>" + ecart.toFixed(3) + "</b> seconds away from the target time.";
            result.style.opacity = 100; 
            var retry = document.getElementById("retry");
            retry.innerHTML = "Click to retry";
            retry.style.opacity = 100; 

            // If the user was exactly on time
            if (difference == 0) {
                result.innerHTML += " Congratulations, you were spot on!";
            }

            document.getElementById("timer").style.opacity = 100;
            stop = false;
            etat = 0; //Passe en off
        }
    }

    function updateTimer() {
            var currentTime = new Date().getTime();
            var elapsed = currentTime - startTime;

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
            if (seconds > 4) {
                stop = true;
                document.getElementById("timer").innerHTML = "...";
            }
            
            if (!stop) {
                document.getElementById("timer").innerHTML = seconds + "." + milliseconds;
            }
            
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

   <!-- Bloc Jeux-->
<div class="container">
  <div class="row justify-content-center">
    <!-- Personal Record -->
    <a class="bloc_jeux" href="Jeu_Countdown.php">
      <div class="text-center center">
          <h5 class="card-title title_score">Score</h5>
          <h5 class="card-title title_pr">Personal record :</h5>
          <h5 class="card-title title_cd">Temps</h5>
      </div>
    </a>
    <!-- Leaderboard -->
    <div class="bloc_jeux" href="Jeu_Timer.php">
      <h5 class="card-title title_ldb">Leaderboard :</h5> 
      <h5 class="card-title title_top">1. Pierre</h5> 
      <h5 class="card-title title_top">2. Paul</h5> 
      <h5 class="card-title title_top">3. Jacques</h5> 
      <div class="text-center center">
        <h5 class="card-title title_rank">Rank. Moi</h5>  
      </div>
    </div>  

    <!-- Rules -->
    <div class="bloc_jeux2" href="Jeu_Countdown.php">
        <div class="">
            <h5 class="card-title title_rules">Rules</h5>
            <h5 class="card-title title_text">Timer test is a simple tool to measure your ability to </h5>
        </div>
    </div>

    <!-- Statistics -->
    <div class="bloc_jeux2" href="Jeu_Countdown.php">
        <div class="">
            <h5 class="card-title title_rules">Statistics</h5>
            <h5 class="card-title title_text"></h5>
        </div>
    </div>
  </div>
</div>
  <!-- /.row -->
<!-- /.container -->

</body></html>