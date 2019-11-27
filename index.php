<?php
require_once 'CompanyOperations.php';
if (isset($_POST['inform_owner'])){
    $item_reg=$_POST['registrationNo'];
    $founder_phone=$_POST['founder_phone'];


    //call sending the user message;
    $companyOr=new CompanyOperations();
    $response=$companyOr->saveFoundItems($item_reg,$founder_phone);
    echo "<script>alert('$response');</script>";
}
if (isset($_POST['report_lost'])){
    $reg_number=$_POST['itemRegistrationNumber'];
    $owner_phone=$_POST['owner_phone'];


    //call sending the user message;
    $companyOr=new CompanyOperations();
    $response=$companyOr->sendMessageIfExists($reg_number,$owner_phone);
    echo "<script>alert('$response');</script>";
}
?>



<!doctype html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <title>I-ItemRecovery|Item Recovery made Easy</title>
        <link rel="icon" href="files/icon.PNG" type="image/gif" sizes="16x16">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="css/metisMenu.min.css" rel="stylesheet">

        <!-- DataTables CSS -->
        <link href="css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="css/dataTables/dataTables.responsive.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="css/itemrecovery.css" rel="stylesheet" type="text/css">
        <style>
            .homeBtn{
                width: 200px;
            }

        </style>

    </head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top  customNavbar">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">I-ItemRecovery</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#"><i class="fa fa-home"> Home <span class="sr-only">(current)</span></i></a> </li>
                <li><a href="#"><i class="fa fa-list-ul"></i> Services</a></li>
                <li><a href="#"><i class="fa fa-android fa-fw"></i> Get App</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-users">Accounts <span class="caret"></span></i> </a>
                    <ul class="dropdown-menu">
                        <li><a href="register.php"><i class="fa fa-user-plus"> Open Account</i></a></li>
                        <li><a href="login.php"><i class="fa fa-lock fa-fw"> Login </i> </a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->

    </div>
</nav>
<div class="jumbotron text-center">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <h2><b>I-ItemRecovery|Item Recovery made Simple,easier and Faster by <i class="fa fa-inbox"> <b>SMS</b> </i> and <b>USSD</b></b></h2>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-12 col-md-12 text-center"><a href="#ReportFound"  data-target="#ReportFound" data-toggle="modal"><button class="btn btn-lg btn-info customBtn homeBtn"><h2><i class="fa fa-bullhorn"></i></h2> <h2>Found Item</h2></button></a>
                <a href="#ReportLost"  data-target="#ReportLost" data-toggle="modal"><button class="btn btn-lg btn-warning customBtn homeBtn"><h2><i class="fa fa-bullhorn"></i></h2><h2>Lost Item</h2></button></a></div>

        </div>
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <h3>Dial <b>*384*49002#</b> To access our USSD service.</h3>
            </div>
        </div>
    </div>
</div>


<!--This is the modal to inform the owner about a lost item-->
<div class="row">
    <div class="col-md-12">
        <!-- Modal -->
        <div class="modal fade" id="ReportFound" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="exampleModalLabel">---Report Found Item---</h5>
                        <p class="text-center text-info">Your friend lost an Item and you found it.Let them know that you have it.</p>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="reg">Item Registration Number</label>
                                <input type="text" id="reg" name="registrationNo" class="form-control customInput" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Your Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-addon customInput">+254</span>
                                    <input type="number" class="form-control customInput" name="founder_phone"  id="phone" aria-label="Amount (to the nearest dollar)" required>
                                </div>
                            </div>
                            <br/>
                            <div class="form-group center-block">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-success customBtn" name="inform_owner">Inform Owner</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Services page-->
<div class="container-fluid">
    <div class="row"><div class="col-md-12"><h2>Our Services</h2></div></div><hr/>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <p class="text-warning text-center text-orange"><i class="fa fa-4x fa-wechat"></i></p>
                    <p class="text-center text-orange">Instant Sms Notification</p>
                </div>
                <div class="card-body">
                    <p>Get instant SMS notification of your found item with the details of the Kenyan who found it.
                        To get access to this service it takes the following simple steps;
                    <ol>
                        <li><a class="text-warning" href="register.php">Register</a></li>
                        <li>Verify your phone number because this is the number that will be notified about a lost item.</li>
                        <li>Register all your Valuable Items.</li>
                    </ol>

                    </p>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <p class="text-warning text-center text-orange"><i class="fa fa-4x fa-phone"></i></p>
                    <p class="text-center text-orange">Shortcodes</p>
                </div>
                <div class="card-body">
                    <p>Did you loose an Item and you
                        are not rergistered?
                        You can check on the availability of the item directly by dialing <strong class="text-orange">*384*49002#</strong></p>
                    <p>Follow the instructions and you will get an sms notification regarding the availability of your Item.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <p class="text-warning text-center text-orange"><i class="fa fa-4x fa-chrome"></i></p>
                    <p class="text-center text-orange">Online Registration</p>
                </div>
                <div class="card-body">
                    <p>Our web application is a mobile responsive web application which gives you the ability register on our website
                        application with any mobile device.</p>

                    <p> Our application is designed putting into consideration all kinds of users.</p>
                    <a href="register.php"><button class="btn btn-warning btn-block customBtn" id="mybutton">Register Here</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Services Page
<div class="row container">
    <div class="col-sm-4">
        <div class="card">
            <h3 class="text-center text-orange"><i class="fa fa-fw fa-bullhorn"></i></h3>
            <div class="card-title text-center"><h4><b>Instant SMS Notications</b></h4> </div>
            <div class="card-body">
                <h5 class="text-center">I-ItemRecovery was designed to reach everybody who gets access to phone.You just have to register with a smart phone in our online
                portal and instant notifications reaches you whenever you loose a registered Item and a Kenyan of good heart fiends it and posts on the site.</h5>
            </div>

        </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
            <h3 class="text-center text-orange"><i class="fa fa-fw fa-phone-square"></i></h3>
            <div class="card-title text-center"><h4><b>USSD Code</b></h4> </div>
            <div class="card-body">
                <h5>Not registered in <a href="index.php">I-ITEMRECOVERY</a> and lost an item? .Our application has your back here.You just dial <b>*384*49002#</b> and follow instructions to know the stataus of your item.</h5>
            </div>

        </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
            <h3 class="text-center text-orange"><i class="fa fa-fw fa-umbrella"></i></h3>
            <div class="card-title text-center"><h4><b>Security</b></h4> </div>
            <div class="card-body">
                <h5 class="text-center">We know the value of the items you have registered in  <a href="index.php">I-ITEMRECOVERY</a>.We have ensured confidentality and integrity of the information that our server stores
                to ensurer that the right people get the right information.</h5>
            </div>

        </div>
    </div>


</div>-->
<!--This is the modal to popup when you open lose an item-->
<div class="row">
    <div class="col-md-12">
        <!-- Modal -->
<div class="modal fade" id="ReportLost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">---Report Lost Item---</h5>
                <p class="text-center text-info">You have lost an item and we believe someone found it.If registered in our system you will get sms notification with details of the founder</p>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <div class="form-group">
                        <label for="reg">Item Registration Number</label>
                        <input type="text" id="reg" name="itemRegistrationNumber" class="form-control customInput" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Your Phone Number</label>
                        <div class="input-group">
                            <span class="input-group-addon customInput">+254</span>
                            <input type="number" class="form-control customInput" name="owner_phone"  id="phone" aria-label="Amount (to the nearest dollar)" required>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group center-block">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-success customBtn" name="report_lost">Report Lost Item</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>






<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="js/dataTables/jquery.dataTables.min.js"></script>
<script src="js/dataTables/dataTables.bootstrap.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="js/startmin.js"></script>
</body>
</html>