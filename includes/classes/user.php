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

class User extends DatabaseObject{
	
	// TABLE tbl_users PROPERTIES
	protected static $table_name = T_USERS;
	protected static $col_id = C_USER_UNIQUE_ID;
	
	// USER PROPERTIES
	public $id;
	public $group_id;
	public $username;
	public $level;
	public $access_token;
	public $name;
	public $password;
	public $picture;
	public $email;
	public $access;

	public function create(){
		global $db;
		$sql = "INSERT INTO " . self::$table_name . " (";
		$sql .= C_USER_GROUP_ID 		.", ";
		$sql .= C_USER_USERNAME 		.", ";
		$sql .= C_USER_LEVEL 			.", ";
		$sql .= C_USER_ACCESS_TOKEN 	.", ";
		$sql .= C_USER_NAME 			.", ";
		$sql .= C_USER_PASSWORD 		.", ";
		$sql .= C_USER_PICTURE 			.", ";
		$sql .= C_USER_EMAIL 			.", ";
		$sql .= C_USER_ACCESS;
		$sql .=") VALUES ('";
		$sql .= $db->escape_string($this->group_id) 		. "', '";
		$sql .= $db->escape_string($this->username) 		. "', '";
		$sql .= $db->escape_string($this->level) 			. "', '";
		$sql .= $db->escape_string($this->access_token) 	. "', '";
		$sql .= $db->escape_string($this->name) 			. "', '";
		$sql .= $db->escape_string($this->password) 		. "', '";
		$sql .= $db->escape_string($this->picture) 			. "', '";
		$sql .= $db->escape_string($this->email) 			. "', ";
		$sql .= $db->escape_string($this->access) 			. " ";
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
		$sql .= C_USER_GROUP_ID 		. "='" . $db->escape_string($this->group_id) 		. "', ";
		$sql .= C_USER_USERNAME			. "='" . $db->escape_string($this->username) 		. "', ";
		$sql .= C_USER_LEVEL 			. "='" . $db->escape_string($this->level) 			. "', ";
		$sql .= C_USER_ACCESS_TOKEN 	. "='" . $db->escape_string($this->access_token) 	. "', ";
		$sql .= C_USER_NAME 			. "='" . $db->escape_string($this->name) 			. "', ";
		$sql .= C_USER_PASSWORD 		. "='" . $db->escape_string($this->password) 		. "', ";
		$sql .= C_USER_PICTURE 			. "='" . $db->escape_string($this->picture) 		. "', ";
		$sql .= C_USER_EMAIL 			. "='" . $db->escape_string($this->email) 			. "', ";
		$sql .= C_USER_ACCESS 			. "=" . $db->escape_string($this->access) 			. " ";
		$sql .="WHERE " . self::$col_id . "=" . $db->escape_string($this->id) 				. "";
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
		$this_class->id 				= $record[C_USER_UNIQUE_ID];
		$this_class->group_id 			= $record[C_USER_GROUP_ID];
		$this_class->username 			= $record[C_USER_USERNAME];
		$this_class->level 				= $record[C_USER_LEVEL];
		$this_class->access_token 		= $record[C_USER_ACCESS_TOKEN];
		$this_class->name 				= $record[C_USER_NAME];
		$this_class->password 			= $record[C_USER_PASSWORD];
		$this_class->picture 			= $record[C_USER_PICTURE];
		$this_class->email				= $record[C_USER_EMAIL];
		$this_class->access				= $record[C_USER_ACCESS];
		return $this_class;
	}
	
	public static function get_all_by_group_id($group_id=""){
		global $db;
		$sql = "SELECT * FROM " . static::$table_name . " WHERE ". C_USER_GROUP_ID ." = '" . $group_id . "' ";
		$users = static::get_by_sql($sql);
		return $users;
	}

	public static function username_exists($username){
		global $db;
		$sql = "SELECT * FROM " . self::$table_name . " WHERE " . C_USER_USERNAME . " = '" . $username . "'";
		$result = $db->query($sql);
		return ($db->get_num_rows($result) == 1) ? true : false;
	}

	public static function authenticate($username="", $password=""){
		global $db;
		$username = $db->escape_string($username);
		$password 	= $db->escape_string($password);
		
		$sql = "SELECT * FROM " . self::$table_name;
		$sql .= " WHERE " 	. C_USER_USERNAME . " = '" . $username . "'";
		$sql .= " AND " 	. C_USER_PASSWORD . " = '" . $password . "'";
		$sql .= " LIMIT 1";
		
		$result_array = self::get_by_sql($sql);

		$errors = new Error();
		$errors->exceptions = "does not exists";

		return !empty($result_array) ? json_encode($result_array) : json_encode(array($errors));
	}

	public static function get_by_username($username=""){
		global $db;
		$username = $db->escape_string($username);
		
		$sql = "SELECT * FROM " . self::$table_name;
		$sql .= " WHERE " 	. C_USER_USERNAME . " = '" . $username . "'";
		$sql .= " LIMIT 1";
		
		$result_array = self::get_by_sql($sql);

		$errors = new Error();
		$errors->exceptions = "does not exists";

		return !empty($result_array) ? json_encode($result_array) : json_encode(array($errors));
	}

	public static function login($username="", $password=""){
		global $db;
		$username = $db->escape_string($username);
		$password 	= $db->escape_string($password);
		
		$sql = "SELECT * FROM " . self::$table_name;
		$sql .= " WHERE " 	. C_USER_USERNAME . " = '" . $username . "'";
		$sql .= " AND " 	. C_USER_PASSWORD . " = '" . $password . "'";
		$sql .= " LIMIT 1";
		
		$result = self::get_by_sql($sql);
		return !empty($result) ? array_shift($result) : null;
	}
}
?>