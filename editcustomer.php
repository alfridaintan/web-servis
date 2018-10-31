<?php
include ('Stripegateway.php');

$myStripe = new Stripegateway();

if(isset($_POST['btnsubmit'])){
$data = array('ID' => $_POST['ID'],
			 'email' => $_POST['email'],
			 'description' => $_POST['description']);

$result = $myStripe->update_customer($data);
	echo "<pre>"; print_r($result);}

?>