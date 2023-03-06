<?php
  session_start();

  include('../back/Jeu_Countdown_fct.php');

  $personalBest = GetPersonalBest();
  if ($personalBest == null) {
    $personalBest = "";
  }

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
      if (etat == 0) { 
        //Si on est en off  
        fond_timer.style.background = 'rgb(' + 85 + ',' + 89 + ',' + 92 + ')';
        txt_timer.style.opacity = 100;
        random_start = Math.floor(Math.random() * (10-5)+5)*1000;       
        startTime = new Date().getTime();
        timer = setInterval(updateTimer, 10); // update every 10 milliseconds            
        txt_target.innerHTML = "Your target time is <b><span style='color: #ffca18'>" + "0"+ "</span></b> seconds";
        txt_target.style.opacity = 100; 
        
        txt_result.style.opacity = 0; 
        txt_retry.style.opacity = 0; 

        etat = 1; //Passe en on
      }
      // Stop
      else{          
        clearInterval(timer);
        txt_timer.style.opacity = 0;
        var currentTime = new Date().getTime();
        var elapsed = currentTime - startTime;
        var difference = Math.abs((elapsed)/ 1000);
        var ecart = random_start/1000 - difference;
        var ecartFinal = ecart.toFixed(2);

        txt_result.innerHTML = "You were <b>" + ecartFinal + "</b> seconds away from the target time.";
        if (txt_personalBest.innerHTML == "" || ecartFinal < Number(txt_personalBest.innerHTML)) {
          txt_personalBest.innerHTML = ecartFinal;
          window.location = `../back/Jeu_Countdown_fct.php?score=${ecartFinal}&action=savepb`;      
        }
          
        txt_result.style.opacity = 100; 
        txt_retry.innerHTML = "Click to retry";
        txt_retry.style.opacity = 100; 

        // If the user was exactly on time
        if (difference == 0) {
          txt_result.innerHTML += " Congratulations, you were spot on!";
        }

        stop = false;
        etat = 0; //Passe en off
      }
    }

    function updateTimer() {

      var txt_timer = document.getElementById("timer");
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
        txt_timer.style.opacity = 0;
        jeuLose();
      }
      
      if (!stop) {
        txt_timer.innerHTML = seconds + "." + milliseconds;
      }            
    }

    function jeuLose() {

      var fond_timer = document.getElementById("fond_timer");
      var txt_result = document.getElementById("result");
      var txt_retry = document.getElementById("retry");

      clearInterval(timer);
      txt_result.innerHTML = "You took too much time...";
      txt_result.style.opacity = 100; 
      txt_retry.innerHTML = "Click to retry";
      txt_retry.style.opacity = 100; 
      fond_timer.style.background = 'rgb(' + 207 + ',' + 47 + ',' + 53 + ')';
      etat = 0; //Passe en off      
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
              if (isset($_SESSION["logged_in"]) && ($_SESSION["logged_in"])){
            ?>
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
        <h1 class="fw-light text-white btn_timer" id="timer">Countdown</h1>
        <?php
        if( isset($_GET['ecartFinal']))
        {
          $res = $_GET['ecartFinal'];
          echo "<p class='fw-light text-white '>You were $res seconds away from the target time.</p>";
        }?>
        <p class='fw-light text-white btn_result' id='result'>You were x seconds away from the target time.</p>
        <p class="fw-light text-white btn_retry" id="retry">Click to start</p>
      </div>    
    </div>

    <!-- Bloc Jeux-->
    <div class="container">
      <div class="row justify-content-center">
        <!-- Personal Record -->
        <div class="bloc_jeux1">
          <div class="text-center center">
            <h5 class="card-title title_score">Score</h5>
            <h5 class="card-title title_pr">Personal record :</h5>
            <h5 class="card-title title_cd" id="personalBest"><?php echo $personalBest; ?></h5>
          </div>
            </div>
        <!-- Leaderboard -->
        <div class="bloc_jeux1">
          <h5 class="card-title title_ldb">Leaderboard :</h5> 
          <h5 class="card-title title_top">1. Pierre</h5> 
          <h5 class="card-title title_top">2. Paul</h5> 
          <h5 class="card-title title_top">3. Jacques</h5> 
          <div class="text-center center">
            <h5 class="card-title title_rank">Rank. Moi</h5>  
          </div>
        </div>  

        <!-- Rules -->
        <div class="bloc_jeux2">
          <div class="">
            <h5 class="card-title title_rules">Rules</h5>
            <h5 class="card-title title_text">Countdown test is a simple tool to measure your ability to stop a countdown as close to zero as possible. Click when you are closest to zero, but don't go over it!</h5>
          </div>
        </div>

        <!-- Statistics -->
        <div class="bloc_jeux2">
          <div class="">
            <h5 class="card-title title_rules">Statistics</h5>
            <h5 class="card-title title_text"></h5>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
  </body>

</html>