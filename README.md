Beeleads Affiliate API (PHP Library)
======================

Official Beeleads Affiliate API library

#### Requirements

In order to use this API make sure you have the following information:

- Affiliate ID
- API Secret
- Offer ID

If you are missing any of this info, please contact suporte@beeleads.com.br

#### Usage


	$blds = new BeeleadsAffiliate('your-affiliate-id', 'your-api-secret', 'beeleads-offer-id');

	$arr_lead = array(
    	'email' => 'test@example.com',
    	'firstname' => 'Jon',
    	'lastname' => 'Doe'
	);
	
	$arr_response = $blds->sendLead($arr_lead);
	

#### Changelog
**2013-08-16**: First public release