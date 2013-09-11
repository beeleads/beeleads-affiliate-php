<?php

require_once '../lib/BeeleadsAffiliate.class.php';

$blds = new BeeleadsAffiliate('your-affiliate-id', 'your-api-secret', 'beeleads-offer-id');

/**
 * This will return all required fieldnames for the offer
 */
$arr_response = $blds->getOfferRequiredFieldnames();

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