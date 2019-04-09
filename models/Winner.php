<?php 
	class Winner {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		public function addWinner($data) {
			$this->db->query('INSERT INTO winners 
				(name, country, work, category, prize, edition) 
				VALUES (:name, :country, :work, :category, :prize, :edition)');

			$this->db->bind(':name', $data['name']);
			$this->db->bind(':country', $data['country']);
			$this->db->bind(':work', $data['work']);
			$this->db->bind(':category', $data['category']);
			$this->db->bind(':prize', $data['prize']);
			$this->db->bind(':edition', $data['edition']);

			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}

		public function getSingleWinner($id) {
			$this->db->query('SELECT * FROM winners WHERE id = :id');
			$this->db->bind(':id', $id);
			$result = $this->db->single();
			return $result;
		}

		public function getWinners($category, $edition) {
			$this->db->query('SELECT * FROM winners WHERE category = :category AND edition = :edition ORDER BY prize ASC');
			$this->db->bind(':category', $category);
			$this->db->bind(':edition', $edition);
			$results = $this->db->resultset();
			return $results; 
		}

		public function getAllWinners() {
			$this->db->query('SELECT * FROM winners ORDER BY edition DESC, prize ASC');
			$results = $this->db->resultset();
			return $results; 
		}

		public function updateWinner($data) {
			$this->db->query(
				'UPDATE winners SET 
					name = :name,
					country = :country,
					work = :work,
					category = :category,
					prize = :prize,
					edition = :edition
				WHERE id = :id'
			);

			$this->db->bind(':name', $data['name']);
			$this->db->bind(':country', $data['country']);
			$this->db->bind(':work', $data['work']);
			$this->db->bind(':category', $data['category']);
			$this->db->bind(':prize', $data['prize']);
			$this->db->bind(':edition', $data['edition']);
			$this->db->bind(':id', $data['id']);

			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}

		public function getDistinctEditions() {
			$this->db->query('SELECT DISTINCT(edition) AS edition FROM winners ORDER BY edition ASC');
			$results = $this->db->resultset();
			return $results;
		}

		public function deleteWinner($id) {
			$this->db->query('DELETE FROM winners WHERE id = :id');
			$this->db->bind(':id', $id);
			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}
	}
?>