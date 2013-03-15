<?php 

/*
	Creator: Oliver Martinez A.K.A. NemOry
	Email, facebook, paypal: nemoryoliver@gmail.com
	Twitter: @NemOry
	if you want to contribute to the System or copy the system and build your own.
	I hope you can please just notify me 1st. :)
*/

require_once(INCLUDES_PATH.DS."config.php");
require_once(CLASSES_PATH.DS."database.php");

class Group extends DatabaseObject{
	
	// TABLE tbl_groups PROPERTIES
	protected static $table_name = T_GROUPS;
	protected static $col_id = C_GROUP_UNIQUE_ID;
	
	// GROUP PROPERTIES
	public $id;
	public $name;
	public $description;
	public $banner;
	
	public function create(){
		global $db;
		$sql = "INSERT INTO " . self::$table_name . " (";
		$sql .= C_GROUP_NAME 		." ";
		// $sql .= C_GROUP_DESCRIPTION .", ";
		// $sql .= C_GROUP_BANNER 		." ";
		$sql .=") VALUES ('";
		$sql .= $db->escape_string($this->name) 		. "' ";
		// $sql .= $db->escape_string($this->description) 	. "', ";
		// $sql .= $db->escape_string($this->banner) 		. "' ";
		$sql .=")";
		
		if($db->query($sql)){
			$this->id = $db->get_last_id();
			return true;
		}else{
			return false;	
		}
	}
	
	public function update(){
		global $db;
		$sql = "UPDATE " 				. self::$table_name . " SET ";
		$sql .= C_GROUP_NAME 			. "='" . $db->escape_string($this->name) 		. "' ";
		// $sql .= C_GROUP_DESCRIPTION 	. "='" . $db->escape_string($this->description) . "', ";
		// $sql .= C_GROUP_BANNER 			. "='" . $db->escape_string($this->banner) 		. "' ";
		$sql .="WHERE " . self::$col_id . "=" . $db->escape_string($this->id) 			. "";
		$db->query($sql);
		return ($db->get_affected_rows() == 1) ? true : false;
	}
	
	public function delete(){
		global $db;
		$sql = "DELETE FROM " . self::$table_name . " WHERE " . self::$col_id . "=" . $this->id . "";
		$db->query($sql);
		return ($db->get_affected_rows() == 1) ? true : false;
	}

	protected static function instantiate($record){
		$this_class = new self;
		$this_class->id 			= $record[C_GROUP_UNIQUE_ID];
		$this_class->name 			= $record[C_GROUP_NAME];
		// $this_class->description 	= $record[C_GROUP_DESCRIPTION];
		// $this_class->banner 		= $record[C_GROUP_BANNER];
		return $this_class;
	}


	public static function getByID($id){
		global $db;
		$sql = "SELECT * FROM " . self::$table_name . " WHERE " . C_GROUP_UNIQUE_ID . " = " . $id . " LIMIT 1";
		$result = self::get_by_sql($sql);
		return array_shift($result);
	}

	public static function getLastID(){
		global $db;
		$sql = "SELECT MAX(".C_GROUP_UNIQUE_ID.") FROM " . self::$table_name;
		$result = mysql_query($sql);
		$data = mysql_fetch_array($result);
		return $data[0];
	}

	public static function group_exists($parameter){
		global $db;
		if(is_numeric($parameter)){
			$sql = "SELECT * FROM " . self::$table_name . " WHERE " . self::$col_id . " = '" . $parameter . "' ";
		}else{
			$sql = "SELECT * FROM " . self::$table_name . " WHERE " . C_GROUP_NAME . " = '" . $parameter . "' ";
		}
		$result = $db->query($sql);
		return ($db->get_num_rows($result) == 1) ? true : false;
	}
}

?>