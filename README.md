Beeleads Affiliate API (PHP Library)
======================

Official Beeleads Affiliate API library

#### Requirements

In order to use this API make sure you have the following information:

- Affiliate ID
- API Secret
- Offer ID

If you are missing any of this info, please contact suporte@beeleads.com.br

===

#### Usage

##### Send leads
	$blds = new BeeleadsAffiliate('your-affiliate-id', 'your-api-secret', 'beeleads-offer-id');

	$arr_lead = array(
    	'email' => 'test@example.com',
    	'firstname' => 'Jon',
    	'lastname' => 'Doe'
	);
	
	$arr_response = $blds->sendLead($arr_lead);
##### Get offer fields
	require_once '../lib/BeeleadsAffiliate.class.php';

	$blds = new BeeleadsAffiliate('your-affiliate-id', 'your-api-secret', 'beeleads-offer-id');
	$offer_fields = $blds->get_offer_fields();

===
	
#### Changelog

**2013-09-11**: Added a method "offer fields" it returns the mandatory fields of a given offer

**2013-09-09**: Moved repo to 'Adclick' user

**2013-08-16**: First public release