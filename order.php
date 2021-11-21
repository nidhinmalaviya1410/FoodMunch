<!-- booking-list.php -->

<?php 
include 'dashboard/template/header.php'; 
if (!isset($_SESSION['isLoggedIn'])) {
	echo '<script>window.location="login.php"</script>';
}

?>
	<head>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	</head>
	<body>
		<section class="body">

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<nav id="menu" class="nav-main" role="navigation">
				<ul class="nav nav-main">
					<li class="nav-active">
						<a href="index.php">
							<i class="fa fa-home" aria-hidden="true"></i>
							<span>Dashboard</span>
						</a>
					</li>
				</ul>
				</nav>
				<!-- end: sidebar -->

				<section role="main" class="content-body">

					<!-- start: page -->
						
						<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
									<a href="#" class="fa fa-times"></a>
								</div>
						
								<h2 class="panel-title">All Bookings</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="dashboard/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
									<thead>
										<tr>
											<th>No</th>
											<th>Transaction Id</th>
											<th>Name</th>
											<th>Phone</th>
											<th>Date</th>
											<th>Time</th>
											<th>Bill</th>
											<th class="hidden-phone">Status</th>
											<th class="hidden-phone">Action</th>
									
										</tr>
									</thead>
									<tbody>
										<?php
										$count = 1;
										include 'dbCon.php';
										$con = connect();
										$res_id = $_SESSION['id'];		
								
										$sql = "SELECT * FROM `booking_details` WHERE c_id = '$res_id'  ORDER BY make_date DESC";
										$result = mysqli_query($con,$sql)or die("XXXXXXXXXXXXXX");
										$r = mysqli_fetch_all($result, MYSQLI_ASSOC);

										$row=mysqli_num_rows($result);

										$sql1 = "SELECT * FROM `restaurant_info`";
										$result1 = mysqli_query($con,$sql1)or die("XXXXXXXXXXXXXX");
										$r1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);
										
										$row1=mysqli_num_rows($result1);
								
										if($row>0 && $row1>0)
										{
											for($i=0;$i<$row;$i++)
											{
											?>
												<tr class="gradeX">
													<td class="center hidden-phone"><?php echo $count; ?></td>
													<td class="center hidden-phone"><?php echo $r[$i]['transactionid']; ?></td>
													<td><?php echo $r[$i]['name']; ?></td>
													<td><?php echo $r[$i]['phone']; ?></td>
													<td><?php echo $r[$i]['booking_date']; ?></td>
													<td><?php echo $r[$i]['booking_time']; ?></td>
													<td><?php echo $r[$i]['bill']; ?> ₹</td>
													<td class="center hidden-phone">
														<?php 
															$status = $r[$i]['status'];
															if ($status == 0) {
														?>
														<p class="text-danger">Rejected</p>
														<?php }else{ ?>
															<p class="text-success">Confirmed</p>
														<?php } ?>
													</td>
													<td class="center hidden-phone">
												<?php 
													if ($status == 1) {
												?>
												<a href="dashboard/approve-reject.php?breject_id=<?php echo $r['id']; ?>&booking-number=<?php echo $r['booking_id']; ?>" class="btn btn-danger"  onclick="if (!Done()) return false; ">Reject</a>
												<?php }else{ ?>
												<a href="dashboard/approve-reject.php?bapprove_id=<?php echo $r['id']; ?>&booking-number=<?php echo $r['booking_id']; ?>" class="btn btn-success"  onclick="if (!Done()) return false; ">Confirm</a>	
												<?php } ?>
													
												</tr>
											<?php 
											} 
										}?>
									</tbody>
								</table>
							</div>
						</section>
						
						
					<!-- end: page -->
				</section>
			</div>
		</section>
		<script type="text/javascript">
	       function Done(){
	         return confirm("Are you sure?");
	       }
   		</script>

		<?php include 'dashboard/template/script-res.php'; ?>
	</body>
</html>



