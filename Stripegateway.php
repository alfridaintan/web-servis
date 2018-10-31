<?php 
 
include("vendor/autoload.php"); 
 
class Stripegateway {
	
	public function __construct(){
		$stripe = array(
			"secret_key" => "sk_test_TlGX3xH41dd66FGNsFoqUazZ",
			"public_key" => "pk_test_eWMR3zYfqAl1ivOFaocoOyIJ"
		);
		\Stripe\Stripe::setApiKey($stripe["secret_key"]);
	}
	
	public function checkout($data){
		$message = "";
		try{
			$mycard = array('number' => $data['number'],
							'exp_month' => $data['exp_month'],
							'exp_year' => $data['exp_year']);
			$charge = \Stripe\Charge::create(array('card'=>$mycard,
													'amount'=>$data['amount'],
													'currency'=>'usd'));
			$message = $charge->status;											
		}catch (Exception $e){
			$message = $e->getMessage();
		}	
		return $message;
	}
	
	public function update_charger($data){
		$message = "";
		try{
			//ch_1DPTekLmWhAjcIL9iUNsp72y
			$ch = \Stripe\Charge::retrieve($data["ID"]);
			$ch->email = $data["email"];
			$ch->description = $data["description"];
			$message =	$ch->save();
		}catch (Exception $e){
			$message = $e->getMessage();
		}	
		return $message;	
	}
	
	public function payment_detail($ID){
		$message = "";
		try{
			$ch = \Stripe\Charge::retrieve($ID);			
		$message =	$ch->capture();
		}catch (Exception $e){
			$message = $e->getMessage();
		}	
		return $message;	
	}
	
	
	public function create_customer ($data){
		$message = "";
		try{
			$cu = \Stripe\Customer::create(array('email'=>$data['email'], 'description'=>$data['description']));
			$message  = $cu->status;											
		}catch (Exception $e){
			$message = $e->getMessage();
		}

		return $message;
	}

	public function update_customer($data){
		$message = "";
		try{
			$cu = \Stripe\Customer::retrieve($data["ID"]);
			
			$cu->email 		 = $data["email"];
			$cu->description = $data["description"];
			$message =	$cu->save();
		}catch (Exception $e){
			$message = $e->getMessage();
		}	
		return $message;	
	}

	public function delete_customer($data){
		$message = "";
		try{
			$cu = \Stripe\Customer::retrieve($data["ID"]);
			$cu->delete();
		}catch (Exception $e){
			$message = $e->getMessage();
		}	
		return $message;	
	}
	
}
?>