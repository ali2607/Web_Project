<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!-- <link href="style.css" rel="stylesheet"> -->
    <title>Bootstrap Example</title>
    <style>
      body {
        background: #007bff;
        background: linear-gradient(to right, #3a3c3e, #313435);
      }

      .btn-login {
        font-size: 0.9rem;
        letter-spacing: 0.05rem;
        padding: 0.75rem 1rem;
      }

      .btn-google {
        color: white !important;
        background-color: #ea4335;
      }

      .btn-facebook {
        color: white !important;
        background-color: #3b5998;
      }   

      .bloc_input{
        background-color:#eeeeee;
      }
    </style>
</head>


<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="Accueil2.php">
        <img src="..\images\logo.png" alt="..." height="30">
      </a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item ">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Dashboard</a>
          </li>
        </ul>
        <div class="form-inline ms-auto">
            <a class="btn btn-outline-light btn-sm mx-2" href="Login.php">Login</a>
            <a class="btn btn-primary btn-sm" href="#">Sign Up</a>
        </div>
      </div>
    </div>
  </nav>
<!--------------->

<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 font-weight-bold fs-5">Sign Up</h5>
            <form action="SignUp_Back.php" method="post">
              <div class="form-floating mb-3">
                <input name="floatingInput" type="username" class="form-control bloc_input" id="floatingInput" placeholder="Username">
                <label for="floatingInput">Username</label>
              </div>
              <div class="form-floating mb-3">
                <input name="floatingPassword" type="password" class="form-control bloc_input" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
              </div>
              <div class="form-floating mb-3">
                <input name="floatingCPassword" type="password" class="form-control bloc_input" id="floatingPassword" placeholder="Password">
                <label for="floatingCPassword">Confirm Password</label>
              </div>
              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">Sign Up</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>