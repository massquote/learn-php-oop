<?php

/**
 * helper file the contains
 * reusable functions
 * 
 * @Author: junnotarte
 * @Date:   2018-07-01 08:50:16
 * @Last Modified by:   junnotarte
 * @Last Modified time: 2018-07-01 10:05:23
 */

function systemPath(string $folder) : string
{
	return $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR
			.'src'.DIRECTORY_SEPARATOR
			.$folder.DIRECTORY_SEPARATOR;
}