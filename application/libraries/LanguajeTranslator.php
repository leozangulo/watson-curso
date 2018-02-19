<?php 

/**
* Clase para acceder a Languaje Translator por medio de PHP
* V0.1
* inndotDevLab->codeigniter
* WatsonPHPSDK v0.2
*/
class LanguajeTranslator {

    const VERSION = '2017-09-21';
    const TYPE_TEXT = 'text';

    /**
     * Constructor
     * 
     * @param $text string
    */

    private $Watson_Credentials_User = "";
	private $Watson_Credentials_Password = "";

	public function set_credentials($usr,$pass) {
		$this->Watson_Credentials_User = $usr;
		$this->Watson_Credentials_Password = $pass;
	}

	public function translate($text) {
		$curl = curl_init();
	    $params = array('text' => $text,'model_id' => 'es-en');
		$dataa = json_encode($params);
	     curl_setopt($curl, CURLOPT_POST, true);
	     curl_setopt($curl, CURLOPT_POSTFIELDS, $dataa);
	     curl_setopt($curl, CURLOPT_HTTPHEADER, array(
	     	'Accept: application/json',                                                                               
	    	'Content-Length: ' . strlen($dataa))                                                                       
		);  
	    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	    curl_setopt($curl, CURLOPT_USERPWD, $this->Watson_Credentials_User.":".$this->Watson_Credentials_Password);
	    curl_setopt($curl, CURLOPT_URL, "https://gateway.watsonplatform.net/language-translator/api/v2/translate?");
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    $result = curl_exec($curl);
	    if (curl_errno($curl)) {
		    echo 'Error:' . curl_error($curl);
		}
	    curl_close($curl);
	    $decoded = json_decode($result, true);
     return $decoded;
	}
}