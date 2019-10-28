<?php 

class UserStorageHandler{
	private $db;

	public function __construct(PDO &$db){ // forward parameter by reference.
		$this->db = $db;
	}

	// Store data in users table:
	public function store(array $users){
		$preparation = $this->db->prepare("INSERT INTO users VALUES(:user_id, :username, :user_category_id, :status_user)");

		if (!$preparation) {
			throw new Exception("Error Query!");
		}

		foreach ($users as $key => $user) {
			$preparation->execute([
				':user_id' => $user->user_id,
				':username' => $user->username,
				':user_category_id' => $user->user_category_id,
				':status_user' => $user->status_user
			]);
		}
	}
}