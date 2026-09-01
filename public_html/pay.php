<?php 
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();

$plan_name = $_POST["plan_name"] ;
$price = $_POST["plan_amount"] ;
$name =$_POST["name"] ;
$phone = $_POST["mobile"];
$email =  $_POST["email"];

print_r($email);
include 'src/instamojo.php';

$api = new Instamojo\Instamojo('842d822a9e553159f1eba96d96a81671','41722f110e2a8f964552c137e21d30ad','https://www.instamojo.com/api/1.1/');


try {
    $response = $api->paymentRequestCreate(array(
        "purpose" => $plan_name,
        "amount" => $price,
        "buyer_name" => $name,
        "phone" => $phone,
        "send_email" => true,
        "send_sms" => true,
        "email" => $email,
        'allow_repeated_payments' => false,
        "redirect_url" => "http://bestjodi.net/thankyou.php",
        "webhook" => "http://bestjodi.net/webhook.php"
        ));
    //print_r($response);

    $pay_ulr = $response['longurl'];
    
    //Redirect($response['longurl'],302); //Go to Payment page

    header("Location: $pay_ulr");
    exit();

}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}     
  ?>