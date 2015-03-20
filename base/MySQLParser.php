<?php

include("config/mysql_config.php");

class MySQLParser {

	public static function ParseArray($tableName) {
		$query = MySQLParser::TableQuery($tableName);
		if (!isset($query)) {
			return null;
		}

		$result = array();
		while ($row = $query->fetch_assoc()) {
			self::DecodeJsonFields($row);
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
			self::DecodeJsonFields($row);
			if (isset($row[$primaryKey])) {
				$result[$row[$primaryKey]] = $row;
			}
		}

		return $result;
	}

	public static function ParseConstants() {
		$query = MySQLParser::TableQuery("Constant");
		if (!isset($query)) {
			return null;
		}

		$result = array();
		while ($row = $query->fetch_assoc()) {
			self::DecodeJsonFields($row);
			$namespace = $row["namespace"];
			$key = $row["key"];
			$value = $row["value"];
			$result[$namespace][$key] = $value;
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

	private static function DecodeJsonFields(&$row) {
		foreach ($row as $key => $value) {
			$decodedJson = json_decode($value);
			if (is_array($decodedJson)) {
				$row[$key] = $decodedJson;
			}
		}
		return $row;
	}
}