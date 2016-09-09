<?php
	/**
	 * Created by PhpStorm.
	 * User: digital
	 * Date: 9/9/16
	 * Time: 10:44 AM
	 */
	
	require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload
	
	use CommonServices\HelperService;
	
	echo HelperService::sayHello();