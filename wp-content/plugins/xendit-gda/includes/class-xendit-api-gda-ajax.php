<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Xendit_Api_GDA
 * @subpackage Xendit_Api_GDA/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Xendit_Api_GDA
 * @subpackage Xendit_Api_GDA/includes
 * @author     Reva Athallah Rizky
 */


class Xendit_Api_GDA_Ajax {

    public function register_cart() {
        $cart = new Xendit_Api_GDA_Cart();

        $should_generate_cart_id = function() use($cart, &$should_generate_cart_id) {
            $id = $cart->generate_cart_id();
            if($cart->check_cart_from_db($id)) {
                return $should_generate_cart_id();
            }
            return $id;
        };

        $cart_id = $should_generate_cart_id();
        $cart->set_cart_id($cart_id);
        $cart->write_to_db();
        echo json_encode(array('_rp_sc' => $cart_id));
        wp_die();
    }

    public function verify_cart() {
        $cart = new Xendit_Api_GDA_Cart();
        $cart_id = $_POST['cart'];
        $verify = $cart->check_cart_from_db($cart_id);
        if($verify) {
            echo json_encode(array('status' => true));
        } else {
            echo json_encode(array('status' => false));
        }
        wp_die();
    }

    public function create_session() {

        $api_key = 'xnd_development_FzUYAKbp0ec2EcOrx9ytmKVb6QHL6UNRKj5Wd3UpYFyTKE90tJpjdKxg6c8CV';
        $api_base_64 = base64_encode($api_key);
        $cart = new Xendit_Api_GDA_Cart();

        $client = new GuzzleHttp\Client([
            'timeout' => 30,
            'http_errors' => false
        ]);

        $cart_id = $cart->generate_cart_id();

        $response = $client->post(XENDIT_API_ENDPOINT . "/sessions", [
            'headers' => [
                'Authorization' => "Basic $api_base_64",
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'reference_id' => $cart_id,
                'currency' => 'IDR',
                'customer' => [
                    'type' => 'INDIVIDUAL',
                    'reference_id' => $cart_id,
                    'individual_detail' => [
                        'given_names' => 'Reva Athallah Rizky'
                    ]
                ],
                'session_type' => 'PAY',
                'amount' => 10,
                'mode' => 'PAYMENT_LINK',
                'country' => 'ID'
            ]
        ]);
        
        $code = $response->getStatusCode();
        $data = json_decode($response->getBody(), true);
        
        var_dump($code, $data);

        // $header = [];
        // $header[] = 'Authorization: Basic ' . $api_base_64;
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_HEADER, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        // curl_setopt($ch, CURLOPT_URL, XENDIT_API_ENDPOINT . "/sessions");
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $result = curl_exec($ch);
        // var_dump($result);

    }

    public function create_payment_token() {

        $api_key = 'xnd_development_FzUYAKbp0ec2EcOrx9ytmKVb6QHL6UNRKj5Wd3UpYFyTKE90tJpjdKxg6c8CV';
        $api_base_64 = base64_encode($api_key);
        $cart = new Xendit_Api_GDA_Cart();

        $client = new GuzzleHttp\Client([
            'timeout' => 30,
            'http_errors' => false
        ]);

        $cart_id = $cart->generate_cart_id();

        $response = $client->post(XENDIT_API_ENDPOINT . "/v3/payment_tokens", [
            'headers' => [
                'Authorization' => "Basic $api_base_64",
                'Content-Type' => 'application/json',
                'api-version' => '2024-11-11'
            ],
            'json' => [
                'reference_id' => $cart_id,
                'country' => 'ID',
                'currency' => 'IDR',
                'channel_code' => 'CARDS',
                'channel_properties' => [
                    'success_return_url' => 'http://localhost/',
                    'mobile_number' => '+62812388512',
                    'email' => 'revaathallah86@gmail.com',
                    "billing_information" => [
                        'first_name' => 'Reva Athallah',
                        'last_name' => 'Rizky',
                        'email' => 'revaathallah86@gmail.com',
                        "city" => "Depok",
                        "country" => "ID",
                        "postal_code" => "16451",
                        "street_line1" => "Pondok mandala blok r no 10",
                        "street_line2" => "rt 06 rw 17",
                        "province_state" => "Jawa Barat"
                    ],
                    "card_details" => [
                        "cvn" => "865",
                        "card_number" => "4889501024996295",
                        "expiry_year" => "2028",
                        "expiry_month" => "06",
                        "cardholder_first_name" => "Reva Athallah",
                        "cardholder_last_name" => "Rizky",
                        "cardholder_email" => "revaathallah86@gmail.com",
                        "cardholder_phone_number" => "+6281239146435"
                    ],
                ],
                'customer' => [
                    'type' => 'INDIVIDUAL',
                    'reference_id' => $cart_id,
                    'individual_detail' => [
                        'given_names' => 'Reva Athallah Rizky'
                    ]
                ],
            ]
        ]);

        $code = $response->getStatusCode();
        $data = json_decode($response->getBody(), true);
        
        var_dump($code, $data);

    }

    public function create_payment_request() {
        $api_key = 'xnd_development_FzUYAKbp0ec2EcOrx9ytmKVb6QHL6UNRKj5Wd3UpYFyTKE90tJpjdKxg6c8CV';
        $api_base_64 = base64_encode($api_key);
        $cart = new Xendit_Api_GDA_Cart();

        $client = new GuzzleHttp\Client([
            'timeout' => 30,
            'http_errors' => false
        ]);

        $cart_id = $cart->generate_cart_id();

        $response = $client->post(XENDIT_API_ENDPOINT . '/v3/payment_requests', [
            'headers' => [
                'Authorization' => "Basic $api_base_64",
                'Content-Type' => 'application/json',
                'api-version' => '2024-11-11'
            ],
            'json' => [
                'reference_id' => $cart_id,
                'type' => "PAY",
                "country" => "ID",
                'currency' => 'IDR',
                'request_amount' => 10000,
                "capture_method" => "AUTOMATIC",
                'channel_code' => 'CARDS',
                "channel_properties" => [
                    "failure_return_url" => "http://localhost/",
                    "success_return_url" => "http://localhost/about",
                    "card_details" => [
                        "cvn" => "865",
                        "card_number" => "4889501024996295",
                        "expiry_year" => "2028",
                        "expiry_month" => "06",
                        "cardholder_first_name" => "Reva Athallah",
                        "cardholder_last_name" => "Rizky",
                        "cardholder_email" => "revaathallah86@gmail.com",
                        "cardholder_phone_number" => "+6281239146435"
                    ],
                ],

            ]
        ]);

        $code = $response->getStatusCode();
        $data = json_decode($response->getBody(), true);
        
        var_dump($code, $data);
    }

}