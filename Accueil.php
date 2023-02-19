<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Bootstrap Example</title>
    <style>
        .custom-navbar {
            background-color: #000000;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .start-button-container {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
        <a class="navbar-brand" href="#"><img src="logo.png" alt="Logo" width="30" height="30"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Dashboard</a>
                </li>
            </ul>
            <form class="form-inline">
                <a class="btn btn-outline-light mr-2" href="#">Login</a>
                <a class="btn btn-primary" href="#">Sign Up</a>
            </form>
        </div>
    </nav>
    <div class="container-fluid p-0">
        <div class="row no-gutters" style="height: 50vh">
            <div class="col-12 bg-dark text-center d-flex align-items-center">
                <div class="full-width-container">
                    <div class="start-button-container" id="start-button-container">
                        <button class="btn btn-primary">Start</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row no-gutters" style="height: 50vh">
            <div class="col-6 bg-black"></div>
            <div class="col-6 bg-white"></div>
        </div>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.16.0/