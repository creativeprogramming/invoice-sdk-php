<?php
require_once('PPBootStrap.php');

/*
 *  # GetInvoiceDetails API
 Use the GetInvoiceDetails API operation to get detailed information about an invoice.
 This sample code uses Invoice PHP SDK to make API call
 */
?>
<html>
<head>
	<title>PayPal Invoicing - GetInvoiceDetails Sample API Page</title>
	<link rel="stylesheet" type="text/css" href="sdk.css"/>
	<script type="text/javascript" src="sdk.js"></script>
</head>
<body>
<h2>GetInvoiceDetails API Test Page</h2>
<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {

	/*
	 *  ##GetInvoiceDetailsRequest
		 Use the GetInvoiceDetailsRequest message to get detailed information
		 about an invoice.

		 The code for the language in which errors are returned, which must be
		 en_US.
	 */
	$requestEnvelope = new RequestEnvelope("en_US");
	
	/*
	 *  GetInvoiceDetailsRequest which takes mandatory params:
		
		 * `Request Envelope` - Information common to each API operation, such
		 as the language in which an error message is returned.
		 * `Invoice ID` - ID of the invoice to retrieve.
	 */
	$getInvoiceDetailsRequest = new GetInvoiceDetailsRequest($requestEnvelope, $_POST['invoiceID']);
	
	/*
	 *  ## Creating service wrapper object
		 Creating service wrapper object to make API call and loading
		 configuration file for your credentials and endpoint
	 */
	$invoiceService = new InvoiceService();
	// required in third party permissioning
	if(($_POST['accessToken']!= null) && ($_POST['tokenSecret'] != null)) {
		$invoiceService->setAccessToken($_POST['accessToken']);
		$invoiceService->setTokenSecret($_POST['tokenSecret']);
	}
	try {

		/*
		 *  ## Making API call
					 Invoke the appropriate method corresponding to API in service
					 wrapper object
		 */
		$getInvoiceDetailsResponse = $invoiceService->GetInvoiceDetails($getInvoiceDetailsRequest);
	} catch (Exception $ex) {
		require_once 'error.php';
		exit;
	}
	echo "<table>";
	echo "<tr><td>Ack :</td><td><div id='Ack'>". $getInvoiceDetailsResponse->responseEnvelope->ack ."</div> </td></tr>";
	echo "</table>";
	require 'ShowAllResponse.php';
	echo "<pre>";
	var_dump($getInvoiceDetailsResponse);
	echo "</pre>";
} else {
?>
<form method="POST">
<div id="apidetails">The GetInvoiceDetails API operation is used to get detailed information about an invoice.</div>
<div class="params">
<div class="param_name">Invoice ID *</div>
<div class="param_value"><input type="text" name="invoiceID" value=""
	size="50" maxlength="260" /></div>
</div>
<br/>
<?php
include('permissions.php');
?>
<input type="submit" name="GetInvoiceDetailsBtn" value="Get Invoice Details" /></form>
<?php
}
?>
<br/><br/><a href="index.php" >Home</a>
</body>
</html>