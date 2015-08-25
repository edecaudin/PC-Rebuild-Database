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
		function __destructor() {
			global $mysqlConnection;
			$mysqlConnection->close();
		}
		function runQuery($search = null, $columns = null) {
			global $mysqlConnection;
			if (is_null($search)) {
				return $mysqlConnection->query("SELECT * FROM `{$this->getName()}` ORDER BY `{$this->getName()}_name` ASC")->fetch_all(MYSQLI_ASSOC);
			} else {
				$query = "SELECT * FROM `{$this->getName()}` WHERE ";
				for ($i = 0; $i < count($columns) - 1; $i++){
					$query = $query."{$columns[$i]} LIKE ('%{$search}%') OR ";
				}
				$query = $query."{$columns[$i]} LIKE ('%{$search}%')";
				return $mysqlConnection->query($query)->fetch_all(MYSQLI_ASSOC);
			}
			
			
		}
		function getName() {
			return $this->name;
		}
		function addItem($itemName) {
			$itemName = mysql_real_escape_string($itemName);

			global $mysqlConnection;
			$mysqlConnection->query("INSERT INTO `{$this->getName()}` (`{$this->getName()}_name`) VALUES ('{$itemName}')");
		}
		function deleteItem($itemName) {
			$itemName = mysql_real_escape_string($itemName);
			global $mysqlConnection;
			$mysqlConnection->query("DELETE FROM `{$this->getName()}` WHERE `{$this->getName()}_name` = '{$itemName}'");
		}
		function doesContain($itemName) {
			$result = $this->runQuery();
			foreach ($result as $row) {
				if ($row[$this->getName()."_name"] == $itemName) return true;
			}
			return false;
		}
	}
?>