<?php 

/*
	Creator: Oliver Martinez A.K.A. NemOry
	Email, facebook, paypal: nemoryoliver@gmail.com
	Twitter: @NemOry
	if you want to contribute to the System or copy the system and build your own.
	I hope you can please just notify me 1st. :)
*/

require_once(INCLUDES_PATH.DS."config.php");

class MySQLDatabase{
	
	private $connection;
	private $magic_quotes_active;
	private $mysql_real_escape_string_exists;
	public 	$last_query;
	
	function __construct(){
		$this->open_connection();
		$this->magic_quotes_active = get_magic_quotes_gpc();
		$this->mysql_real_escape_string_exists = function_exists("mysql_real_escape_string");
	}
	
	public function open_connection(){
		$this->connection = mysql_connect(DB_SERVER, "root", DB_PASS);
		if(!$this->connection){
			die("Database connection failed: " . mysql_error());
		}else{
			$db_select = mysql_select_db(DB_NAME, $this->connection);
			if(!$db_select){
				die("Database selection failed: " . mysql_error());	
			}
		}
	}
	
	public function close_connection(){
		if(isset($this->connection)){
			mysql_close($this->connection);
			unset($this->connection);
		}
	}
	
	public function query($sql){
		$this->last_query = $sql;
		$result = mysql_query($sql);
		$this->confirm_query($result);
		return $result;
	}
	
	private function confirm_query($result){
		if(!$result){
			$err_msg = "Database query failed: " . mysql_error() . "< /br>";
			$err_msg .= "Last SQL Query: " . $this->last_query;
			die($err_msg);
		}
	}
	
	public function escape_string($value){
		if($this->mysql_real_escape_string_exists){ // if PHP v4.3.0 higher
			if($this->magic_quotes_active){ $value = stripcslashes($value); }
			$value = mysql_real_escape_string($value);
		}else{
			if(!$this->magic_quotes_active) { $value = addslashes($value); }	
		}
		return $value;
	}
	
	public function fetch_array($result){
		return mysql_fetch_array($result);
	}
	
	public function get_num_rows($result){
		return mysql_num_rows($result);
	}
	
	public function get_last_id(){
		return mysql_insert_id($this->connection);
	}
	
	public function get_affected_rows(){
		return mysql_affected_rows($this->connection);
	}
	
	public function get_result(){
		return mysql_result($this->connection);
	}
}

$db = new MySQLDatabase();

?>