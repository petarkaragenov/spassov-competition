<?php 
	class Transaction {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		public function addTransaction($data) {
			$this->db->query('INSERT INTO transactions 
				(t_id, t_participant_id, t_amount, t_status) VALUES (:id, :participant_id, :amount, :status)');

			$this->db->bind(':id', $data['id']);
			$this->db->bind(':participant_id', $data['participant_id']);
			$this->db->bind(':amount', $data['amount']);
			$this->db->bind(':status', $data['status']);

			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}

		public function getTransactions() {
			$this->db->query('SELECT * FROM transactions ORDER BY t_created_at DESC');
			$results = $this->db->resultset();
			return $results; 
		}
	}
?>