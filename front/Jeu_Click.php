<?php
  session_start();

  include('../back/Jeu_Click_fct.php');

  $personalBest = GetPersonalBest();
  if ($personalBest == null) {
    $personalBest = "";
  }

  include('../back/Games_fct.php');
  $totalplayers = GetTotalPlayer();
  $rank = GetRanking(2);
  $leaderboard =GetLeaderBoard(2);

  include('head.php');
?>

<script>
    var startTime;
    var timer; 
    var etat = 0;
    var target_time;
    var stop = false; 
    
    let count = 0;
    let timeoutId;

    function jeuStart() {

        let score = 0;

        var fond_timer = document.getElementById("fond_timer");
        var txt_timer = document.getElementById("timer");
        var txt_target = document.getElementById("target");
        var txt_result = document.getElementById("result");
        var txt_retry = document.getElementById("retry");
        var txt_personalBest = document.getElementById("personalBest");

        var instruction = document.getElementById('target');
        var timer = document.getElementById('timer');
        //var button = document.getElementById('retry');

        if (etat==0){
            txt_timer.style.opacity = 100;
        txt_target.style.opacity = 100; 

        let btn = document.getElementById("fond_timer");
        let info = document.getElementById("target");
        let clickType = Math.random() < 0.5 ? "gauche" : "droit";
        info.innerHTML = "Cliquez " + clickType + " maintenant!";
        //btn.style.backgroundColor = clickType == "gauche" ? "red" : "blue";
        btn.disabled=true;
        btn.oncontextmenu = function()
        {
            if (clickType == "droit" && event.button == 2) {
            score++;
            document.getElementById("timer").innerHTML = score;
            jeuStart();
          } else {
            alert("Vous avez perdu! Votre score est de: " + score);
            etat = 1;
          } 
        }
        btn.onclick = function() 
        {
          if (clickType == "gauche" && event.button == 0) {
            score++;
            document.getElementById("timer").innerHTML = score;
            jeuStart();
          } else {
            alert("Vous avez perdu! Votre score est de: " + score);
            etat = 1;
          }
        };
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
  <div class="text-center d-flex align-items-center py-5 mb-5 fond_color" id="fond_timer" onclick="jeuStart()" style="height: 50vh">
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
          <h5 class="card-title title_cd" id="personalBest"><?php echo $personalBest; ?> sec</h5>
      </div>
    </a>
    <!-- Leaderboard -->
    <div class="bloc_jeux1" href="Jeu_Timer.php">
    <h5 class="card-title title_ldb">Leaderboard :</h5> 
          <h5 class="card-title title_top">1. <?php if(isset($leaderboard[0])){echo $leaderboard[0];} ?></h5> 
          <h5 class="card-title title_top">2. <?php if(isset($leaderboard[1])){echo $leaderboard[1];} ?></h5> 
          <h5 class="card-title title_top">3. <?php if(isset($leaderboard[2])){echo $leaderboard[2];} ?></h5> 
          <h5 class="card-title title_top">Your rank. <?php echo $rank;?>/<?php echo $totalplayers;?></h5> 
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