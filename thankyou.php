<?php 
  require 'dbCon.php';
  session_start();
  error_reporting(0);
 ?>
 <html> 
 <head>
 
  <meta charset="UTF-8">
   <meta name="author" content="">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
  <title>thank you for purchasing!</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/nav.css">   

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	</head>
	<style type="text/css">
		.button{
			text-decoration: none;
			color: white;
			float: right;
			margin-right: 50px;
			line-height: 90px;
			font-size: 25px;
		}
		.button:hover{
			text-decoration: none;
			color: orange;
		}
		.body{
			width: 100%;
		}
	</style>
	<body>
<nav style="height: 90px; background-color:#333;" >
             	<ul>
				  <li><a class="button" href="index.php">Home</a></li>
               </ul> 
</nav>
	<div class="container">
	   <div class="row justify-content-center">
			<div class="col-md-8">
				<h1 class="text-center">Thank you for purchasing!</h1>
				<?php
				include 'instamojo/Instamojo.php';
	            $api = new Instamojo\Instamojo('test_f61067f946af2451de2e9148159','test_429b7fe4d72369eb8783dbec3d5', 'https://test.instamojo.com/api/1.1/');
				$payid=$_GET['payment_request_id'];
		
				try{
					$response = $api->paymentRequestStatus($payid);
					
					?>
					<h2>Payments Details : </h2>
					<table class="table table-bordered">
					   <tr>
						  <th>Item lists:</th>
						  <td><?=$response['purpose']; ?></td>
						
					   </tr>
					   <tr>
					      <th>Payment ID :</th>
						  <td><?=$response['payments'][0]['payment_id']; ?></td>
					   </tr>
					   <tr>
						  <th>payee Name :</th>
						  <td><?=$response['payments'][0]['buyer_name']; ?></td>
						
					   </tr>
					   <tr>
						  <th>payee Email :</th>
						  <td><?=$response['payments'][0]['buyer_email']; ?></td>
						
					   </tr>
					   
					</table>
					
					
					
				<?php	
				}
				catch(Exception $e){
					print("Error: ".$e->getMessage());
					
				}
				
				?>
			</div>
		</div>
	</div>		  
  </body>
</html>


