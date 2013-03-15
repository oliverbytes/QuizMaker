<?php 

/*
	Creator: Oliver Martinez A.K.A. NemOry
	Email, facebook, paypal: nemoryoliver@gmail.com
	Twitter: @NemOry
	if you want to contribute to the System or copy the system and build your own.
	I hope you can please just notify me 1st. :)
*/

// FOR DEVELOPMENT
defined('DB_SERVER') ? null : 				define("DB_SERVER"					, "localhost");
defined('DB_USER') ? null : 				define("DB_USER"					, "root");
defined('DB_PASS') ? null : 				define("DB_PASS"					, "");
defined('DB_NAME') ? null : 				define("DB_NAME"					, "db_quizmaker");

// ----------------------------------------- TABLE CONSTANTS  ------------------------------------------------------- \\

defined('T_GROUPS') ? null :				define("T_GROUPS"					, "tbl_groups");
defined('T_USERS') ? null :					define("T_USERS"					, "tbl_users");
defined('T_QUESTIONS') ? null :				define("T_QUESTIONS"				, "tbl_questions");
defined('T_SCORES') ? null :				define("T_SCORES"					, "tbl_scores");

// ----------------------------------------- TABLE GROUP FIELDS CONSTANTS  ------------------------------------------- \\

defined('C_GROUP_UNIQUE_ID') ? null : 		define("C_GROUP_UNIQUE_ID"			, "id");
defined('C_GROUP_NAME') ? null : 			define("C_GROUP_NAME"				, "name");
defined('C_GROUP_DESCRIPTION') ? null : 	define("C_GROUP_DESCRIPTION"		, "description");
defined('C_GROUP_BANNER') ? null : 			define("C_GROUP_BANNER"				, "banner");

// ----------------------------------------- TABLE USER FIELDS CONSTANTS  ------------------------------------------- \\

defined('C_USER_UNIQUE_ID') ? null : 		define("C_USER_UNIQUE_ID"			, "id");
defined('C_USER_GROUP_ID') ? null : 		define("C_USER_GROUP_ID"			, "group_id");
defined('C_USER_USERNAME') ? null : 		define("C_USER_USERNAME"			, "username");
defined('C_USER_LEVEL') ? null : 			define("C_USER_LEVEL"				, "level");
defined('C_USER_NAME') ? null : 			define("C_USER_NAME"				, "name");
defined('C_USER_PASSWORD') ? null : 		define("C_USER_PASSWORD"			, "password");
defined('C_USER_PICTURE') ? null : 			define("C_USER_PICTURE"				, "picture");
defined('C_USER_ACCESS_TOKEN') ? null :		define("C_USER_ACCESS_TOKEN"		, "access_token");
defined('C_USER_EMAIL') ? null :			define("C_USER_EMAIL"				, "email");
defined('C_USER_ACCESS') ? null :			define("C_USER_ACCESS"				, "access");

// ----------------------------------------- TABLE QUESTIONS FIELDS CONSTANTS  -------------------------------------- \\

defined('C_QUESTION_UNIQUE_ID') ? null : 	define("C_QUESTION_UNIQUE_ID"		, "id");
defined('C_QUESTION_GROUP_ID') ? null : 	define("C_QUESTION_GROUP_ID"		, "group_id");
defined('C_QUESTION_TEXT') ? null : 		define("C_QUESTION_TEXT"			, "text");
defined('C_QUESTION_IDENTIFICATION') ? null : 	define("C_QUESTION_IDENTIFICATION"		, "identification");
defined('C_QUESTION_DIFFICULTY') ? null : 	define("C_QUESTION_DIFFICULTY"		, "difficulty");
defined('C_QUESTION_ANSWER') ? null : 		define("C_QUESTION_ANSWER"			, "answer");
defined('C_QUESTION_CHOICE_A') ? null : 	define("C_QUESTION_CHOICE_A"		, "choice_a");
defined('C_QUESTION_CHOICE_B') ? null : 	define("C_QUESTION_CHOICE_B"		, "choice_b");
defined('C_QUESTION_CHOICE_C') ? null : 	define("C_QUESTION_CHOICE_C"		, "choice_c");
defined('C_QUESTION_FILE') ? null : 		define("C_QUESTION_FILE"			, "file");
defined('C_QUESTION_TYPE') ? null : 		define("C_QUESTION_TYPE"			, "type");
defined('C_QUESTION_POINTS') ? null : 		define("C_QUESTION_POINTS"			, "points");
defined('C_QUESTION_TIMER') ? null : 		define("C_QUESTION_TIMER"			, "timer");

// ----------------------------------------- TABLE SCORES FIELDS CONSTANTS  ------------------------------------------- \\

defined('C_SCORE_UNIQUE_ID') ? null : 		define("C_SCORE_UNIQUE_ID"			, "id");
defined('C_SCORE') ? null : 				define("C_SCORE"					, "score");
defined('C_SCORE_USER_ID') ? null : 		define("C_SCORE_USER_ID"			, "user_id");
defined('C_SCORE_TIME_ELAPSED') ? null : 	define("C_SCORE_TIME_ELAPSED"		, "time_elapsed");
defined('C_SCORE_CORRECT_ANSWERS') ? null : define("C_SCORE_CORRECT_ANSWERS"	, "correct_answers");
defined('C_SCORE_DATE') ? null : 			define("C_SCORE_DATE"				, "date");

?>