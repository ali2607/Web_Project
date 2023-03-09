<?php
  session_start();

  include('../back/Jeu_QTE_fct.php');

  $personalBest = GetPersonalBest();
  if ($personalBest == null) {
    $personalBest = "";
  }

  include('../back/Games_fct.php');
  $totalplayers = GetTotalPlayer();
  $rankgood = true;
  try
  {
    $rank = GetRanking(3);
  }catch(Exception $e)
  {
    $rankgood = false; 
  }
  $leaderboard =GetLeaderBoard(3);
  $nopb = true;
  include('head.php');  
?>


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
    <div class="text-center d-flex align-items-center py-5 mb-5 fond_color" id="fond_timer" onclick="startGame();" style="height: 50vh">
      <div class="container">
        <p class="fw-light text-white align-items-top btn_target" id="target">Your target time is x seconds</p>
        <h1 class="fw-light text-white btn_timer" id="timer">QTE</h1>
        <?php
        if( isset($_GET['ecartFinal'])  && $nopb != true)
        {
          $res = $_GET['ecartFinal'];
          echo "<p class='fw-light text-white' >You scored $res seconds per letter</p>";
        }?>
        <p class='fw-light text-white btn_result' id='result'>You score x seconds per letter</p>
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
          <h5 class="card-title title_top">1. <?php if(isset($leaderboard[0])){echo $leaderboard[0];} ?></h5> 
          <h5 class="card-title title_top">2. <?php if(isset($leaderboard[1])){echo $leaderboard[1];} ?></h5> 
          <h5 class="card-title title_top">3. <?php if(isset($leaderboard[2])){echo $leaderboard[2];} ?></h5> 
          <h5 class="card-title title_top">Your rank. <?php if($rankgood){echo $rank;}else{ echo '---';}?>/<?php echo $totalplayers;?></h5> 
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

  <script>
    // Tableau de lettres pour le jeu
    var letters = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];

    // Variables pour le jeu
    var startTime;
    var currentIndex = 0;
    var currentLetter;
    var gameStarted = false;
    var etat = 0;



    // Récupération de l'élément HTML pour le jeu
    var game = document.getElementById("timer");
    game.style.opacity = 100;

    // Fonction pour démarrer le jeu
    function startGame() {
      if (etat == 0){
        var retry = document.getElementById("retry");
        retry.style.opacity = 0;
        currentIndex = 0;
        gameStarted = true;
        startTime = new Date().getTime();
        nextLetter();
        etat = 1;
      }
        
    }

    // Fonction pour générer la lettre suivante
    function nextLetter() {
        var target = document.getElementById("target");
        target.innerHTML = currentIndex+1+"/26";
        target.style.opacity = 100;
        currentLetter = letters[Math.floor(Math.random() * letters.length)];
        game.innerHTML = currentLetter;
    }

    // Fonction pour gérer l'appui sur une touche
    function handleKeyPress(event) {
        if (!gameStarted) {
            return;
        }
        var txt_personalBest = document.getElementById("personalBest");
        var keyPressed = String.fromCharCode(event.keyCode);
        if (keyPressed.toUpperCase() === currentLetter) {
            currentIndex++;
            if (currentIndex === letters.length) {
                var endTime = new Date().getTime();
                var totalTime = (endTime - startTime) / 1000;
                var endTime = totalTime/26
                var endTimeFinal = endTime.toFixed(2)
                game.innerHTML = endTimeFinal + " sec per letter";
                if (txt_personalBest.innerHTML == "" || endTimeFinal < Number(txt_personalBest.innerHTML)) {
                  txt_personalBest.innerHTML = endTimeFinal;
                  <?php if(isset($_SESSION["logged_in"]))
                  {?>
                        window.location = `../back/SaveRecord.php?score=${endTimeFinal}&idjeu=3&action=savepb`;    
                  <?php
                  }?>  
                }
                else
                {
                  <?php $nopb = true; ?>
                }
                gameStarted = false;
                var retry = document.getElementById("retry");
                retry.innerHTML = "Click to retry";
                retry.style.opacity = 100;
                etat = 0
                //setTimeout(startGame, 3000);
            } else {
                nextLetter();
            }
        }
    }

    // Gestionnaire d'événement pour l'appui sur une touche
    document.addEventListener("keypress", handleKeyPress);
  </script>

</html>
