<?php
/**
 * Created by PhpStorm.
 * User: victoryland
 * Date: 5/21/14
 * Time: 9:33 PM
 */

require_once('autoload.php');

if (isset($_REQUEST['security_token']) && $_REQUEST['security_token'] === 'gatekeeper404') {
    $firstName = $_REQUEST['firstName'];
    $lastName = $_REQUEST['lastName'];
    $sellerName = $firstName . " " . $lastName;
    $sellerEmail = $_REQUEST['email'];
    $price = $_REQUEST['price'];
    $street = $_REQUEST['street'];
    $city = $_REQUEST['city'];
    $state = $_REQUEST['state'];
    $zip = $_REQUEST['zip'];
    $address = $street . ", " . $city . ", " . $state . ", " . $zip . ".";

    $client = new HelloSign\Client(API_KEY);
    $request = new HelloSign\TemplateSignatureRequest;
    $request->enableTestMode();
    $request->setTemplateId(TEMPLATE_RRU_FRONTEND_CONTRACT_ID);
    $request->setSubject('RRU Front End Contract');
    $request->setMessage("Please review the easy to understand contract and sign digitally. It's pretty easy to do, but if you have any questions, feel free to contact me. \n \nTracy Caywood \n \n(904) 419-7325 CALL OR TEXT \ntracycaywood@gmail.com");
    $request->setSigner('Seller', $sellerEmail, $sellerName);
    $request->setSigner('Buyer', BUYER_EMAIL, BUYER_NAME);
    $request->setCustomFieldValue("Buyer's Name", BUYER_NAME);
    $request->setCustomFieldValue("Seller's Name", $sellerName);
    $request->setCustomFieldValue("Purchase Price $", $price);
    $request->setCustomFieldValue("Complete Property Address", $address);
    $request->setCustomFieldValue("Additional Terms", 'Terms Terms Terms Testing Testing API');

    $response = $client->sendTemplateSignatureRequest($request);

    debug($response);
}