<?php
	session_start();


	    $item_name = $_GET['itmname'];
		$reservation_phone = $_GET['phone'];
		$reservation_date = $_GET['date'];
		$reservation_time = $_GET['time'];
		$total_price = $_GET['price'];
		$email= $_GET['email'];

	 
	include 'instamojo/Instamojo.php';
	$api = new Instamojo\Instamojo('test_f61067f946af2451de2e9148159','test_429b7fe4d72369eb8783dbec3d5', 'https://test.instamojo.com/api/1.1/');
	
	try 
{    $response = $api->paymentRequestCreate(array(
        "purpose" => "$item_name",
        "amount" => "$total_price",
        "send_email" => true,
        "email" => "$email",
		"phone"=>"$reservation_phone",
		"dine"=>"$reservation_time",
		"adrr"=>"$reservation_date",
		"send_sms"=> true,
		"allow_repeated_payments"=> false,
        "redirect_url" => "http://localhost/TableReservation/thankyou.php"
		
        ));
    
	
	$pay_url=$response['longurl'];
	header("location:$pay_url");
    }
    catch (Exception $e) {
           print('Error: ' . $e->getMessage());
    }

?>

