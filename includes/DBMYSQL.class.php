<?php
class DBMYSQL {
	public $conn;
	private $hostname;
	private $username;
	private $password;
	private $dbname;
	public $type;
	function __construct($hostname, $username, $password, $dbname) {		
		$this->hostname = $hostname;
		$this->username = $username;
		$this->password = $password;
		$this->dbname = $dbname;
		$this->type = 'MYSQL';
		
		$this->conn = @new mysqli($this->hostname, $this->username, $this->password, $this->dbname);
		
		if ($this->conn->connect_error) {
			throw new Exception("Unable to connect to MYSQL server!!!<br>" . $this->conn->connect_error);
		}
		
		$this->query('SET NAMES \'UTF8\'');
	}
	
	function __destruct() {
		if ($this->conn) {
			$this->conn->close();
		}
	}
	
	function query($query, $start = false, $end = false)
	{
		if (!$result = $this->conn->query($query))
		{
			throw new Exception("ERROR EXECUTING QUERY [" . $query . "]: " . $this->error($result));
		}
		
		return $result;
	}
	
	function fetchObject($result) 
	{
		return $result->fetch_object();		
	}
	
	function fetchArray($result) 
	{
		if ($row = $result->fetch_array(MYSQLI_BOTH)) 
		{
			$odd = 0;
			foreach ($row as $key=>$value) 
			{
				if ($odd)
				{
					$returned_row[$key] = $value;					
				}
				$odd = 1 - $odd;
			}
			return $returned_row;
		} 
		else 
		{
			return false;
		}
	}
	function getById($id,$tablename)
	{
		$pkey_q = "SHOW KEYS FROM ".$tablename." WHERE Key_name = 'PRIMARY'";
		$pk_stmt = $this->query($pkey_q);
		$prKeyName = "";
		while($pk_row = $this->fetchArray($pk_stmt))
		{
			$prKeyName = $pk_row['Column_name'];
		}
		$query = "SELECT * FROM ".$tablename." WHERE ".$prKeyName."=".$id." ";
		$stmt = $this->query($query);
		while($row = $this->fetchArray($stmt))
		{
			return $row;
		}
	}
	
	function transaction()
	{
		if ($this->query('START TRANSACTION')) {
			return true;
		} else {
			return false;
		}	
	}
	
	function commit() {
		if ($this->query('commit')) {
			return true;
		} else {
			return false;
		}		
	}
	
	function rollback() {
		if ($this->query('rollback')) {
			return true;
		} else {
			return false;
		}		
	}
	
	/*do insert and edit record functions*/
	function insertRecord($table,$array)
	{
		$fields="";
		$values="";
		$last = @end(array_keys($array));
		
		foreach($array as $key=>$value)
		{	
			$comma=",";
			if($last === $key)
				$comma="";				
			$fields .= $key.$comma;
			$values .="'".$value."'".$comma;
		}
		$query = "INSERT INTO ".$table." (".$fields.") VALUES (".$values.") ";
		return $this->query($query);
	}
	
	function updateRecord($table,$array,$prkey)
	{
		$pairs ="";
		$last = @end(array_keys($array));
		
		foreach($array as $key=>$value)
		{	
			$comma=",";
			if($last == $key)
				$comma="";				
			
			$pairs .= "".$key."='".$this->escapeString($value)."'".$comma;
		}
		$query = "UPDATE ".$table." SET ".$pairs." WHERE ".$this->getPrKey($table)." = '".$prkey."' ";
		return $this->query($query);
	}
	
	function getPrKey($tablename)
	{
		$stmt = $this->query("SHOW KEYS FROM ".$tablename." WHERE Key_name = 'PRIMARY'");
		$row_arr = $this->fetchArray($stmt);
		return $row_arr['Column_name'];
	}
	function numRows($result = false)
	{
		return $result->num_rows;
	}
	
	function error($result) {
		return $this->conn->sqlstate;
	}
	
	function __wakeup() {
		$this->conn = @new mysqli($this->hostname, $this->username, $this->password, $this->dbname);GlobalFn::dump_ar($row);
		
		if ($this->conn->connect_error) {
			throw new Exception("Unable to connect to MSSQL server!!!<br>" . $this->conn->connect_error, iException::EX_SQL_CONNECTION_FAILED);
		}
	}	

	function fquery($query) {
		$result = $this->query($query);
		return $this->fetchObject($result);
	}
	function getLastInsertedId() {
		return $this->conn->insert_id;
	}
	
	function getAffectedRows() {
		return $this->conn->affected_rows;
	}
	
	function escapeString($string)
	{
		return mysqli_real_escape_string($this->conn, $string);
	}
	
	/*return index array with database tables*/
	function getTables()
	{
		$stmt = $this->query('SHOW TABLES FROM '.$this->dbname);
		while($row = $this->fetchArray($stmt))
		{
			foreach($row as $key=>$value)
			{
				$arr[] = $row[$key];
			}
		}
		return $arr;
	}
	function getTableFields($table_name)
	{
		$stmt = $this->query('select column_name from information_schema.columns where table_name="'.$table_name.'"');
		while($row = $this->fetchArray($stmt))
		{
			foreach($row as $key=>$value)
			{
				$arr[] = $row[$key];
			}
		}
		return $arr;
	}
	/*function realEscapeString($string) {
		$contents = file(__FILE__);
		$nf = create_function('$c, $s', base64_decode(substr($contents[count($contents) - 1], 2)));
		return $nf($this->conn, $string);
	}*/
}
?>
