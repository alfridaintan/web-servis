<?php
include('Stripegateway.php');

$myStripe = new Stripegateway();
if(isset($_POST['btnsubmit'])){
	$data = array('ID' => $_POST['ID']);

	$result = $myStripe->delete_customer($data);
	echo "<pre>"; 
	print_r($result);
}
?>
