<?php

SESSION_START();
$username1=$_POST['username1'];
$email=$_POST['email'];
$comment=$_POST['comment'];


    $servername = "localhost";
	$username = "root";
	$password = "";
	$dbName = "res_booking";
$conn = new mysqli($servername,$username,$password,$dbName);
if($conn->connect_error)
{
	die("connection is failed".$conn->connect_error);
}
$sql= "INSERT INTO feedback (username,email,comment) values('$username1','$email','$comment')";
if($conn->query($sql)===True)
{
	echo "Data inserted successfully";
	
	?>
	<script>
		location.href = "index.php";
</script>
<?php
}
else
{
    echo "Data is not inserted".$conn->error;
    ?>
	<script>
		location.href = "index.php";
</script>
<?php
}

$conn->close();
?>