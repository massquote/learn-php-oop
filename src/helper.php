<?php

/**
 * helper file the contains
 * reusable functions. This can be converted
 * as config too.
 * 
 * @Author: junnotarte
 * @Date:   2018-07-01 08:50:16
 * @Last Modified by:   Felix Notarte
 * @Last Modified time: 2018-07-01 18:04:59
 */

/**
 * Just to define the system path
 * @param  string $folder 
 * @return string         
 */
function systemPath(string $folder) : string
{
	return $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR
			.'src'.DIRECTORY_SEPARATOR
			.$folder.DIRECTORY_SEPARATOR;
}

/**
 * Just to define the host of the system
 * @return string 
 */
function baseURL() : string
{
	return 'http://task.local/';
}