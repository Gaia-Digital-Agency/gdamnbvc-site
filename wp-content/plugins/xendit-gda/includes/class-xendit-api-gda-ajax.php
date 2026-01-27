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
        $cart->set_cart_id($_POST['cart']);
        $verify = $cart->check_cart_from_db($cart_id);
        $status = $cart->get_cart_status();
        if($verify && ($status == 'inactive' || $status == 'pending')) {
            echo json_encode(array('status' => true, 'status_code' => $status));
        } else {
            echo json_encode(array('status' => false));
        }
        wp_die();
    }

    public function create_session() {
        $api_key = get_option('xendit_api_gda_server_key');
        if(!$api_key) return new WP_Error('plugin_error', 'api key is not set');
        $api_base_64 = base64_encode($api_key);
        // $cart = new Xendit_Api_GDA_Cart();

        $client = new GuzzleHttp\Client([
            'timeout' => 30,
            'http_errors' => false
        ]);

        // $cart_id = $cart->generate_cart_id();

        $cart_id = $_POST['cart_id'];

        $cart = new Xendit_Api_GDA_Cart();
        $cart->set_cart_id($cart_id);
        $status = $cart->get_cart_status();

        if($status == 'pending') {
            
        }

        $amount = intval($_POST['amount']);
        if(!$amount) return new WP_Error('request_error', 'amount is not set or invalid');
        $customer_detail = [
            'type' => 'INDIVIDUAL',
            'reference_id' => $cart_id,
            'individual_detail' => [
                'given_names' => $_POST['first_name'],
                'surname' => $_POST['last_name'],
            ],
            'email' => $_POST['email'],
            'mobile_number' => $_POST['mobile_number']
        ];

        $headers = [
            'Authorization' => "Basic $api_base_64",
            'Content-Type' => 'application/json',
        ];

        $json_data = [
            'reference_id' => $cart_id,
            'customer' => $customer_detail,
            'session_type' => 'PAY',
            'amount' => $amount,
            'mode' => 'PAYMENT_LINK',
            'country' => 'ID',
            'currency' => 'IDR'
        ];

        // if(get_option('xendit_api_gda_success_url')) {
            $json_data['success_return_url'] = get_option('xendit_api_gda_success_url');
            // $json_data['success_return_url'] = 'https://6mnbvc.gaiada.com/gallery';
        // }

        $response = $client->post(XENDIT_API_ENDPOINT . "/sessions", [
            'headers' => $headers,
            'json' => $json_data,
        ]);
        
        $code = $response->getStatusCode();
        $data = json_decode($response->getBody(), true);

        if($code == 200) {
            $cart->update_to_db('pending');
        }
        
        echo json_encode($data);
        wp_die();
    }

    public function create_payment_token() {

        $api_key = get_option('xendit_api_gda_server_key');
        if(!$api_key) return new WP_Error('plugin_error', 'api key is not set');
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

    }

    public function create_payment_request() {
        $api_key = get_option('xendit_api_gda_server_key');
        if(!$api_key) return new WP_Error('plugin_error', 'api key is not set');
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
    }

}