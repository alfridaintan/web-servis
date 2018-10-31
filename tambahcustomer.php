<?php
include ('Stripegateway.php');

$myStripe = new Stripegateway();

if(isset($_POST['btnsubmit'])){
	$data = array('email' => $_POST['email'],
				'description' => $_POST['description']);
	$result = $myStripe->create_customer($data);
	
	print_r($result);
}
?>