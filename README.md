Beeleads Affiliate API (PHP Library)
======================

Official Beeleads Affiliate API PHP Wrapper

## Requirements

In order to use this API make sure you have the following information:

- Affiliate ID
- API Secret
- Offer ID

If you are missing any of this info, please contact suporte@beeleads.com.br

## Data Types and Formats

### Length
Maximum length for all fields is 255 characters except *gender* which is limited to 1 character.

### Field specific formats
- **gender** - "M" for Male, "F" for Female, "N" for unknown
- **birthdate** - YYYY-MM-DD (example: "1984-19-04") 
- **contact_schedule** - HH:MM - HH:MM (example: "10:00 - 12:00")
- **state** - Brazilian state abbreviation (example: "SP" for São Paulo), [http://goo.gl/qCk2V](http://goo.gl/qCk2V)


===

## Methods

### Available Methods
- **sendLead** - Send a lead to Beeleads
- **getOfferRequiredFieldnames** - Retrieve offer's required fieldnames
- **getLeadStatus** - Get lead status

### Usage examples


#### *sendLead*
```php
$blds = new BeeleadsAffiliate('your-affiliate-id', 'your-api-secret', 'beeleads-offer-id');

$arr_lead = array(
	'email' => 'test@example.com',
	'firstname' => 'Jon',
	'lastname' => 'Doe'
);
$arr_response = $blds->sendLead($arr_lead);
```
	
###### Sample Output
    Array
    (
        [status] => 1
        [message] => Lead integrated successfully. See lead id on 'data'
        [details] => Array
            (
                [request] => Array
                    (
                        [time] => 2013-11-26 12:32:35
                        [data] => Array
                            (
                                [token] => 3eae08b092cb6f7a7bb5d5e83c586a95125e66aa
                                [affiliate_id] => 1184
                                [offer_id] => 224
                                [field] => Array
                                    (
                                        [firstname] => tixtestes
                                        [email] => tcarvalho.5294b10303c88%405294b10303c99.com
                                    )

                            )

                    )

                [response] => Array
                    (
                        [status] => 200
                        [message] => OK
                        [data] => Array
                            (
                                [lead_id] => bcb02f629def64fd1244143d943aedb31e35a071
                                [status] => TEST_CONTACT_OK
                            )

                    )

            )

        [data] => bcb02f629def64fd1244143d943aedb31e35a071
    )

===

#### *getOfferRequiredFieldnames*
```php
$blds = new BeeleadsAffiliate('your-affiliate-id', 'your-api-secret', 'beeleads-offer-id');
$arr_offer_fields = $blds->getOfferRequiredFieldnames();
```
###### Sample Output
    Array
    (
        [status] => 1
        [message] => Request OK. See required fieldnames on 'data'
        [details] => Array
            (
                [request] => Array
                    (
                        [time] => 2013-11-26 12:36:44
                        [data] => Array
                            (
                                [token] => 5c74b3d076859c469a51ec6be09221c1e65fc855
                                [affiliate_id] => 1184
                                [offer_id] => 224
                                [field] => Array
                                    (
                                        [0] => none
                                    )

                            )

                    )

                [response] => Array
                    (
                        [status] => 200
                        [required_fieldnames] => Array
                            (
                                [0] => email
                                [1] => firstname
                            )

                    )

            )

        [data] => Array
            (
                [0] => email
                [1] => firstname
            )

    )

===

#### *getLeadStatus*
```php
$blds = new BeeleadsAffiliate('your-affiliate-id', 'your-api-secret', 'beeleads-offer-id');
$lead_id = '28173672ace4c92a0fab8df59d0220519bd4f0d9';
$arr_resp = $blds->getLeadStatus($lead_id);
```
		
###### Sample Output
    Array
    (
        [status] => 1
        [message] => Lead found. See lead integration status on 'data'
        [details] => Array
            (
                [request] => Array
                    (
                        [time] => 2013-11-26 12:37:29
                        [data] => Array
                            (
                                [token] => 38aa22b1663729e80f939d04a8465422bb80468c
                                [affiliate_id] => 1184
                                [field] => Array
                                    (
                                        [lead_id] => 28173672ace4c92a0fab8df59d0220519bd4f0d9
                                    )

                            )

                    )

                [response] => Array
                    (
                        [status] => 200
                        [message] => APPROVED
                        [data] => Array
                            (
                                [lead_id] => 28173672ace4c92a0fab8df59d0220519bd4f0d9
                                [status] => APPROVED
                            )

                    )

            )

        [data] => APPROVED
    )
    
**Note**, possible output lead status are:

- *TEST_CONTACT_OK*
- *PENDING_APPROVAL*
- *APPROVED*
- *REJECTED*



===
	
#### Changelog

- **2013-12-02**: Added "Data Types and Formats" section
- **2013-11-26**: Added 'getLeadStatus' method
- **2013-09-11**: Added 'getOfferRequiredFieldnames' method
- **2013-09-09**: Moved repo to 'Adclick' user
- **2013-08-16**: First public release
