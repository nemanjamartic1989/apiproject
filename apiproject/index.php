<?php 

// include need classes:
function __autoload($class_name){
	require_once 'classes/' . $class_name . '.php';
}

$apiUserCredentials = new ApiUserCredentials('Nemanjam', '12345');
$apiCommunicator = new ApiCommunicator('http://localhost/api', $apiUserCredentials);
$userAcquisitor = new UserAcquisitor($apiCommunicator);

$users = $userAcquisitor->getUsersByCategoryId('94f4f320-cc70-4560-84f4-b00d21880175');

// Connection with database:
$db = new PDO('mysql:host=localhost;dbname=apiproject;charset=utf8', 'root', 'nemanja11');

$userStorageHandler = new UserStorageHandler($db);
$userStorageHandler->store($users); // insert data into users table.
var_dump($users);