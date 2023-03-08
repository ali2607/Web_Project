<?php
  session_start();

  include('../back/Jeu_Timer_fct.php');

  $personalBest = GetPersonalBest();
  if ($personalBest == null) {
    $personalBest = "";
  }

  include('../back/Games_fct.php');
  $totalplayers = GetTotalPlayer();
  $rankgood = true;
  try
  {
    $rank = GetRanking(2);
  }catch(Exception $e)
  {
    $rankgood = false; 
  }
  
  $leaderboard =GetLeaderBoard(2);

  include('head.php');
?>

<script>
    var startTime;
    var timer; 
    var etat = 0;
    var target_time;
    var stop = false;

   function jeuStart() {               

        var fond_timer = document.getElementById("fond_timer");
        var txt_timer = document.getElementById("timer");
        var txt_target = document.getElementById("target");
        var txt_result = document.getElementById("result");
        var txt_retry = document.getElementById("retry");
        var txt_personalBest = document.getElementById("personalBest");

        // Start
        if (etat == 0) { //Si on est en off
            
            target_time = Math.floor(Math.random() * (20-10)+10);            
            
            startTime = new Date().getTime();
            timer = setInterval(updateTimer, 10); // update every 10 milliseconds
            
            txt_target.innerHTML = "Your target time is <b><span style='color: #ffca18'>" + target_time+ "</span></b> seconds";
            txt_target.style.opacity = 100; 
            txt_retry.style.opacity = 0; 
            txt_result.style.opacity = 0; 

            etat = 1; //Passe en on
        }
        // Stop
        else{          
            clearInterval(timer);
            var currentTime = new Date().getTime();
            var elapsed = currentTime - startTime;
            var difference = Math.abs(Math.round((target_time - elapsed) / 10) / 100);
            var ecart = target_time - difference;
            var ecartFinal = ecart.toFixed(3)

            txt_result.innerHTML = "You were <b>" + ecartFinal + "</b> seconds away from the target time.";
            if (txt_personalBest.innerHTML == "" || ecartFinal < Number(txt_personalBest.innerHTML)) {
            txt_personalBest.innerHTML = ecartFinal;
            <?php if(isset($_SESSION["logged_in"]))
            {?>
            window.location = `../back/SaveRecord.php?score=${ecartFinal}&idjeu=2&action=savepb`;    
            <?php
            }?>  
            }
            else
            {
              <?php $nopb = true; ?>
            }
            txt_result.style.opacity = 100; 
            txt_retry.innerHTML = "Click to retry";
            txt_retry.style.opacity = 100; 

            // If the user was exactly on time
            if (difference == 0) {
              txt_result.innerHTML += " Congratulations, you were spot on!";
            }

            txt_timer.style.opacity = 100;
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

<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="Accueil.php">
        <img src="..\image\logo.png" alt="..." height="30">
      </a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item ">
            <a class="nav-link" aria-current="page" href="Accueil.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Dashboard\index.php">Dashboard</a>
          </li>
        </ul>
        <div class="form-inline ms-auto">
            <?php
            if (isset($_SESSION["logged_in"]) && ($_SESSION["logged_in"])){?>
              <label class="text-light mx-3" ><?php echo "Hello ".$_SESSION["username"];?></label>
              <a class="btn btn-outline-light btn-sm" href="../back/Authentification_fct.php?action=logout">Logout</a>
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

  <!-- Bloc Gris-->
  <div class="text-center d-flex align-items-center py-5 mb-5 fond_color" id="fond_timer" onclick="jeuStart();" style="height: 50vh">
    <div class="container">
      <p class="fw-light text-white align-items-top btn_target" id="target">Your target time is x seconds</p>
      <h1 class="fw-light text-white btn_timer" id="timer">Timer</h1>
      <?php
        if( isset($_GET['ecartFinal']) && $nopb != true)
        {
          $res = $_GET['ecartFinal'];
          echo "<p class='fw-light text-white' >You were $res seconds away from the target time.</p>";
        }?>
      <p class="fw-light text-white btn_result" id="result">You were x seconds away from the target time.</p>
      <p class="fw-light text-white btn_retry" id="retry">Click to start</p>
    </div>    
  </div>

   <!-- Bloc Jeux-->
<div class="container">
  <div class="row justify-content-center">
    <!-- Personal Record -->
    <a class="bloc_jeux1" href="Jeu_Countdown.php">
      <div class="text-center center">
          <h5 class="card-title title_score">Score</h5>
          <h5 class="card-title title_pr">Personal record :</h5>
          <h5 class="card-title title_cd" id="personalBest"><?php echo $personalBest; ?></h5>
      </div>
    </a>
    <!-- Leaderboard -->
    <div class="bloc_jeux1" href="Jeu_Timer.php">
    <h5 class="card-title title_ldb">Leaderboard :</h5> 
          <h5 class="card-title title_top">1. <?php if(isset($leaderboard[0])){echo $leaderboard[0];} ?></h5> 
          <h5 class="card-title title_top">2. <?php if(isset($leaderboard[1])){echo $leaderboard[1];} ?></h5> 
          <h5 class="card-title title_top">3. <?php if(isset($leaderboard[2])){echo $leaderboard[2];} ?></h5> 
          <h5 class="card-title title_top">Your rank. <?php if($rankgood){echo $rank;}else{ echo '---';}?>/<?php echo $totalplayers;?></h5> 
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