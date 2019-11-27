<?php
error_reporting(E_ALL);
//Check if the user is logged in else redirect to login in page;
require_once 'CompanyOperations.php';
if(! isset($_SESSION['username'])){
    header("Location:login.php");
    exit();
}

//Get the session variables;
$phone=$_SESSION['phone'];
$user_name=$_SESSION['username'];

//Here we perform Iinsertion of new Items;
$profileO=new CompanyOperations();
if(isset($_POST['registerItem'])){
    $type=$_POST['type'];
    $regno=$_POST['regno'];
    $description=$_POST['description'];
    if ($type=="selectType"){
        echo "<script type='text/javascript'>alert('Select Item Type Please');</script>";
    }
    else{
        $response=$profileO->registerItems($user_name,$type,$regno,$description);
        echo "<script type='text/javascript'>alert('$response');</script>";
    }


}

//Get your Registered Items;
$items=$profileO->getMyItems($user_name);

//Save Found Items to Database and inform the owner;
if(isset($_POST['inform_owner'])){
    $registration_number=$_POST['registrationNo'];
    $founder_phone=$_POST['founder_phone'];

    //Do registration Here;
    $response=$profileO->saveFoundItems($registration_number,$founder_phone);
    echo "<script type='text/javascript'>alert('$response');</script>";
}
if (isset($_POST['saveLostItem'])){
    //Get variables;
    $item_reg=$_POST['item_regNumber'];
    $owner_phone=$_POST['owner_phone'];
    $response=$profileO->saveUpdateLostItem($item_reg,$owner_phone);
    echo "<script type='text/javascript'>alert('$response');</script>";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="files/icon.PNG" type="image/gif" sizes="16x16">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>My Profile-I-ItemRecovery</title>

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
		
		
		

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<style>


</style>
<?php
 
	/*$result = mysqli_query($con, "SELECT * FROM event_detail where user_id = '$logged_in_id'"); //fetch event of a user logged in
	
	
	if(!empty($_GET['id'])){
	$sql = "DELETE FROM event_detail WHERE id='".$_GET['id']."'";

	if (mysqli_query($con, $sql) === TRUE) {
    $msg =  "Event deleted successfully!!!";
	 echo "<script type='text/javascript'>alert('$msg');</script>";
	 header("refresh:1; url=my_profile.php");
} else {
    $msg =  "Error deleting image: " . $conn->error;
	echo "<script type='text/javascript'>alert('$msg');</script>";
	header("refresh:1; url=my_profile.php");
}
	}*/
 
?>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="#"><font style="font-family:myFirstFont;font-size: 40px;">I-ItemRecovery</font></a>
        </div>

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <!-- Top Navigation: Left Menu -->
        <ul class="nav navbar-nav navbar-left navbar-top-links">
            <li><a href="#"><i class="fa fa-home fa-fw" ></i></a></li>
        </ul>

        <!-- Top Navigation: Right Menu -->
        <ul class="nav navbar-right navbar-top-links">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <?php echo $user_name;?><b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>

					
                </ul>
            </li>  
        </ul>

        <!-- Sidebar -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">

                 <ul class="nav" id="side-menu">
				<br>
				<figure>
				<img src="images/profile.png" align="center" alt="Avatar" style="margin-left:75px;width:100px; border-radius: 50%;background-color: white;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
				</br>
				<figcaption align="center" style="margin-top:10px;margin-bottom:15px">WELCOME,&nbsp; <b><?php echo $user_name;?></b>&nbsp;&nbsp;<a href="user_profile.php"><i class="fa fa-edit"></i></a></figcaption>
				</figure>
                    
                    
                    <li id="profile">
                        <a href="#Profile"  data-target="#Profile" data-toggle="modal"><i class="fa fa-star fa-fw"></i> My Profile</a>
                    </li>
					<li>
                        <a href="" ><i class="fa fa-list-ol fa-fw"></i> My Items <span class="badge"><?php echo count($items);?></span> </a>
                    </li>
					<li>
                        <a href="#report_found" data-target="#report_found" data-toggle="modal" class="active"><i class="fa fa-bullhorn fa-fw"></i> Report Found Item</a>
                    </li>
					<li>
                        <a href="#report_lost" data-target="#report_lost" data-toggle="modal"><i class="fa fa-bullhorn fa-fw"></i> Report Lost Item</a>
                    </li>

                     
                </ul>

            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><font style="font-family:myFirstFont;font-size: 40px;">My Items</font></h1>
                    <div class="pull-right">
                        <a href="#new_item" data-target="#new_item" data-toggle="modal"><button class="btn-orange btn customBtn"><span class="fa fa-edit fa-fw"></span> New Item</button></a>
                    </div>
                    <br><br>
                </div>
            </div>
			 <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                               
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#NO</th>
                                                <th>Registration Number</th>
                                                <th>Item Type</th>
                                                <th>Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $number=0;
                                        foreach ($items as $item){
                                            $number++;
                                        ?>
                                            <tr><td><?php echo $number;?></td>
                                                <td><?php echo $item['registration_number'];?></td>
                                                <td><?php echo $item['item_category'];?></td>
                                                <td><?php echo $item['description'];?></td>
                                            </tr>
                                        <?php }?>


                                      
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
            <!-- ... View Profile Here ... -->
            <div class="row container-fluid">
                <div class="col-md-12">
                    <!-- Modal -->
                    <div class="modal fade" id="Profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                   <div class="panel-body">
                                       <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
                                           <br>
                                           <p class=" text-info">Last updated: May 05,2018</p>
                                       </div>
                                       <div class="panel panel-info">
                                           <div class="panel-heading">
                                               <h3 class="panel-title"><font style="font-family:myFirstFont;font-size: 25px;color:white;"></font></h3>
                                           </div>
                                           <div class="panel-body">
                                               <div class="row">
                                                   <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="images/profile.png" class="img-circle img-responsive"> </div>

                                                    <div class=" col-md-9 col-lg-9 ">
                                                       <table class="table table-user-information">
                                                           <tbody>
                                                           <tr>
                                                               <td>First Name:</td>
                                                               <td>KILIMO</td>
                                                           </tr>
                                                           <tr>
                                                               <td>Last Name</td>
                                                               <td>Cornelius Kipkorir</td>
                                                           </tr>
                                                           <tr>
                                                               <td>Phone Number</td>
                                                               <td>32060756</td>
                                                           </tr>

                                                           <tr>
                                                               <td>Username</td>
                                                               <td><a href="#">kilimoc@gmail.com</a></td>
                                                           </tr>

                                                           </tr>

                                                           </tbody>
                                                       </table>


                                                   </div>
                                               </div>
                                           </div>
                                           <div class="panel-footer">
                                               <span class="pull-right">
                            <a href="#" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i>Edit Profile</a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" data-dismiss="modal" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                        </span>
                                           </div>

                                       </div>
                                   </div>
                                </div>

                                    </div>
                                </div>




                            </div>
                        </div>
                    </div>
            <!--Report Lost item Here-->
            <div class="row">
                <div class="col-sm-8 col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Modal -->
                            <div class="modal fade" id="report_lost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center" id="exampleModalLabel">---Report Lost Item---</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="">
                                            <div class="form-group">
                                                <label for="reg">Item Registration Number</label>
                                                <input type="text" id="reg" name="item_regNumber" class="form-control customInput" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Your Contact Phone</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon customInput">+254</span>
                                                    <input type="text" class="form-control customInput" id="myPhone" aria-label="Amount (to the nearest dollar)" name="owner_phone">
                                                    <span class="input-group-btn customInput">
                                                        <button class="btn btn-warning customInput" onclick='getMyPhone("myPhone")' type="button">Pick My Number</button>
                                                      </span>
                                                </div>
                                            </div>
                                                <br/>
                                                <div class="form-group center-block">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    <div class="pull-right">
                                                    <button type="submit" class="btn btn-orange customBtn" name="saveLostItem">Report Item</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>




                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Report found Item-->
                    <div class="row">
                        <div class="col-sm-8 col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Modal -->
                                    <div class="modal fade" id="report_found" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-center" id="exampleModalLabel">---Report Found Item---</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="">
                                                    <div class="form-group">
                                                        <label for="reg">Item Registration Number</label>
                                                        <input type="text" id="reg" name="registrationNo" class="form-control customInput" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone">Your Contact Phone</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon customInput">+254</span>
                                                            <input type="number" class="form-control customInput" name="founder_phone"  id="activeNumber" aria-label="Amount (to the nearest dollar)" required>
                                                            <span class="input-group-btn customInput">
                                                        <button class="btn btn-warning customInput" onclick='getMyPhone("activeNumber")' type="button">Pick My Number</button>
                                                      </span>
                                                        </div>
                                                    </div>
                                                    <br/>
                                                    <div class="form-group center-block">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        <div class="pull-right">
                                                            <button type="submit" class="btn btn-orange customBtn" name="inform_owner"><i class="fa fa-bullhorn fa-fw"></i> Inform Owner</button>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>




                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                </div>
            </div>
                    <!--Register New Item-->
                    <div class="row">
                        <div class="col-sm-8 col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Modal -->
                                    <div class="modal fade" id="new_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-center" id="exampleModalLabel">---New Item Registration--</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="">
                                                    <div class="form-group">
                                                        <label for="type">Item Type</label>
                                                        <select class="form-control customInput" id="type" name="type">
                                                            <option class="customInput" value="selectType">Select Type</option>
                                                            <option value="National ID">National ID</option>
                                                            <option value="School ID">School ID</option>
                                                            <option value="Work ID">Work ID</option>
                                                            <option value="NHIF Card">NHIF Card</option>
                                                            <option value="ATM Card">ATM Card</option>
                                                            <option value="NSSF Card">NSSF Card</option>
                                                            <option value="Certificates">Certificates</option>
                                                            <option value="Mobile Phone">Mobile Phone</option>
                                                            <option value="Laptop">Laptop</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="regno">Registration Number</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon customInput"><i class="fa fa-edit fa-fw"></i> </span>
                                                            <input type="text" id="regno" class="form-control customInput" name="regno" aria-label="Amount (to the nearest dollar)" required>
                                                        </div>
                                                    </div>
                                                        <div class="form-group">
                                                            <label for="regno">Description</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon customInput"><i class="fa fa-edit fa-fw"></i> </span>
                                                                <textarea type="text" id="description" placeholder="Enter short description of the item .Not more than 100 words" class="form-control customInput" name="description" aria-label="Amount (to the nearest dollar)" required></textarea>
                                                            </div>
                                                        </div>

                                                    <br/>
                                                    <div class="form-group center-block">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        <div class="pull-right">
                                                            <button type="submit" class="btn btn-orange customBtn" name="registerItem">Secure Item</button>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>




                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                    <!--Other Modals Goes Here-->


                </div>
            </div>

            <!--    Map showing all locations of events--->



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
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCe1vj_uMJURIlRZmb0rO31CLxCel03b48&callback=myMap"></script>


        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                        responsive: true
                });
            });

            $('a[href$="#Profile"]').on( "click", function() {
                $('#Profile').modal();
            });`





            </script>
            <script>
                function getMyPhone(field){
                    var active_number="<?php echo $phone;?>";
                    var phoneText=document.getElementById(field);
                    phoneText.value=active_number;
                }

            </script>






</body>
</html>
