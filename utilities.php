<?php
/*
 * Created on January 6, 2014
 * Author: Mohammad Faisal Ahmed <faisal.ahmed0001@gmail.com>
 */

//require_once 'PHPMailer/PHPMailerAutoload.php';

//Zoho Modules Name
define("API_KEY", "d920903a15c28089a0b51a3b6e8215ce1d1f8917de8bf82f728e9193227c0717");
define("TEMPLATE_RRU_FRONTEND_CONTRACT_ID", "5471f97b7b096b036e06abb2b7eb45e545f885ad");
define("TEMPLATE_ALL_CASH_CONTRACT_ID", "735cc905e549918bde9f0777573a2ca6cb3e995d");
//define("SELLER_EMAIL", "faisal.ahmed0001@gmail.com");
define("BUYER_EMAIL", "tracycaywood@gmail.com");
define("BUYER_NAME", "Tracy Caywood");

define("AUTH_TOKEN", "04f421ad0b702b7fbe248ac8dc67f805");

define("OFFER_MODULE", "CustomModule1");
define("LEAD_MODULE", "Leads");
define("ACCOUNT_MODULE", "Accounts");
define("CONTACT_MODULE", "Contacts");
define("POTENTIAL_MODULE", "Potentials");
define("CAMPAIGN_MODULE", "Campaigns");
define("CASE_MODULE", "Cases");
define("SOLUTION_MODULE", "Solutions");
define("PRODUCT_MODULE", "Products");
define("PRICE_BOOK_MODULE", "PriceBooks");
define("QUOTE_MODULE", "Quotes");
define("INVOICE_MODULE", "Invoices");
define("SALES_ORDER_MODULE", "SalesOrders");
define("VENDOR_MODULE", "Vendors");
define("PURCHASE_ORDER_MODULE", "PurchaseOrders");
define("EVENT_MODULE", "Events");
define("TASK_MODULE", "Tasks");
define("CALL_MODULE", "Calls");

function debug($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

?>