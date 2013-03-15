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

class Score extends DatabaseObject{
	
	// TABLE tbl_scores PROPERTIES
	protected static $table_name = T_SCORES;
	protected static $col_id = C_SCORE_UNIQUE_ID;
	
	// SCORE PROPERTIES
	public $id;
	public $score;
	public $user_id;
	public $time_elapsed;
	public $correct_answers;
	public $date;
	
	public function create()
	{
		global $db;
		$sql = "INSERT INTO " . self::$table_name . " (";
		$sql .= C_SCORE 				.", ";
		$sql .= C_SCORE_USER_ID 		.", ";
		$sql .= C_SCORE_TIME_ELAPSED 	.", ";
		$sql .= C_SCORE_CORRECT_ANSWERS .", ";
		$sql .= C_SCORE_DATE 			." ";
		$sql .=") VALUES (";
		$sql .= $db->escape_string($this->score) 	. ", ";
		$sql .= $db->escape_string($this->user_id) 	. ", ";
		$sql .= $db->escape_string($this->time_elapsed) 	. ", ";
		$sql .= $db->escape_string($this->correct_answers) 	. ", ";
		$sql .= " CURDATE() ";
		$sql .=")";

		if($db->query($sql))
		{
			$this->id = $db->get_last_id();
			return true;
		}
		else
		{
			return false;	
		}
	}
	
	public function update()
	{
		global $db;
		$sql = "UPDATE " 				. self::$table_name . " SET ";
		$sql .= C_SCORE 				. "=" . $db->escape_string($this->score) 			. " ";
		$sql .= C_SCORE_USER_ID 		. "=" . $db->escape_string($this->user_id) 			. " ";
		$sql .= C_SCORE_TIME_ELAPSED 	. "=" . $db->escape_string($this->time_elapsed) 	. " ";
		$sql .= C_SCORE_CORRECT_ANSWERS . "=" . $db->escape_string($this->correct_answers) 	. " ";
		$sql .= C_SCORE_DATE 			. "= CURDATE() ";
		$sql .="WHERE " . self::$col_id . "=" . $db->escape_string($this->id) 		. "";
		$db->query($sql);
		return ($db->get_affected_rows() == 1) ? true : false;
	}
	
	public function delete()
	{
		global $db;
		$sql = "DELETE FROM " . self::$table_name . " WHERE " . self::$col_id . "=" . $this->id . "";
		$db->query($sql);
		return ($db->get_affected_rows() == 1) ? true : false;
	}

	protected static function instantiate($record)
	{
		$this_class = new self;
		$this_class->id 				= $record[C_SCORE_UNIQUE_ID];
		$this_class->score 				= $record[C_SCORE];
		$this_class->user_id 			= $record[C_SCORE_USER_ID];
		$this_class->time_elapsed 		= $record[C_SCORE_TIME_ELAPSED];
		$this_class->correct_answers 	= $record[C_SCORE_CORRECT_ANSWERS];
		$this_class->date 				= $record[C_SCORE_DATE];
		return $this_class;
	}

	public static function get_highest_score($user_id){
		global $db;
		$sql = "SELECT MAX(".C_SCORE.") AS HIGHEST_SCORE FROM ".self::$table_name." WHERE ".C_SCORE_USER_ID." = ".$user_id;
		$result = $db->query($sql);
		$highest_score = mysql_fetch_array($result);
		return $highest_score['HIGHEST_SCORE'];
	}

	public static function get_recent_score($user_id){
		global $db;
		$sql = "SELECT ".C_SCORE." FROM ".self::$table_name." WHERE ".self::$col_id."=(SELECT MAX(".self::$col_id.")  FROM ".self::$table_name." WHERE ".C_SCORE_USER_ID." = ".$user_id.")";
		$result = $db->query($sql);
		$recent_score = mysql_fetch_array($result);
		return $recent_score[C_SCORE];
	}
}

?>