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

class Xendit_Api_GDA_Cart {

    private $cart_id;
    private $reference_id;
    private $idempotency_id;

    public function generate_cart_id() {
        return bin2hex(random_bytes(16));
    }

    public function check_cart_from_db($cart_id = false) {

        if($cart_id) {
            $check_cart = $cart_id;
        } else {
            $check_cart = $this->get_cart_id();
        }
        if(!$check_cart) return false;

        global $wpdb;
        $row = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM {$wpdb->prefix}gda_cart WHERE cart_id = '%s'",
                $check_cart
            )
        );
        
        return $row;
    }

    public function generate_reference_id() {
        try {
            if(!$this->get_cart_id()) throw new Exception('set cart id first');
            $cart_id = $this->get_cart_id();
            $random_string = '';
            for ($i = 0; $i < 10; $i++) {
                $random_string .= $cart_id[random_int(0, 16 - 1)];
            }
            return $random_string;

        } catch (Exception $e) {
            echo $e;
        }
    }
    public function generate_idempotency_id() {
        try {
            if(!$this->get_reference_id()) throw new Exception('set reference id first');
            return 'User-' . $this->get_reference_id();
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function write_to_db() {
        global $wpdb;
        $table_prefix = $wpdb->prefix;
        $table_name = "gda_cart";
        $row = $wpdb->insert($table_prefix . $table_name, array(
            'cart_id' => $this->cart_id,
            'current_status' => 'inactive'
        ));
        return $row;
    }

    public function update_to_db($status = false) {
        try {
            global $wpdb;
            $to_update = [];
            if(!$this->get_cart_id()) throw new Exception('need to set cart id');
            if($this->get_reference_id()) {
                $to_update['reference_id'] = $this->get_reference_id();
            }
            if($this->get_idempotency_id()) {
                $to_update['idempotency_id'] = $this->get_idempotency_id();
            }
            if($status) {
                $to_update['current_status'] = $status;
            }
            if(!count($to_update)) throw new Exception('nothing to update');
            $table_prefix = $wpdb->prefix;
            $table_name = $table_prefix . 'gda_cart';
            $wpdb->update($table_name, $to_update, array('cart_id' => $this->get_cart_id()));
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function set_cart_meta($meta_array) {
        try {
            global $wpdb;
            if(!$this->get_cart_id()) throw new Exception('need to set cart id before updating');
            if(empty($meta_array) || !is_array($meta_array)) throw new Exception('need a array argument with format [$meta_key => $meta_value]');

            $table_prefix = $wpdb->prefix;
            $table_name = $table_prefix . 'gda_cart_meta';
            $res = [];
            foreach($meta_array as $key => $val) {
                $check_for_row = $wpdb->get_row(
                    $wpdb->prepare(
                        "SELECT * FROM {$wpdb->prefix}gda_cart_meta WHERE cart_id = '%1s' AND meta_key = '%2s'",
                        $this->get_cart_id(),
                        $key
                    )
                );
                if($check_for_row) {
                    $res[] = $wpdb->update($table_name, array('meta_value' => $val), array('cart_id' => $this->get_cart_id(), 'meta_key' => $key));
                } else {
                    $res[] = $wpdb->insert($table_name, array('meta_key' => $key, 'meta_value' => $val, 'cart_id' => $this->get_cart_id()), array('%s', '%s', '%s'));
                }
            }
            return $res;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function get_cart_meta($meta_key) {
        if(!$this->get_cart_id() || !$this->check_cart_from_db()) return false;
        
        global $wpdb;

        $table_name = $wpdb->prefix . 'gda_cart_meta';
        if($meta_key) {
            $res = $wpdb->get_results(
                $wpdb->prepare(
                    "SELECT meta_key, meta_value FROM %1s WHERE cart_id = '%2s' AND meta_value = '%3s'",
                    $table_name,
                    $this->get_cart_id(),
                    $meta_key
                ) 
            );
        } else {
            $res = $wpdb->get_results(
                $wpdb->prepare(
                    "SELECT meta_key, meta_value FROM %1s WHERE cart_id = '%2s'",
                    $table_name,
                    $this->get_cart_id()
                ) 
            );
        }

        return $res;
    }

    public function get_cart_id() {
        return $this->cart_id;
    }
    public function get_reference_id() {
        return $this->reference_id;
    }
    public function get_idempotency_id() {
        return $this->idempotency_id;
    }

    public function get_cart_status() {
        global $wpdb;
        $row = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM {$wpdb->prefix}gda_cart WHERE cart_id = '%s'",
                $this->get_cart_id()
            )
        );
        return $row->current_status;
    }

    public function set_cart_id($cart_id) {
        $this->cart_id = $cart_id;
    }
    public function set_reference_id($reference_id) {
        $this->reference_id = $reference_id;
    }
    public function set_idempotency_id($idempotency_id) {
        $this->idempotency_id = $idempotency_id;
    }

}