<?php
	class Row implements ArrayAccess {
		private $table;
		private $id;
		private $result;
		private $doesExist;
		
		function __construct($table, $id, $create = false) {
			$this->table = $table;

			global $mysqlConnection;
			if (!is_int($id)) {
				$this->id = $mysqlConnection->query("SELECT `{$this->table->getName()}_id` FROM `{$this->table->getName()}` WHERE `{$this->table->getName()}_name` = '{$id}'")->fetch_row()[0];
			} else {
				$this->id = $id;
			}
			$this->result = $mysqlConnection->query("SELECT * FROM `{$this->table->getName()}` WHERE `{$this->table->getName()}_id` = '{$this->id}'")->fetch_assoc();
			$this->doesExist = !is_null($this->id) && !is_null($this->result);
		}
		function offsetSet($offset, $value) {
			global $mysqlConnection;
			if (!is_null($offset)) {
				$this->result[$offset] = $mysqlConnection->real_escape_string($value);
				$mysqlConnection->query("UPDATE `{$this->table->getName()}` SET `{$offset}` = '{$this->result[$offset]}' WHERE `{$this->table->getName()}_id` = '{$this->id}'");
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
		function doesExist() {
			return $this->doesExist;
		}
	}