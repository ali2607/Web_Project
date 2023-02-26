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
      .btn_start{
        top:100px;
        position:relative;
        width:100px;
        height:50px;
      }

      .bloc_color{
        background-color:#55595c!important;
      }

      .bloc_jeux{
        width:200px;
        height:200px;
        background-color:#99cdff;
        color:inherit;
        text-decoration:none;
        transition: transform 0.5s;
      }

      .bloc_jeux:hover{
        transform: translateY(-10px);
      }
      
      .center{
        margin-left:auto;
        margin-right:auto;
      }

      .logo_size{
        width:80px;
        height:80px;
      }

    </style>
</head>

<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="..\images\logo.png" alt="..." height="30">
      </a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item ">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Dashboard/index.php">Dashboard</a>
          </li>
          <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Profil</a></li>
              <li><a class="dropdown-item" href="#">Personal Records</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li> -->
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

  <!-- Bloc Gris-->
<div class="bg-secondary text-center d-flex align-items-center py-5 mb-5 bloc_color" style="height: 50vh">
    <div class="container">
      <h1 class="fw-light text-white ">Test your skills</h1>
      <a class="btn btn-primary btn-lg btn_start" href="Jeu_Countdown.php">Start</a>
    </div>    
</div>

  <!-- Bloc Jeux-->
<div class="container">
  <div class="row justify-content-center">
    <!-- Countdown -->
    <a class="d-flex align-items-center mx-5 bloc_jeux" href="Jeu_Countdown.php">
      <div class="text-center center">
        <img src="..\images\countdown.png" class="logo_size" alt="...">
        <div class="text-center">
          <h5 class="card-title">Countdown</h5>
        </div>
      </div>
    </a>
    <!-- Timer -->
    <a class="d-flex align-items-center mx-5 bloc_jeux" href="Jeu_Timer.php">
      <div class="text-center center">
        <img src="..\images\timer.png" class="logo_size" alt="...">
        <div class="card-body text-center">
          <h5 class="card-title mb-0">Timer</h5>
        </div>
      </div>
          </a>
    <!-- QTE -->
    <a class="d-flex align-items-center mx-5 bloc_jeux" href="#">
      <div class="text-center center">
        <img src="..\images\QTE.png" class="logo_size" alt="...">
        <div class="card-body text-center">
          <h5 class="card-title mb-0">QTE</h5>
        </div>
      </div>
          </a>
  <!-- /.row -->

</div>
<!-- /.container -->

</body></html>