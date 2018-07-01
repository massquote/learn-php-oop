<?php
/**
 * This wll handle the session of the system
 * 
 * @Author: junnotarte
 * @Date:   2018-07-01 13:43:29
 * @Last Modified by:   Felix Notarte
 * @Last Modified time: 2018-07-01 16:56:48
 */
namespace Cart;

class Session
{
	
	function __construct()
	{
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
	}

	/**
	 * This will generate one time 
	 * token for a very simple security 
	 * of posting data
	 * @return string
	 */
	public function generateToken() : string
	{
		$this->setValue('token', sha1(session_id().'s@lT32-10!'));
		return $this->getValue('token');
	}

	/**
	 * this will just set a vallue in session
	 * @param string $key   
	 * @param any $value 
	 */
	public function setValue(string $key, $value)
	{
		$_SESSION[$key] = $value;
	}

	/**
	 * This will get the value of session and
	 * if session does not exist return null
	 * @param  string $key 
	 * @return any      
	 */
	public function getValue(string $key)
	{
		return $_SESSION[$key] ?? null;
	} 
}