<?php

require_once '../lib/BeeleadsAffiliate.class.php';

$blds = new BeeleadsAffiliate('your-affiliate-id', 'your-api-secret', 'beeleads-offer-id');

/* example lead */
$arr_lead = array(
    'email' => 'test@example.com',
    'firstname' => 'Jon',
    'lastname' => 'Doe'
);

/**
 * $arr_response is an array with the following structure:
 * 
 * Array
 *   'status' => boolean - true means lead was successfully integrated
 *   'message' => string - a simple message describing the result
 *   'details' => array - api full response or error messages
 */
$arr_response = $blds->sendLead($arr_lead);

if (true == $arr_response['status'])
{
    echo "OK - Lead integrated\n";
}
else
{
    echo "ERROR - Lead did not integrate\n";
}

echo "Response: \n";
print_r($arr_response);

