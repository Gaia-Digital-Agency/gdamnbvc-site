<?php 

class Status_WP_Authentication {

    protected $api_key;

    // public function compareKey($api_key ) {
    //     $this->api_key
    // }

    public function verify_key($api_key) {
        if(!defined('STATUS_WP_ENDPOINT_MAIN')) throw new Exception('Endpoint is not set!! this should set automatically, something wrong while init');
        if(!$api_key) throw new Exception('Please provide the API Key');

        $data = [
            'api_key' => $api_key,
            // 'url' => get_site_url()
        ];

        // $fields_string = http_build_query($data);
        $fields_string = json_encode($data);
        // var_dump($fields_string);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, STATUS_WP_ENDPOINT_MAIN . "/api/auth/verify-key");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        if(curl_errno($ch)) {
            throw new Exception("error in the server, maybe try again later");
        }

        curl_close($ch);
        return json_decode($result, true);

        // $body = http_build_query($data);

        // $opts = array('http' =>
        //     array(
        //         'method'  => 'POST',
        //         'header'  => "Content-Type: text/xml\r\n",
        //         'content' => $body,
        //     )
        // );
        // $url = STATUS_WP_ENDPOINT_MAIN . '/api/auth';
        // $context = stream_context_create($opts);
        // add_action('page_theme_debugger', function() {
        //     var_dump($context);
        // });
        // $result = file_get_contents($url, false, $context);
    }

    public function authenticate() {
        if(!$this->api_key) {
            throw new Exception('API Key is not available');
        }
        $this->api_key;
    }

    public function get_api_key($api_key) {
        return $this->api_key;
    }

    public function set_api_key($api_key) {
        $this->api_key = $api_key;
    }

}