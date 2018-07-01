<?php
/**
 * This framework is not for production deployment.
 * This was build for the purpose of complying
 * a certain task with specific functions. This
 * if for learning basic php OOP purpose only
 * 
 * @Author: junnotarte
 * @Date:   2018-06-30 20:27:38
 * @Last Modified by:   junnotarte
 * @Last Modified time: 2018-07-01 11:35:28
 */


	error_reporting(-1);
	ini_set('display_errors', 1);

	require "vendor/autoload.php";
	require_once "src/helper.php";

	use Cart\Routes;
	
	$routes = new Routes();
	$routes->loadController();