<?php

include("config.php");

class MySQLParser {

	public static function ParseArray($tableName) {
		$query = MySQLParser::TableQuery($tableName);
		if (!isset($query)) {
			return null;
		}

		$result = array();
		while ($row = $query->fetch_assoc()) {
			$result[] = $row; 
		}

		return $result;
	}

	public static function ParseDictionary($tableName, $primaryKey) {
		$query = MySQLParser::TableQuery($tableName);
		if (!isset($query)) {
			return null;
		}

		$result = array();
		while ($row = $query->fetch_assoc()) {
			if (isset($row[$primaryKey])) {
				$result[$row[$primaryKey]] = $row;
			}
		}

		return $result;
	}

	private static function TableQuery($tableName) {
		$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if ($conn->connect_error) {
			error_log("Connection to $tableName failed: " . $conn->connect_error);
			return null;
		}

		$sql = "SELECT * FROM " . $tableName;
		return $conn->query($sql);
	}
}