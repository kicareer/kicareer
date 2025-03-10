<?php 
	class DbConnect {
		private $host 	= 'localhost';
		private $dbName = 'wtxoeyoq_career_portal_new';
		private $user 	= 'root';
		private $pass 	= '';
		// private $host 	= 'localhost';
		// private $dbName = 'wtxoeyoq_ki_careers';
		// private $user 	= 'wtxoeyoq_ki_careers';
		// private $pass 	= '98UTeR9zvqFCDpk773VP';


		public function connect() {
			try {
				$conn = new PDO('mysql:host=' . $this->host . '; dbname=' . $this->dbName, $this->user, $this->pass);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $conn;
			} catch( PDOException $e) {
				echo 'Database Error: ' . $e->getMessage();
			}
		}
	}

?>
