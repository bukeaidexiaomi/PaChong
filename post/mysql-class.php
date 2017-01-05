<?php


class MySql {

	var $queryCount = 0;
	var $conn;
	var $result;

	function MySql($dbHost = '', $dbUser = '', $dbPass = '', $dbName = '')
	{
		if(!$this->conn = @mysql_connect($dbHost, $dbUser, $dbPass))
		{
			die("连接数据库失败,可能是mysql数据库用户名或密码错误");
		}
		if($this->getMysqlVersion() >'4.1')
		{
			mysql_query("SET NAMES 'utf8'");
		}

		@mysql_select_db($dbName, $this->conn) OR die("未找到指定数据库");
	}

	function close()
	{
		return mysql_close($this->conn);
	}

	function query($sql)
	{
		$this->result = @ mysql_query($sql,$this->conn);
		$this->queryCount++;
		if(!$this->result)
		{
			die("SQL语句执行错误：$sql <br />".$this->geterror());
		} else {
			return $this->result;
		}
	}


	function fetch_array($query)
	{
		return mysql_fetch_array($query);
	}
	

	function fetch_row($query)
	{
		return mysql_fetch_row($query);
	}


	function num_rows($query)
	{
		return mysql_num_rows($query);
	}

	function num_fields($query)
	{
		return mysql_num_fields($query);
	}

	function insert_id()
	{
		return mysql_insert_id($this->conn);
	}
	
	
	function fetch_one_array($sql)
	{
		$this->result = $this->query($sql);
		return $this->fetch_array($this->result);
	}


	function geterror()
	{
		return mysql_error();
	}


	function getMysqlVersion()
	{
		return mysql_get_server_info();
	}

}

?>