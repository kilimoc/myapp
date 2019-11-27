<?php
require_once 'CompanyOperations.php';
$companyO=new CompanyOperations();
if(isset($_POST['login'])){

$username=$_POST['username'];
$password=$_POST['password'];
$response=$companyO->loginUser($username,$password);
echo "<script type='text/javascript'>window.alert('$response');</script>";

}?>



<!doctype html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <title>I-ItemRecovery|Item Recovery made Easy</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="css/itemrecovery.css" rel="stylesheet" type="text/css">
        <style>

      </style>
      </head>
<body class="container">
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card mycard" style="width: 24rem;height: 65%">
            <div class="card-body">
                <h4 class="card-title text-center">I-ItemRecovery</h4>
                <h5 class="card-title text-center">---<u>Login</u>---</h5>
                <hr>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control customInput" name="username" id="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control customInput" name="password" id="password">
                    </div>
                    <hr>
                    <div class="form-group">
                        <button class="btn btn-orange btn-block" type="submit" name="login">Log In</button>
                        <p class="text-center">Dont have an account? <a href="register.php" class="text-orange">Register Now</a> </p>
                        <p class="text-center">Visit  <a href="index.php" class="text-orange"><i class="fa fa-home fa-fw"></i> Home</a> </p>
                    </div>

                </form>



            </div>
        </div>
    </div>
</div>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>