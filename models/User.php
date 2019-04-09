<?php 
	class User {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		public function getUsers($data) {
			$this->db->query('SELECT * FROM users WHERE username = :username AND password = :password');

			$this->db->bind(':username', $data['username']);
			$this->db->bind(':password', $data['password']);

			$this->db->execute();
			$count = $this->db->rowCount();
			return $count; 
		}
	}
?>