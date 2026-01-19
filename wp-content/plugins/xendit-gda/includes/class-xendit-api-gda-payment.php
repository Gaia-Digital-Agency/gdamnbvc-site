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

//  xnd_development_FzUYAKbp0ec2EcOrx9ytmKVb6QHL6UNRKj5Wd3UpYFyTKE90tJpjdKxg6c8CV

use Xendit\Configuration;
use Xendit\PaymentRequest\PaymentRequestApi;

class Xendit_Api_GDA_Payment {

    private $api_key;

    private $success_return_url;
    
    private $failure_return_url;

    private $currency;

    public function __construct() {
        $this->success_return_url = 'http://localhost';
        $this->failure_return_url = 'http://localhost/about';
        $this->currency = Xendit\PaymentRequest\PaymentRequestCurrency::IDR;
    }

    // public function __construct($api_key) {
    //     $this->api_key = $api_key;
    //     Configuration::setXenditKey($this->get_api());
    // }

    public function set_key($api_key) {
        return Configuration::setXenditKey($api_key);
    }

    public function create_payment() {
        $apiInstance = new PaymentRequestApi();
        // $payment = PaymentRequest::create([
        //     'amount' => 10000,
        //     'currency' => 'IDR',
        //     'description' => 'order 1'
        // ]);

        $idempotency_key = "asasdd_asasasddd_asdaasdsdasdasdasd" . time(); // string
        $for_user_id = "5f9a3fbd571a1c4068aa40cf"; // string
        $with_split_rule = "splitru_c676f55d-a9e0-47f2-b672-77564d57a40b"; // string
        $payment_method_paramaters = new Xendit\PaymentMethod\PaPaymentMethodParameters([
            'type' => Xendit\PaymentMethod\PaymentMethodType::DIRECT_DEBIT,
            'direct_debit' => new Xendit\PaymentMethod\DirectDebitParameters([
                'channel_code' => Xendit\PaymentMethod\DirectDebitChannelCode::BRI,
                'channel_properties' => new Xendit\PaymentMethod\DirectDebutChannelProperties([
                    'success_return_url' => 'http://localhost/',
                    'card_number' => '1235123123',
                    'mobile_number' => '+62812388512',
                    'email' => 'revaathallah86@gmail.com',
                ])
            ]),
        ]);
        $payment_request_parameters = new Xendit\PaymentRequest\PaymentRequestParameters([
        'reference_id' => 'example-ref-1asd2345',
        'amount' => 15000,
        'currency' => 'IDR',
        'country' => 'ID',
        'customer' => [
            'reference_id' => 'daasasddsasdasd_asd' . time(),
            'type' => 'INDIVIDUAL',
            'email' => 'revaathallah86@gmail.com',
            'mobile_number' => '+62812388512',
            'individual_detail' => [
                'given_names' => 'Reva Athallah Rizky'
            ]
        ],
        'payment_method' => [
            'reusability' => 'ONE_TIME_USE'
        ]
        ]); 
        $result = $apiInstance->createPaymentRequest($idempotency_key, '', '', $payment_request_parameters);
        return $result;
    }

    public function create_payment_request($params) {
        try {
            if(
                !$params['payment_method_id'] ||
                !$params['cart'] ||
                !$params['amount']
            ) throw new Exception("params is not complete");
            
            $cart = $params['cart'];
            $ref_id = $cart->generate_reference_id();
            $cart->set_reference_id($ref_id);
            $idem_id = $cart->generate_idempotency_id();

            $payment_request_params = new Xendit\PaymentRequest\PaymentRequestParameters([
                'reference_id' => $ref_id,
                'amount' => $params['amount'],
                'currency' => $this->get_currency(),
                'payment_method_id' => $params['payment_method_id'],
                'capture_method' => Xendit\PaymentRequest\PaymentRequestCaptureMethod::AUTOMATIC,
            ]);
            $apiInstance = new PaymentRequestApi();
            $create_payment_request_res = $apiInstance->createPaymentRequest(
                $idem_id,
                null,
                $payment_method_params
            );
            return $create_payment_request_res;
        } catch (Exception $e) {
            echo $e;
        }
    }

    private function card_payment_method_handler($params) {
        try {
            if(!is_array($params)) throw new Exception("params is not correct");
            if(
                !$params['card_number'] ||
                !$params['expiry_month'] ||
                !$params['expiry_year'] ||
                !$params['cvv'] ||
                !$params['cardholder_name']
            ) throw new Exception("params is not complete");
            $payment_method_params = [
                'currency' => $this->get_currency(),
                'channel_properties' => [
                    'success_return_url' => $this->get_success_return_url(),
                    'failure_return_url' => $this->get_failure_return_url(),
                ],
                'card_information' => [
                    'card_number' => $params['card_number'],
                    'expiry_month' => $params['expiry_month'],
                    'expiry_year' => $params['expiry_year'],
                    'cvv' => $params['cvv'],
                    'cardholder_name' => $params['cardholder_name'],
                ]
            ];

            return $payment_method_params;

        } catch (Exception $e) {
            echo $e;
        }
    }

    public function create_payment_method($params = []) {
        try {
            $payment_method_params = [];
            $apiInstance = new Xendit\PaymentMethod\PaymentMethodApi();
            $payment_method_params['reusability'] = Xendit\PaymentMethod\PaymentMethodReusability::ONE_TIME_USE;
            if(!$params['type']) throw new Exception('Type is needed');
            switch($params['type']) {
                case "CARD":
                    $payment_method_params['type'] = Xendit\PaymentMethod\PaymentMethodType::CARD;
                    $payment_method_params['card'] = $this->card_payment_method_handler($params);
                    break;
                case "DIRECT_BANK_TRANSFER":
                    $payment_method_params['type'] = Xendit\PaymentMethod\PaymentMethodType::DIRECT_BANK_TRANSFER;
                    break;
                case "DIRECT_DEBIT":
                    $payment_method_params['type'] = Xendit\PaymentMethod\PaymentMethodType::DIRECT_DEBIT;
                    break;
                case "EWALLET":
                    $payment_method_params['type'] = Xendit\PaymentMethod\PaymentMethodType::EWALLET;
                    break;
                case "OVER_THE_COUNTER":
                    $payment_method_params['type'] = Xendit\PaymentMethod\PaymentMethodType::OVER_THE_COUNTER;
                    break;
                case "QR_CODE":
                    $payment_method_params['type'] = Xendit\PaymentMethod\PaymentMethodType::QR_CODE;
                    break;
                case "VIRTUAL_ACCOUNT":
                    $payment_method_params['type'] = Xendit\PaymentMethod\PaymentMethodType::VIRTUAL_ACCOUNT;
                    break;
                default:
                    $type = null;
                    throw new Exception('Type is not valid');
                    break;
            }
            $payment_method = $apiInstance->createPaymentMethod(
                null, 
                $payment_method_params
            );
            return $payment_method;
        } catch(Exception $e) {
            echo $e;
        }
    }

    public function create_payment_link($cart) {
        try {
            $cart_id = $cart->get_cart_id();
            $invoice = new Xendit\Invoice\InvoiceApi();
            $create_invoice = $invoice->createInvoice(array(
                'external_id' => $cart_id,
                'amount' => 50000
            ));
            // var_dump($create_invoice);
            return $create_invoice;
        } catch(Exception $e) {
            echo $e;
        }
    }

    private function get_success_return_url() {
        return $this->success_return_url;
    }

    private function get_failure_return_url() {
        return $this->failure_return_url;
    }

    private function get_currency() {
        return $this->currency;
    }

    private function get_api() {
        return $this->api_key;
    }
}