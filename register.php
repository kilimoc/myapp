<?php
require_once 'CompanyOperations.php';
$companyO=new CompanyOperations();
if(isset($_POST['register'])){
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $phone=$_POST['phone'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];

    //Check if passwords are strong;
    if($password !=$cpassword){
        echo "<script type='text/javascript'>alert('Your password do not match.Enter matching passwords');</script>";
    }
    else{
        $response=$companyO->registerUser($fname,$lname,$phone,$username,$password);
        echo "<script type='text/javascript'>window.alert('$response');</script>";
    }
}
?>
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
          .mycard {
              width: 60vw; /*optional*/
              height: 60vh;
              margin: 20vh auto;
          }
          .mybtn{
              border-radius: 20px;
              background: #48B983;
          }
          .customInput{
              border-radius: 20px;
          }


      </style>
      </head>
<body class="container">
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card mycard" style="width: 36rem;height: 65%">
            <div class="card-body">
                <h4 class="card-title text-center">I-ItemRecovery</h4>
                <h5 class="card-title text-center">---<u>User Registration</u>---</h5>
                <hr>
                <form method="post" action="">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control customInput" name="fname" id="fname" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control customInput" name="lname" id="lname" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <div class="input-group  mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text customInput" id="inputGroup-sizing-sm">+254</span>
                                    </div>
                                  <input type="number" name="phone" class="form-control customInput" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required >
                                </div>


                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control customInput" name="username" id="username" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control customInput" name="password" id="password" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="cpassword">Confirm Password</label>
                                <input type="password" class="form-control customInput" name="cpassword" id="cpassword" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <button class="btn  btn-block btn-orange" type="submit" name="register">Register Now</button>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col">
                        <p class="text-center">Already have an account? <a href="login.php" class="text-orange">Log In</a> </p>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col">
                            <p class="text-center">Visit  <a href="index.php" class="text-orange"><i class="fa fa-home fa-fw"></i> Home</a> </p>
                        </div>
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