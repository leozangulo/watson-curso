<?php 

/**
* Clase para acceder a NLU por medio de PHP
* V0.1
* inndotDevLab->codeigniter
* WatsonPHPSDK v0.2
*/
class NaturalLanguajeUnderstanding {

	const URL = 'https://gateway.watsonplatform.net/natural-language-understanding/api';
	const APIVERSION = '/v1/analyze';
    const VERSION = '2017-02-27';
    const TYPE_TEXT = 'text';

    /**
     * Constructor
     * 
     * @param $content string
     * @param $features array
     * @param $type string
     * @param $language string | NULL
     * @param $clean boolean | NULL
     * @param $fallback_to_raw boolean | NULL
     * @param $return_analyzed_text boolean | NULL
     * @param $version string
    */

    private $Watson_Credentials_User = "";
	private $Watson_Credentials_Password = "";
	private $Model_Id = "";

	
	function __construct(argument) {
		$this->$Model_Id = '20:550b9baa-f095-4684-a21a-7c162c442eee';
	}

	public function set_credentials($usr,$pass) {
		$this->Watson_Credentials_User = $usr;
		$this->Watson_Credentials_Password = $pass;
	}

	public function set_model($model_id) {
		$this->Model_Id = $model_id;
	}

	public function analyze($text,$model_id) {
		$curl = curl_init();
	    //$context_data = json_decode($this->Current_Context);
	    $textArray = array('text' => $text)
	    $options = array(
			'features' => array(
				'entities' => array(
					'model' => $Model_Id,
					'emotion': true,
					'sentiment': true
				),
				'sentiment' => array('document' => true)
			),
			'return_analyzed_text': true
		);
	 	
	 	$parameters = array_merge($textArray,$options);
	 	
		$dataa = json_encode($parameters);

	     curl_setopt($curl, CURLOPT_POST, true);
	     curl_setopt($curl, CURLOPT_POSTFIELDS, $dataa);
	     curl_setopt($curl, CURLOPT_HTTPHEADER, array(
	     	'Content-Type: application/json',                                                                               
	    	'Content-Length: ' . strlen($dataa))                                                                       
		);  
	    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	    curl_setopt($curl, CURLOPT_USERPWD, $this->Watson_Credentials_User.":".$this->Watson_Credentials_Password);
	    curl_setopt($curl, CURLOPT_URL, "https://gateway.watsonplatform.net/natural-language-understanding/api/v1/analyze/?version=22017-02-27");
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