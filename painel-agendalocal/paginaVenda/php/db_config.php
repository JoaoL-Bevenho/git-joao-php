<?php
	class db_conn
	{
		private $host="localhost";
		private $dbname="agenda-local";
		private $user="postgres";
		private $password="2312701";

		function __construct() { }

		public function connection()
		{
			$db_connection = pg_connect("host=".$this->host." dbname=".$this->dbname." user=".$this->user." password=".$this->password);
			return $db_connection;
		}

		function __destruct()
		{
			pg_close($this->connection());
		}
	}
?>
