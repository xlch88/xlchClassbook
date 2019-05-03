<?php
class DB {
	var $link = null;
	
	function __construct($db_host,$db_user,$db_pass,$db_name,$db_port){
		$this->link = mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);
		if (!$this->link) return false;
 
		mysqli_query($this->link,"set sql_mode = ''");
		mysqli_query($this->link,"set character set 'utf8'");
		mysqli_query($this->link,"set names 'utf8'"); 
		return true;
	}
	function fetch($q){
		return mysqli_fetch_assoc($q);
	}
	function get_row($q){
		$result = mysqli_query($this->link,$q);
		return mysqli_fetch_assoc($result);
	}
	function count($q){
		$result = mysqli_query($this->link,$q);
		$count = mysqli_fetch_array($result);
		return $count[0];
	}
	function query($q){
		$GLOBALS['SqlQueryNumber']++;
		return mysqli_query($this->link,$q);
	}
	function escape($str){
		return mysqli_real_escape_string($this->link,$str);
	}
	function insert($q){
		if(mysqli_query($this->link,$q))
			return mysqli_insert_id($this->link); 
		return false;
	}
	function affected(){
		return mysqli_affected_rows($this->link);
	}
	function insert_array($table,$array){
		$q = "INSERT INTO `$table`";
		$q .=" (`".implode("`,`",array_keys($array))."`) ";
		$q .=" VALUES ('".implode("','",array_values($array))."') ";
		
		if(mysqli_query($this->link,$q))
			return mysqli_insert_id($this->link);
		return false;
	}
	function error(){
		$error = mysqli_error($this->link);
		$errno = mysqli_errno($this->link);
		return '['.$errno.'] '.$error;
	}
	function close(){
		return mysqli_close($this->link);
	}
}
?>