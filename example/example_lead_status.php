<?php

require_once '../lib/BeeleadsAffiliate.class.php';

$blds = new BeeleadsAffiliate('your-affiliate-id', 'your-api-secret', 'beeleads-offer-id');

/**
 * This will return lead status:
 * - TEST_CONTACT_OK
 * - PENDING_APPROVAL
 * - APPROVED
 * - REJECTED
 */
$lead_id = 'lead-id-that-was-provided-by-beeleads-api';
$arr_response = $blds->getLeadStatus($lead_id);

if (true == $arr_response['status'])
{
    echo "OK - Lead found\n";
}
else
{
    echo "ERROR - Lead was not found\n";
}

echo "Response: \n";
print_r($arr_response);
