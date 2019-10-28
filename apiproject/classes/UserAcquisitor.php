<?php 

class UserAcquisitor{
	private $apiCommunicator;

	public function __construct(ApiCommunicator $apiCommunicator){
		$this->apiCommunicator = $apiCommunicator;
	}

	// Get users and prepare data for send request.
	public function getUsersByCategoryId(string $userCategoryId){
		$action = '/database/query';

		// create request with need data to send:
		$request = [
			'query' => 'SELECT * FROM users WHERE status_user = :status AND user_category_id = :user_category_id;',
			'parameters' => [
				':status_user' => 'active',
				':user_category_id' => $userCategoryId
			]

		];

		// Convert array request to json:
		$requestJson = json_encode($request);

		$resultJson = $this->apiCommunicator->postDataByCurl($action, $requestJson);
		$result = json_decode($resultJson);

		// Check condition of validation of transfer data:
		if (!$result || !property_exists($result, 'data') || !is_array($result->data)) {
			return [];
		}else{
			return $result->data;
		}
	}
}