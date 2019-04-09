<?php 
	require_once('../vendor/autoload.php'); 
	require_once('../config/db.php');
	require_once('../lib/pdo_db.php'); 
	require_once('../models/Participant.php');
	require_once('../models/Transaction.php');

	$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

	if (
		!empty($_POST['payment_method_nonce']) &&
		!empty($_POST['first_name']) &&
		!empty($_POST['middle_name']) &&
		!empty($_POST['last_name']) &&
		!empty($_POST['category']) &&
		!empty($_POST['birth_date']) &&
		!empty($_POST['email']) &&
		!empty($_POST['phone']) &&
		!empty($_POST['nationality']) &&
		!empty($_POST['address']) &&
		!empty($_POST['city']) &&
		!empty($_POST['zip']) &&
		!empty($_FILES['score1']['name'][0]) &&
		!empty($_FILES['audio']['name'][0])
	) {
		$nonceFromTheClient = $POST['payment_method_nonce'];
		$first_name = $POST['first_name'];
		$middle_name = $POST['middle_name'];
		$last_name = $POST['last_name'];
		$category = $POST['category'];
		$birth_date = $POST['birth_date'];
		$email = $POST['email'];
		$phone = $POST['phone'];
		$nationality = $POST['nationality'];
		$address = $POST['address'];
		$city = $POST['city'];
		$zip = $POST['zip'];
		$first_score = $_FILES['score1']['name'];
		$second_score = (empty($_FILES['score2']['name'])) ? 'Not Provided' : $_FILES['score2']['name'];
		$audio = $_FILES['audio']['name'];
	} else {
		header('Location: failure.php');
		return false;
	}

	var_dump($_FILES);

	$gateway = new Braintree_Gateway([
	    'environment' => 'sandbox',
	    'merchantId' => 'dyt588zb54fwzht6',
	    'publicKey' => 'mppjtss4zsw7g4mz',
	    'privateKey' => '929f5707d189eb308ffda34612653034'
	]);

	$clientToken = $gateway->clientToken()->generate();

	$participant = $gateway->customer()->create([
	    'firstName' => $first_name,
	    'lastName' => $last_name,
	    'email' => $email,
	    'paymentMethodNonce' => $nonceFromTheClient
	]);

	$transaction = $gateway->transaction()->sale([
	  'amount' => '50.00',
	  'customerId' => $participant->customer->id,
	  'options' => [
	    'submitForSettlement' => True
	  ]
	]);

	if ($participant->success) {
		$token = $participant->customer->paymentMethods[0]->token;

	    $participantData = [
			'id' => $participant->customer->id,
			'name' => $first_name.' '.$middle_name.' '.$last_name,
			'category' => $category,
			'birth' => $birth_date,
			'email' => $email,
			'phone' => $phone,
			'nationality' => $nationality,
			'address' => $address.', '.$city.' '.$zip,
			'first_score' => $first_score,
			'second_score' => $second_score,
			'audio' => $audio
		];

		$transactionData = [
			'id' => $token,
			'participant_id' => $participant->customer->id,
			'amount' => $transaction->transaction->amount.$transaction->transaction->currencyIsoCode,
			'status' => $transaction->transaction->status
		];

		$participant = new Participant;
		$participant->addParticipant($participantData);

		$transaction = new Transaction;
		$transaction->addTransaction($transactionData);

		header('Location: success.php?tid='.$token);
	} else {
	    foreach($participant->errors->deepAll() as $error) {
	        echo($error->code . ": " . $error->message . "\n");
	    }
	}
?>