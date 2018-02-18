<?php

use WatsonSDK\WatsonSetConfig;

class NaturalLanguageClassifier {
    /*
        variables de USUARIO, PASSWORD, API, VERSION
     */
    public static $username;
    public static $password;
    public static $apiBase = 'https://gateway.watsonplatform.net/natural-language-classifier/api/v1/';
    const VERSION = '1.0.0';
    /**
     * Create a new NaturalLanguageClassifier Instance
     */
    public function __construct(){

    }
    /**
     * Sets the User Name and Password to be used for requests.
     *
     * @param string $username
     * @param string $password
     */
    /*public static function setServiceCredentials($username, $password) {
        self::$username = $username;
        self::$password = $password;
    }*/

    /**
    * @param classifierId string
    * @param query string 
     */

    public function analyze($classifierId, $query) {
        $data = array();
        $URL =  self::$apiBase . "/classifiers/" . $classifierId . "/classify";
        $post = array();
        $post['text'] = $query;
        $data_strings = json_encode($post);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL,$URL);
        curl_setopt($ch, CURLOPT_TIMEOUT, 500);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_USERPWD, self::$username . ":" . self::$password);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_strings);
        $headers = array('Accept: application/json','Content-Type: application/json');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt ($ch, CURLOPT_SAFE_UPLOAD, false);
        $resp = curl_exec($ch);
        $results = json_decode($resp);
        $info = curl_getinfo($ch);
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close ($ch);
        
        if($httpStatus != 200){
            $info['success'] = false;           
            return $info;
        }
        $results->success = true;
        return $results;
    }
}