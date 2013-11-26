<?php

/**
 * BeeleadsAffiliate
 *
 * @author Tiago Carvalho <tiago.carvalho@adclick.pt>
 */
class BeeleadsAffiliate
{

    const API_VERSION = '1.0';

    private $API_URL = 'https://hive.bldstools.com/api.php/v1/';
    private $affiliate_id;
    private $secret;
    private $offer_id;

    public function __construct($affiliate_id, $secret, $offer_id)
    {
        $this->affiliate_id = (int) $affiliate_id;
        $this->secret = '' . $secret;
        $this->offer_id = (int) $offer_id;
    }

    /**
     * Sends a lead to Beeleads
     *
     * @param array $arr_lead Lead key-value array
     * @return array result of lead insertion (status => boolean, message => string, details => array)
     */
    public function sendLead($arr_lead)
    {

        $arr_ret = array(
            'status' => false,
            'message' => 'Invalid response from API. Please try again later. If the problem persists, please contact suporte@beeleads.com.br',
            'details' => array()
        );

        $arr_lead = array_map("urlencode", $arr_lead);

        /* Generate Token */
        $token = sha1($this->secret . http_build_query($arr_lead));

        /* Prepare data and build URL */
        $data = http_build_query(array('field' => $arr_lead));
        $url = $this->API_URL . "lead/?token={$token}&affiliate_id={$this->affiliate_id}&offer_id={$this->offer_id}&{$data}";

        /* Call URL and parse the response */
        $arr_call = self::callApi($url);
        if (200 == $arr_call['http_code'])
        {
            $arr_response = @json_decode($arr_call['response'], true);
            if (json_last_error() == JSON_ERROR_NONE)
            { /* This means the API replied a valid JSON response */
                $arr_ret['details'] = $arr_response;

                if (200 == $arr_response['response']['status'])
                { /* Lead integrated successfully */
                    $arr_ret['status'] = true;
                    $arr_ret['message'] = 'Lead integrated successfully. See lead id on \'data\'';
                    $arr_ret['data'] = $arr_response['response']['data']['lead_id'];
                }
                else
                { /* API rejected the lead */
                    $arr_ret['message'] = 'Lead did not integrate';
                }
            }
            else
            { /* Invalid JSON response, something is wrong with the API */
                $arr_ret['details'] = array('Invalid JSON response');
            }
        }
        else
        {
            $arr_ret['details'] = array("Invalid HTTP code. Expected 200, got {$arr_call['http_code']}");
        }

        return $arr_ret;
    }

    /**
     * It get the mandatory fields of an offer
     *
     * @return array result of offer mandatory fields
     */
    public function getOfferRequiredFieldnames()
    {
        $arr_ret = array(
            'status' => false,
            'message' => 'Invalid response from API. Please try again later. If the problem persists, please contact suporte@beeleads.com.br',
            'details' => array()
        );

        /* Generate Token */
        $token = sha1($this->secret . http_build_query(array("none")));

        /* Prepare data and build URL */
        $data = http_build_query(array('field' => array("none")));

        /* Prepare data and build URL */
        $url = $this->API_URL . "offer/fieldnames/?token={$token}&affiliate_id={$this->affiliate_id}&offer_id={$this->offer_id}&{$data}";

        /* Call URL and parse the response */
        $arr_call = self::callApi($url);
        if (200 == $arr_call['http_code'])
        {
            $arr_response = @json_decode($arr_call['response'], true);

            if (json_last_error() == JSON_ERROR_NONE)
            { /* This means the API replied a valid JSON response */

                $arr_ret['details'] = $arr_response;

                if (200 == $arr_response['response']['status'])
                { /* request successfully */
                    $arr_ret['status'] = true;
                    $arr_ret['message'] = 'Request OK. See required fieldnames on \'data\'';
                    $arr_ret['data'] = $arr_response['response']['required_fieldnames'];
                }
                else
                { /* API errors */
                    $arr_ret['message'] = 'Could not retrieve Offer Fieldnames';
                }
            }
            else
            { /* Invalid JSON response, something is wrong with the API */
                $arr_ret['details'] = array('Invalid JSON response');
            }
        }
        else
        {
            $arr_ret['details'] = array("Invalid HTTP code. Expected 200, got {$arr_call['http_code']}");
        }

        return $arr_ret;
    }


    public function getLeadStatus($lead_id)
    {
        $arr_ret = array(
            'status' => false,
            'message' => 'Invalid response from API. Please try again later. If the problem persists, please contact suporte@beeleads.com.br',
            'details' => array()
        );

        $arr_lead = array_map("urlencode", array('lead_id' => $lead_id));

        /* Generate Token */
        $token = sha1($this->secret . http_build_query($arr_lead));

        /* Prepare data and build URL */
        $data = http_build_query(array('field' => $arr_lead));
        $url = $this->API_URL . "lead/get_status/?token={$token}&affiliate_id={$this->affiliate_id}&{$data}";

        /* Call URL and parse the response */
        $arr_call = self::callApi($url);
        if (200 == $arr_call['http_code'])
        {
            $arr_response = @json_decode($arr_call['response'], true);
            if (json_last_error() == JSON_ERROR_NONE)
            { /* This means the API replied a valid JSON response */
                $arr_ret['details'] = $arr_response;

                if (200 == $arr_response['response']['status'])
                { /* Lead was found */
                    $arr_ret['status'] = true;
                    $arr_ret['message'] = 'Lead found. See lead integration status on \'data\'';
                    $arr_ret['data'] = $arr_response['response']['data']['status'];
                }
                else
                { /* Lead was not found */
                    $arr_ret['message'] = 'Lead was not found';
                }
            }
            else
            { /* Invalid JSON response, something is wrong with the API */
                $arr_ret['details'] = array('Invalid JSON response');
            }
        }
        else
        {
            $arr_ret['details'] = array("Invalid HTTP code. Expected 200, got {$arr_call['http_code']}");
        }

        return $arr_ret;
    }

    /**
     * Sets a new API URL
     *
     * @param string $url
     */
    public function setApiUrl($url)
    {
        $this->API_URL = $url;
    }

    /**
     * Returns current API URL
     *
     * @return string
     */
    public function getApiUrl()
    {
        return $this->API_URL;
    }

    /**
     * Calls an URL via GET using cURL or file_get_contents
     *
     * @param string $url
     * @return array the response (http_code => int, response => string)
     */
    private static function callApi($url)
    {

        $call_via_file_get_contents = false;

        if (is_callable('curl_init'))
        {
            $curl_handle = curl_init();
            curl_setopt($curl_handle, CURLOPT_URL, $url);
            curl_setopt($curl_handle, CURLOPT_HEADER, 0);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT_MS, 10000);
            curl_setopt($curl_handle, CURLOPT_TIMEOUT_MS, 10000);
            curl_setopt($curl_handle, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl_handle, CURLOPT_USERAGENT, 'BeeleadsAffiliate API/1.0');

            $response = curl_exec($curl_handle);
            $http_code = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);

            curl_close($curl_handle);

            if (0 == (int) $http_code)
            {
                $call_via_file_get_contents = true;
            }
        }
        else
        {
            $call_via_file_get_contents = true;
        }

        if (true == $call_via_file_get_contents)
        {
            $http_code = 200;
            $response = file_get_contents($url);
        }

        return array(
            'http_code' => $http_code,
            'response' => $response
        );
    }

}
