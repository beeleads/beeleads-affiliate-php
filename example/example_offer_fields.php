<?php

require_once '../lib/BeeleadsAffiliate.class.php';

$blds = new BeeleadsAffiliate('your-affiliate-id', 'your-api-secret', 'beeleads-offer-id');
/*
 * It will get the mandatory fields of an offer 
 */
$arr_response = $blds->get_offer_fields();

print_r($arr_response);

