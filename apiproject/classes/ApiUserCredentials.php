<?php 

class ApiUserCredentials{
	private $username;
	private $secretSalt;

	public function __construct(string $username, string $secretSalt){
		$this->username = $username;
		$this->secretSalt = $secretSalt;
	}

	public function getUsername()
	{
		return $this->username;
	}

	public function calculateChecksum(string $action, string $timestamp)
	{
		$plain = '|' . $this->username . '|' . $action . '|' .$timestamp . '|' . $this->secretSalt . '|';
		return hash('sha512', $plain);
	}
}