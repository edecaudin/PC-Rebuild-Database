<?php
	if (file_exists("mysql/mysqlConnect.php")) {
  		require_once("mysql/mysqlConnect.php");
	} else {
  		require_once("../mysql/mysqlConnect.php");
	}
	require_once("Row.php");

	class Table {
		protected $name;

		function __construct($name) {
			global $mysqlConnection;
			$this->name = $mysqlConnection->real_escape_string($name);
		}
		function runQuery($search = null, $columns = null) {
			global $mysqlConnection;
			if (is_null($search)) {
				return $mysqlConnection->query("SELECT * FROM `{$this->getName()}` ORDER BY `{$this->getName()}_name` ASC")->fetch_all(MYSQLI_ASSOC);
			} else {
				if (is_null($columns)) {
					$columns = $this->getColumnNames();
				}
				$query = "SELECT * FROM `{$this->getName()}`";
				if (!is_null($search)) {
					$query = $query." WHERE ";
					for ($i = 0; $i < count($columns) - 1; $i++){
						$query = $query."{$columns[$i]} LIKE ('%{$search}%') OR ";
					}
					$query = $query."{$columns[$i]} LIKE ('%{$search}%')";
				}
				$query = $query." ORDER BY `{$this->getName()}_name` ASC";
				return $mysqlConnection->query($query)->fetch_all(MYSQLI_ASSOC);
			}
		}
		function getName() {
			return $this->name;
		}
		function getColumnNames() {
			global $mysqlConnection;
			$columnNames = array();
			$columns = $mysqlConnection->query("SHOW COLUMNS FROM `{$this->getName()}`")->fetch_all(MYSQLI_NUM);
			foreach ($columns as $column) {
				array_push($columnNames, $column[0]);
			}
			return $columnNames;
		}
		function addItem($itemName) {
			global $mysqlConnection;
			$itemName = $mysqlConnection->real_escape_string($itemName);
			$mysqlConnection->query("INSERT INTO `{$this->getName()}` (`{$this->getName()}_name`) VALUES ('{$itemName}')");
		}
		function deleteItem($itemName) {
			global $mysqlConnection;
			$itemName = $mysqlConnection->real_escape_string($itemName);
			$mysqlConnection->query("DELETE FROM `{$this->getName()}` WHERE `{$this->getName()}_name` = '{$itemName}'");
		}
		function doesContain($itemName) {
			$result = $this->runQuery();
			foreach ($result as $row) {
				if ($row[$this->getName()."_name"] == $itemName) return true;
			}
			return false;
		}
		function echoRowsAsOptions($result, $selected = null) {
			foreach ($result as $row) {
				$item = new Row($this, $row[$this->getName()."_name"]);
				echo("<option".(!is_null($selected) && $item[$this->getName()."_name"] === $selected ? " selected" : "").">".$item[$this->getName()."_name"]."</option>");
			}
		}
	}
?>