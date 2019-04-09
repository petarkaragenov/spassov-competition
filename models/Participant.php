<?php 
	class Participant {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		public function addParticipant($data) {
			$this->db->query('INSERT INTO participants 
				(p_id, p_name, p_category, p_birth, p_email, p_phone, p_nationality, p_address, p_first_score, p_second_score, p_audio) 
				VALUES (:id, :name, :category, :birth, :email, :phone, :nationality, :address, :first_score, :second_score, :audio)');

			$this->db->bind(':id', $data['id']);
			$this->db->bind(':name', $data['name']);
			$this->db->bind(':category', $data['category']);
			$this->db->bind(':birth', $data['birth']);
			$this->db->bind(':email', $data['email']);
			$this->db->bind(':phone', $data['phone']);
			$this->db->bind(':nationality', $data['nationality']);
			$this->db->bind(':address', $data['address']);
			$this->db->bind(':first_score', $data['first_score']);
			$this->db->bind(':second_score', $data['second_score']);
			$this->db->bind(':audio', $data['audio']);

			move_uploaded_file($_FILES['score1']['tmp_name'], 'upload/'.$data['first_score']);
			if (!empty($_FILES['score2']['tmp_name'])) {
				move_uploaded_file($_FILES['score2']['tmp_name'], 'upload/'.$data['second_score']);
			}
			move_uploaded_file($_FILES['audio']['tmp_name'], 'upload/'.$data['audio']);

			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}

		public function getParticipants() {
			$this->db->query('SELECT * FROM participants ORDER BY p_created_at DESC');
			$results = $this->db->resultset();
			return $results; 
		}

		public function updateStatus($status, $id) {
			$this->db->query('UPDATE participants SET p_approved = :status WHERE p_id = :id');
			$this->db->bind(':status', $status);
			$this->db->bind(':id', $id);
			
			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}
	}
?>