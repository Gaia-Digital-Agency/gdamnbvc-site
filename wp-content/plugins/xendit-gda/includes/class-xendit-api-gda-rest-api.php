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

class Xendit_Api_GDA_Rest_Api {

    public function register_rest_api() {
        register_rest_route("xendit-gaia/v1", "/payment", array(
            "methods" => "POST",
            "callback" => [$this, 'payment_handler']
        ));

        register_rest_route("xendit-gaia/v1", "/card-token", array(
            "methods" => "POST",
            "callback" => [$this, 'card_token_handler']
        ));
        register_rest_route("xendit-gaia/v1", "/session-complete", array(
            "methods" => "POST",
            "callback" => [$this, 'session_complete_handler']
        ));
        register_rest_route("xendit-gaia/v1", "/session-expired", array(
            "methods" => "POST",
            "callback" => [$this, 'session_expired_handler']
        ));
    }

    public function payment_handler() {
        // $payment = new Xendit_Api_GDA_Payment();
        // $payment->pay();
    }

    // public function capture_card_token() {
        
    // }

    public function card_token_handler(WP_REST_REQUEST $request) {
        global $wpdb;

        $parameters = $request->get_json_params();
        $data = $parameters['data'];
        $external_id = $data['external_id'];
        $table_cart = $wpdb->prefix . 'gda_cart';

        $cart = new Xendit_Api_GDA_Cart();
        $cart->set_cart_id($external_id);
        if(!$cart->check_cart_from_db()) return $this->error_handler('cant find external_id');

        $set_meta = $cart->set_cart_meta(array(
            'business_id' => $parameters['business_id'],
            'token_id' => $data['id'],
            'amount' => $data['amount'],
            'masked_card_number' => $data['card_data']['masked_card_number'],
            'exp_month' => $data['card_data']['exp_month'],
            'exp_year' => $data['card_data']['exp_year'],
            'status' => $data['status']
        ));

        return new WP_REST_Response(
            array(
                'id' => $cart->get_cart_id()
            ),
            200
        );

        return $this->error_handler();
    }

    public function session_expired_handler(WP_REST_REQUEST $request) {
        try {
            $cart = new Xendit_Api_GDA_Cart();
            $parameters = $request->get_json_params();
            $data = $parameters['data'];

            $cart->set_cart_id($data['reference_id']);
            $cart->update_to_db('expired');
            $cart->set_cart_meta(array(
                'status' => $data['status']
            ));

            return new WP_REST_RESPONSE(
                array(
                    'status' => true,
                ),
                200
            );
        } catch (Exception $e) {
            return $this->error_handler();
        }
    }

    public function session_complete_handler(WP_REST_REQUEST $request) {
        try {
            $cart = new Xendit_Api_GDA_Cart();
            $parameters = $request->get_json_params();
            $data = $parameters['data'];
            
            $cart->set_cart_id($data['reference_id']);
            $cart->update_to_db('done');
            $cart->set_cart_meta(array(
                'customer_id' => $data['customer_id'],
                'status' => $data['status'],
                'token_id' => $data['payment_token_id']
            ));
    
            return new WP_REST_RESPONSE(
                array(
                    'success' => true
                ),
                200
            );
        } catch (Exception $e) {
            return $this->error_handler();
        }

    }


    private function error_handler($message = 'unexpected error occured', $status_code = 500) {
        return new WP_REST_Response(
            array(
                'message' => $message
            ),
            $status_code
        );
    }

}




// cart-auth

// {
//     "event": "credit_card.authentication",
//     "business_id": "5781d19b2e2385880219791c",
//     "created": "2021-01-11T00:00:00.000Z",
//     "data": {
//         "id": "5824128aa6f9f2e648be9d76",
//         "external_id": "order-12345",
//         "amount": 10000,
//         "card_data": {
//             "masked_card_number": "400000XXXXXX0002",
//             "exp_month": "10",
//             "exp_year": "2025"
//         },
//         "status": "VERIFIED",
//         "eci": "05",
//         "three_ds_result": "AUTHENTICATED",
//         "three_ds_version": "2.1.0"
//     }
// }


// cart tokenize
// {
//     "event": "credit_card.tokenization",
//     "business_id": "5781d19b2e2385880219791c",
//     "created": "2022-12-02T04:14:38.475Z",
//     "api_version": null,
//     "data": {
//         "id": "63897bac0d7847001af64acf",
//         "status": "VERIFIED",
//         "external_id": "tokenization-callback-test",
//         "masked_card_number": "400000XXXXXX1091",
//         "card_expiration_month": "10",
//         "card_expiration_year": "2025",
//         "card_info": {
//             "bank": "PT BANK RAKYAT INDONESIA TBK",
//             "country": "ID",
//             "type": "CREDIT",
//             "brand": "VISA",
//             "fingerprint": "6368de0e28d184001ad4c245"
//         }
//     }
// }