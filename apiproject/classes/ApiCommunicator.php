<?php 

// Create relation with Api:
class ApiCommunicator{
	private $apiBaseUrl;
	private $apiUserCredentials;

	// Get need data from ApiUserCredentials class use Depedency Injection.
	public function __construct(string $apiBaseUrl, ApiUserCredentials $apiUserCredentials)
	{
		$this->apiBaseUrl = $apiBaseUrl;
		$this->apiUserCredentials = $apiUserCredentials;
	}

	// Ensure parameter for send request:
	public function postDataByCurl(string $action, string $body = '')
	{
		$url = $this->apiBaseUrl . $action;
		$timestamp = date('c');

		$checksum = $this->apiUserCredentials->calculateChecksum($action, $timestamp);

		// prepare headers for start send data:
		$headers = [
			'Content-type: application/json; charset=utf-8',
			'X-Api-Call-Username: ' . $this->apiUserCredentials->getUsername(),
			'X-Api-Call-Timestamp: ' . $timestamp,
			'X-Api-Call-Checksum: ' . $checksum
		];

		// Init Curl for transfer data:
		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, $url);
		curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($c, CURLOPT_POSTFIELDS , $body);
		$result = curl_exec($c);
		curl_close($c);

		return $result;
	}
}