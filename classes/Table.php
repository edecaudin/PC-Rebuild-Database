<?php
	if (file_exists("support/mysqlConnect.php")) {
  		require_once("support/mysqlConnect.php");
	} else {
  		require_once("../support/mysqlConnect.php");
	}
	
	class Table {
		protected static $name;

		function __construct($name) {
			$this->name = mysql_real_escape_string($name);
		}
		function runQuery($search = null, $columns = null) {
			global $mysqlConnection;
			if (is_null($search)) {
				return $mysqlConnection->query("SELECT * FROM `{$this->name}` ORDER BY `{$this->name}_name` ASC")->fetch_all(MYSQLI_ASSOC);
			} else {
				$query = "SELECT * FROM `{$this->name}` WHERE ";
				for ($i = 0; $i < count($columns) - 1; $i++){
					$query = $query."{$columns[$i]} LIKE ('%{$search}%') OR ";
				}
				$query = $query."{$columns[$i]} LIKE ('%{$search}%')";
				return $mysqlConnection->query($query)->fetch_all(MYSQLI_ASSOC);
			}
			
			
		}
		function __destructor() {
			global $mysqlConnection;
			$mysqlConnection->close();
		}

		function getName() {
			return $this->name;
		}
	}
?>