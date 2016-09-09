<?php
	/**
	 * Created by PhpStorm.
	 * User: digital
	 * Date: 9/9/16
	 * Time: 10:44 AM
	 */
	
	require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload
	
	use CommonServices\HelperService;
	
	echo HelperService::getRandomString(8);
	echo HelperService::commentCountsInKs(1122);
	echo HelperService::addScheme('google.com');
	echo HelperService::addScheme('127.0.0.1','ftp://');