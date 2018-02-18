<?php
/*
 * Copyright 2017 IBM Corp. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with
 * the License. You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on
 * an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the
 * specific language governing permissions and limitations under the License.
 */
Class Discovery {
	
	const BASE_URL = "https://gateway.watsonplatform.net/discovery/api/v1/environments";
	
	function __construct() {
       
    }
	/*
	* createEnvironment
	* @param username
	* @param password
	* @param environmentName
	* @param environmentDesc
	* @param size
	* 
	* @result String
	* 
	* not allowed for free account
	*/
	public function createEnvironment($username, $password, $environmentName, $environmentDesc, $size) {
		$url = self::BASE_URL . "?version=2017-10-16";
		$data["name"] = $environmentName;
		$data["description"] = $environmentDesc;
		$data["size"] = $size;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array (
			"Content-Type: application/json"
		));
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	/*
	* getEnvironments
	* @param username
	* @param password
	* 
	* @result String
	*/
	public function getEnvironments($username, $password) {
		$url = self::BASE_URL . "?version=2016-12-01";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array (
			"Content-Type: application/json"
		));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	/*
	* getEnvironment
	* @param url
	* @param username
	* @param password
	* @param environmentId
	* 
	* @result String
	*/
	public function getEnvironment($username, $password, $environmentId) {
		$url = self::BASE_URL . "/{environment_id}?version=2016-12-01";
		$url = str_replace("{environment_id}", $environmentId, $url);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array (
			"Content-Type: application/json"
		));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	/*
	* updateEnvironment
	* @param username
	* @param password
	* @param environmentId
	* @param environmentName
	* @param environmentDesc
	* @param size
	* 
	* @result String
	* 
	* This operation is invalid for read-only environments
	*/
	public function updateEnvironment($username, $password, $environmentId, $environmentName, $environmentDesc, $size) {
		$url = self::BASE_URL . "/{environment_id}?version=2016-12-01";
		$url = str_replace("{environment_id}", $environmentId, $url);
		$data["name"] = $environmentName;
		$data["description"] = $environmentDesc;
		$data["size"] = $size;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array (
			"Content-Type: application/json"
		));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	/*
	* deleteEnvironment
	* @param username
	* @param password
	* @param environmentId
	* 
	* @result String
	* 
	* This operation is invalid for read-only environments
	*/
	public function deleteEnvironment($username, $password, $environmentId) {
		$url = self::BASE_URL . "/{environment_id}?version=2016-12-01";
		$url = str_replace("{environment_id}", $environmentId, $url);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array (
			"Content-Type: application/json"
		));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	/*
	* createConfiguration
	* @param username
	* @param password
	* @param environmentId
	* @param configurationName
	* 
	* @result String
	* 
	* This operation is invalid for read-only environments
	*/
	public function createConfiguration($username, $password, $environmentId, $configurationName) {
		$url = self::BASE_URL . "/{environment_id}/configurations?version=2016-12-01";
		$url = str_replace("{environment_id}", $environmentId, $url);
		$data["name"] = $configurationName;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array (
			"Content-Type: application/json"
		));
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	/*
	* getConfigurations
	* @param username
	* @param password
	* @param environmentId
	* 
	* @result String
	* 
	*/
	public function getConfigurations($username, $password, $environmentId) {
		$url = self::BASE_URL . "/{environment_id}/configurations?version=2016-12-01";
		$url = str_replace("{environment_id}", $environmentId, $url);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array (
			"Content-Type: application/json"
		));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	/*
	* getConfiguration
	* @param username
	* @param password
	* @param environmentId
	* @param configurationId
	* 
	* @result String
	* 
	*/
	public function getConfiguration($username, $password, $environmentId, $configurationId) {
		$url = self::BASE_URL . "/{environment_id}/configurations/{configuration_id}?version=2016-12-01";
		$url = str_replace("{environment_id}", $environmentId, $url);
		$url = str_replace("{configuration_id}", $configurationId, $url);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array (
			"Content-Type: application/json"
		));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	/*
	* updateConfiguration
	* @param username
	* @param password
	* @param environmentId
	* @param configurationId
	* @param configurationName
	* 
	* @result String
	* 
	* This operation is invalid for read-only environments
	*/
	public function updateConfiguration($username, $password, $environmentId, $configurationId, $configurationName) {
		$url = self::BASE_URL . "/{environment_id}/configurations/{configuration_id}?version=2016-12-01";
		$url = str_replace("{environment_id}", $environmentId, $url);
		$url = str_replace("{configuration_id}", $configurationId, $url);
		$data["name"] = $configurationName;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array (
			"Content-Type: application/json"
		));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	/*
	* deleteConfiguration
	* @param username
	* @param password
	* @param environmentId
	* @param configurationId
	* 
	* @result String
	* 
	* This operation is invalid for read-only environments
	*/
	public function deleteConfiguration($username, $password, $environmentId, $configurationId) {
		$url = self::BASE_URL . "/{environment_id}/configurations/{configuration_id}?version=2016-12-01";
		$url = str_replace("{environment_id}", $environmentId, $url);
		$url = str_replace("{configuration_id}", $configurationId, $url);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array (
			"Content-Type: application/json"
		));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	/*
	* createCollection
	* @param username
	* @param password
	* @param environmentId
	* @param collectionName
	* @param collectionDesc
	* @param configurationId
	* 
	* @result String
	* 
	* This operation is invalid for read-only environments
	*/
	public function createCollection($username, $password, $environmentId, $collectionName, $collectionDesc, $configurationId) {
		$url = self::BASE_URL . "/{environment_id}/collections?version=2016-12-01";
		$url = str_replace("{environment_id}", $environmentId, $url);
		$data["name"] = $collectionName;
		$data["description"] = $collectionDesc;
		$data["configuration_id"] = $configurationId;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array (
			"Content-Type: application/json"
		));
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	/*
	* getCollections
	* @param username
	* @param password
	* @param environmentId
	* 
	* @result String
	* 
	*/
	public function getCollections($username, $password, $environmentId) {
		$url = self::BASE_URL . "/{environment_id}/collections?version=2016-12-01";
		$url = str_replace("{environment_id}", $environmentId, $url);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array (
			"Content-Type: application/json"
		));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	/*
	* getCollection
	* @param username
	* @param password
	* @param environmentId
	* @param collectionId
	* 
	* @result String
	* 
	*/
	public function getCollection($username, $password, $environmentId, $collectionId) {
		$url = self::BASE_URL . "/{environment_id}/collections/{collection_id}?version=2016-12-01";
		$url = str_replace("{environment_id}", $environmentId, $url);
		$url = str_replace("{collection_id}", $collectionId, $url);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array (
			"Content-Type: application/json"
		));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	/*
	* updateCollection
	* @param username
	* @param password
	* @param environmentId
	* @param collectionId
	* @param collectionName
	* @param collectionDesc
	* @param configurationId
	* 
	* @result String
	* 
	* This operation is invalid for read-only environments
	* 
	*/
	public function updateCollection($username, $password, $environmentId, $collectionId, $collectionName, $collectionDesc, $configurationId) {
		$url = self::BASE_URL . "/{environment_id}/collections/{collection_id}?version=2016-12-01";
		$url = str_replace("{environment_id}", $environmentId, $url);
		$url = str_replace("{collection_id}", $collectionId, $url);
		$data["name"] = $collectionName;
		$data["description"] = $collectionDesc;
		$data["configuration_id"] = $configurationId;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array (
			"Content-Type: application/json"
		));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	/*
	* getCollectionFields
	* @param username
	* @param password
	* @param environmentId
	* @param collectionId
	* 
	* @result String
	* 
	*/
	public function getCollectionFields($username, $password, $environmentId, $collectionId) {
		$url = self::BASE_URL . "/{environment_id}/collections/{collection_id}/fields?version=2016-12-01";
		$url = str_replace("{environment_id}", $environmentId, $url);
		$url = str_replace("{collection_id}", $collectionId, $url);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array (
			"Content-Type: application/json"
		));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	/*
	* deleteCollection
	* @param username
	* @param password
	* @param environmentId
	* @param collectionId
	* 
	* @result String
	* 
	* This operation is invalid for read-only environments
	*/
	public function deleteCollection($username, $password, $environmentId, $collectionId) {
		$url = self::BASE_URL . "/{environment_id}/collections/{collection_id}?version=2016-12-01";
		$url = str_replace("{environment_id}", $environmentId, $url);
		$url = str_replace("{collection_id}", $collectionId, $url);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array (
			"Content-Type: application/json"
		));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	/*
	* createDocument
	* @param username
	* @param password
	* @param environmentId
	* @param collectionId
	* @param documentUrl
	* 
	* @result String
	* 
	* This operation is invalid for read-only environments
	*/
	public function createDocument($username, $password, $environmentId, $collectionId, $documentUrl) {
		$url = self::BASE_URL . "/{environment_id}/collections/{collection_id}/documents?version=2016-12-01";
		$url = str_replace("{environment_id}", $environmentId, $url);
		$url = str_replace("{collection_id}", $collectionId, $url);
		$data["file"] = $documentUrl;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array (
			"Content-Type: application/json"
		));
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	/*
	* updateDocument
	* @param username
	* @param password
	* @param environmentId
	* @param collectionId
	* @param documentId
	* @param documentUrl
	* 
	* @result String
	* 
	* This operation is invalid for read-only environments
	*/
	public function updateDocument($username, $password, $environmentId, $collectionId, $documentId, $documentUrl) {
		$url = self::BASE_URL . "/{environment_id}/collections/{collection_id}/documents/{document_id}?version=2016-12-01";
		$url = str_replace("{environment_id}", $environmentId, $url);
		$url = str_replace("{collection_id}", $collectionId, $url);
		$url = str_replace("{document_id}", $documentId, $url);
		$data["file"] = $documentUrl;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array (
			"Content-Type: application/json"
		));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	/*
	* getDocument
	* @param username
	* @param password
	* @param environmentId
	* @param collectionId
	* @param documentId
	* 
	* @result String
	* 
	* This operation is invalid for read-only environments
	*/
	public function getDocument($username, $password, $environmentId, $collectionId, $documentId) {
		$url = self::BASE_URL . "/{environment_id}/collections/{collection_id}/documents/{document_id}?version=2016-12-01";
		$url = str_replace("{environment_id}", $environmentId, $url);
		$url = str_replace("{collection_id}", $collectionId, $url);
		$url = str_replace("{document_id}", $documentId, $url);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array (
			"Content-Type: application/json"
		));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	/*
	* deleteDocument
	* @param username
	* @param password
	* @param environmentId
	* @param collectionId
	* @param documentId
	* 
	* @result String
	* 
	* This operation is invalid for read-only environments
	*/
	public function deleteDocument($username, $password, $environmentId, $collectionId, $documentId) {
		$url = self::BASE_URL . "/{environment_id}/collections/{collection_id}/documents/{document_id}?version=2016-12-01";
		$url = str_replace("{environment_id}", $environmentId, $url);
		$url = str_replace("{collection_id}", $collectionId, $url);
		$url = str_replace("{document_id}", $documentId, $url);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array (
			"Content-Type: application/json"
		));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	/*
	* query
	* @param username
	* @param password
	* @param environmentId
	* @param collectionId
	* @param keywords
	* @param count
	* @param filter
	* @param return
	* 
	* @result String
	* 
	*/
	public function query($username, $password, $environmentId, $collectionId, $keywords, $count, $filter, $return) {
		$url = self::BASE_URL . "/{environment_id}/collections/{collection_id}/query?version=2017-10-16";
		$url = str_replace("{environment_id}", $environmentId, $url);
		$url = str_replace("{collection_id}", $collectionId, $url);
		$data["query"] = $keywords;
		$data["count"] = $count;
		$data["filter"] = $filter;
		$data["return"] = $return;
		$url = $url . "&query=" . $data["query"] . "&count=" . $data["count"] . "&filter=" . $data["filter"] . "&return=" . $data["return"];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array (
			"Content_type: application/json"
		));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		$result = json_decode($result,true);
		return $result;
	}
}	
?>