<?php 

/*
	Creator: Oliver Martinez A.K.A. NemOry
	Email, facebook, paypal: nemoryoliver@gmail.com
	Twitter: @NemOry
	if you want to contribute to the System or copy the system and build your own.
	I hope you can please just notify me 1st. :)
*/

require_once(CLASSES_PATH.DS."database.php");

class DatabaseObject{
	
	public static function get_all(){
		global $db;
		$sql = "SELECT * FROM " . static::$table_name;
		$result = static::get_by_sql($sql);
		return $result;
	}
	
	public static function get_by_id($passed_id=0){
		global $db;
		$sql = "SELECT * FROM " . static::$table_name . " WHERE " . static::$col_id . "=" . $passed_id;
		$result_array = static::get_by_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public static function get_by_sql($sql=""){
		global $db;
		$result = $db->query($sql);
		$object_array = array();
		while($row = $db->fetch_array($result)){
			$object_array[] = static::instantiate($row);
		}
		return $object_array;
	}
}

?>