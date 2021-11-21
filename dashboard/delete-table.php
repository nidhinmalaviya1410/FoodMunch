	<!-- delete-chair.php -->
<?php
	if (isset($_GET['table_id'])) {
		$id =$_GET['table_id'];
		$sql ="DELETE FROM `restaurant_tables` WHERE id = '$id';";
		include_once 'dbCon.php';
		$con = connect();
		if ($con->query($sql) === TRUE) {
		echo '<script>alert("DELETED.")</script>'; ?>
		
<?php		
		echo '<script>location.href ="table-list.php";</script>';
		//header("Location: view-chair-list.php?table_id=".$tbl_id."");
	    } else {
			echo "Error: " . $sql . "<br>" . $con->error;
		} 
	}
?>