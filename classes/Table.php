<?php
	
	if (file_exists("support/mysqlConnect.php")) {
  		include("support/mysqlConnect.php");
	}
	
	if (file_exists("../support/mysqlConnect.php")) {
  		include("../support/mysqlConnect.php");
	}
	
	abstract class Table implements ArrayAccess {
		public $doesExist;
		protected $id;
		protected $result;

		static function getList($search = null, $columns = null) {
			global $mysqlConnection;
			if (is_null($search)) {
				return $mysqlConnection->query("SELECT * FROM ".static::tablename)->fetch_all(MYSQLI_ASSOC);
			} else {
				$query = "SELECT * FROM ".static::tablename." WHERE ";
				for ($i = 0; $i < count($columns) - 1; $i++){
					$query = $query."{$columns[$i]} LIKE ('%{$search}%') OR ";
				}
				$query = $query."{$columns[$i]} LIKE ('%{$search}%')";
				return $mysqlConnection->query($query)->fetch_all(MYSQLI_ASSOC);
			}
		}

		function __construct($id) {
			global $mysqlConnection;
			if (!is_int($id)) {
				$this->id = $mysqlConnection->query("SELECT ".static::idname." FROM ".static::tablename." WHERE hostname = '{$id}'")->fetch_row()[0];
			} else {
				$this->id = $id;
			}
			$this->result = $mysqlConnection->query("SELECT * FROM ".static::tablename." WHERE ".static::idname." = '{$this->id}'")->fetch_assoc();
			$this->doesExist = !is_null($this->id) && !is_null($this->result);
		}
		
		function __destructor() {
			global $mysqlConnection;
			$mysqlConnection->close();
		}

		function offsetSet($offset, $value) {
			global $mysqlConnection;
			if (!is_null($offset)) {
				$this->result[$offset] = $value;
				$mysqlConnection->query("UPDATE ".static::tablename." SET {$offset} = '{$value}' WHERE computerid = {$this->id}");
			}
		}
		function offsetExists($offset) {
			return isset($this->result[$offset]);
		}
		function offsetUnset($offset) {
			unset($this->result[$offset]);
		}
		function offsetGet($offset) {
			return isset($this->result[$offset]) ? $this->result[$offset] : null;
		}
	}
?>