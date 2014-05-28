<?php
/**
 * Created by PhpStorm.
 * User: victoryland
 * Date: 5/21/14
 * Time: 9:33 PM
 */

require_once('autoload.php');

if (isset($_REQUEST['security_token']) && $_REQUEST['security_token'] === 'gatekeeper404') {
    $id = $_REQUEST['id'];
    $sellerEmail = $_REQUEST['email'];
    $street = $_REQUEST['street'];
    $city = $_REQUEST['city'];
    $state = $_REQUEST['state'];
    $zip = $_REQUEST['zip'];
    $seller_phone = $_REQUEST['phone'];
    $address = $street . ", " . $city . ", " . $state . ", " . $zip . ".";

    $zohoConnector = new ZohoDataSync();
    $offerDetails = $zohoConnector->getRecordById(OFFER_MODULE, $id, 2);

    $xml = simplexml_load_string($offerDetails);

    if (isset($xml->result) && isset($xml->result->CustomModule1)) {
        foreach ($xml->result->CustomModule1->row as $key => $value) {
            foreach ($value->FL as $key => $row) {
                $temp_value = (string)$row['val'];
                $temp_data = (trim($row) !== 'null') ? trim($row) : "N/A";
                if (strtolower($temp_value) == strtolower('Purchase Price')) {
                    $price = $temp_data;
                } else if (strtolower($temp_value) == strtolower('Time for Closing')) {
                    $time = $temp_data;
                } else if (strtolower($temp_value) == strtolower('Closing Agent')) {
                    $closing = $temp_data;
                } else if (strtolower($temp_value) == strtolower('Property Taxes')) {
                    $proTax = $temp_data;
                } else if (strtolower($temp_value) == strtolower('Delinquent Property Taxes')) {
                    $delTax = $temp_data;
                } else if (strtolower($temp_value) == strtolower('Occupancy')) {
                    $occupancy = $temp_data;
                } else if (strtolower($temp_value) == strtolower('Additional Terms 1')) {
                    $term1 = $temp_data;
                } else if (strtolower($temp_value) == strtolower('Additional Terms 2')) {
                    $term2 = $temp_data;
                } else if (strtolower($temp_value) == strtolower('Additional Terms 3')) {
                    $term3 = $temp_data;
                } else if (strtolower($temp_value) == strtolower('Seller Lead')) {
                    $name = $temp_data;
                }
            }
        }
    }

    $client = new HelloSign\Client(API_KEY);
    $request = new HelloSign\TemplateSignatureRequest;

    //$request->enableTestMode();
    $request->setTemplateId(TEMPLATE_ALL_CASH_CONTRACT_ID);
    $request->setSubject("All Cash Contract - $address");
    $request->setMessage("Please review our simple all cash contract and sign where indicated. If you have any questions, please contact me. \n \nTime is of the essence. \n \nThank You.");
    $request->setSigner('Seller', $sellerEmail, $name);
    $request->setCustomFieldValue("Seller's Name ", $name);
    $request->setCustomFieldValue("State", $state);
    $request->setCustomFieldValue("Complete Property Address", $address);
    $request->setCustomFieldValue("Purchase Price ", $price);
    $request->setCustomFieldValue("Time for Closing", $time);
    $request->setCustomFieldValue("Closing Agent", $closing);
    $request->setCustomFieldValue("ProRated Property Taxes", $proTax);
    $request->setCustomFieldValue("Delinquent Property Taxes", $delTax);
    $request->setCustomFieldValue("Occupancy And Possession", $occupancy);
    $request->setCustomFieldValue("Additional Terms 1", $term1);
    $request->setCustomFieldValue("Additional Terms 2", $term2);
    $request->setCustomFieldValue("Additional Terms 3", $term3);
    $request->setCustomFieldValue("Seller's Phone", $seller_phone);
    $request->setCustomFieldValue("Seller's Email", $sellerEmail);

    $response = $client->sendTemplateSignatureRequest($request);

    debug($response);
}