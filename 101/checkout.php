<?php

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

require 'start.php';

session_start();
$_SESSION['first_name'] = $_GET['first_name'];
$_SESSION['last_name'] = $_GET['last_name'];
$_SESSION['student_num'] = $_GET['student_num'];
$_SESSION['email'] = $_GET['email'];
$_SESSION['diet'] = $_GET['diet'];


$price = 100;
$payer = new Payer();
$payer->setPaymentMethod('paypal');

$item= new Item();
$item->setName("101 Kit/Trouse 101")
	->setCurrency('CAD')
	->setQuantity(1)
	->setPrice($price);

$itemList = new ItemList();
$itemList->setItems([$item]);

$details = new Details();
$details->setSubtotal($price);

$amount = new Amount();
$amount->setCurrency('CAD')
	->setTotal($price)
	->setDetails($details);

$transaction = new Transaction();
$transaction->setAmount($amount)
	->setItemList($itemList)
	->setDescription('101 kit')
	->setInvoiceNumber(uniqid());

$redirectURLs = new RedirectUrls();
$redirectURLs->setReturnUrl (SITE_URL.'/101/pay.php?success=true')
	->setCancelUrl (SITE_URL.'/101/pay.php?success=false');

$payment = new Payment();
$payment->setIntent('sale')
	->setPayer($payer)
	->setRedirectUrls($redirectURLs)
	->setTransactions([$transaction]);

try{
	$payment->create($paypal);
}catch(Exception $e){
	echo $e->getCode(); // Prints the Error Code
    echo $e->getData(); // Prints the detailed error message 
	die($e);
}

$approvalUrl = $payment->getApprovalLink();
header("Location: {$approvalUrl}");