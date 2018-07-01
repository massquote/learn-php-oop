<?php
/**
 * The model class that is responsible on 
 * connecting and querying the data in mysql db
 * 
 * @Author: junnotarte
 * @Date:   2018-07-01 10:46:30
 * @Last Modified by:   Felix Notarte
 * @Last Modified time: 2018-07-01 12:50:31
 */
namespace Cart;

class Model 
{	
	private $sql 	='';
	private $binds 	= [];
	private $db;
	private $config = [
					'host' 		=> 'localhost',
					'user'		=> 'dev',
					'pass' 		=> 'dev',
					'database' 	=> 'cart'
				];

	function __construct(){}

	/**
	 * It will instantiate connection
	 * @return none 
	 */
	private function setConnection()
	{
		$this->db = @mysqli_connect($this->config['host'], 
									$this->config['user'],
									$this->config['pass'],
									$this->config['database']
								);
		if (!$this->db)
		{
			echo "Error: " . mysqli_connect_error();
			exit();
		}
	}

	/**
	 * Set the sql query for binding later
	 * @param  string $sql
	 * @return obj      
	 */
	public function setQuery(string $sql)
	{
		$this->sql = $sql;
		return $this;
	}

	/**
	 * It will set the data for binding
	 * @param array $data 
	 */
	public function setData(array $data)
	{
		$this->binds = $data;
		return $this;
	}

	/**
	 * It will just return the constructed sql
	 * @return string 
	 */
	public function getSql() : string
	{
		$sql = $this->sql;

		foreach ($this->binds as $val) {
			$format = $sql;
			$sql =  sprintf($format, $val);
		}

		return $sql;
	}

	/**
	 * It will combine query and data and connect
	 * to db to query the data
	 * @return array 
	 */
	public function getRows() : array
	{
		$this->setConnection();
		$sql = $this->getSql();
		$query = mysqli_query($this->db, $sql);

		$data = [];
		while($row = mysqli_fetch_assoc($query)) {
       		array_push($data, $row);
    	}
		mysqli_free_result($query);
		mysqli_close ($this->db);
		return $data;
	}

	/**
	 * Function the same as query but 
	 * returns the new inserted id
	 * @return int new inserted id
	 */
	public function insert() : int
	{
		$this->setConnection();
		$sql = $this->getSql();
		$query = mysqli_query($this->db, $sql);

		$id = mysql_insert_id();

		mysqli_close ($this->db);
		return $id;
	}

	/**
	 * Function the same as query but
	 * return boolead if record is updated or not
	 * @return boolean 
	 */
	public function update() : bool
	{
		$this->setConnection();
		$sql = $this->getSql();
		$result = mysqli_query($this->db, $sql);
		mysqli_close ($this->db);
		return $result;
	}
}