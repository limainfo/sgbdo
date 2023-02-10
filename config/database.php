<?php
class DATABASE_CONFIG {
	var $default= array(
		'driver' => 'mysql',
		'persistent' => true,
		'host' => '127.0.0.1',
		'login' => 'cakephp',
		'password' => '',
		'database' => 'sgbdo',
		'encoding' => 'utf8'
	);
	var $defaultbackupinicial = array(
		'driver' => 'mysql',
		'persistent' => true,
		'host' => 'localhost',
		'login' => 'sgbdocindacta4backup',
		'password' => '',
		'database' => 'sgbdo',
		'encoding' => 'utf8'
	);
	var $defaultabcd = array(
		'driver' => 'mysql',
		'persistent' => true,
		'host' => 'localhost',
		'login' => 'sgbdo',
		'password' => 'sgbdok2',
		'database' => 'cindacta4',
		'encoding' => 'utf8'
	);
	var $lpna = array(
		'driver' => 'mysql',
		'persistent' => true,
		'host' => '10.228.12.140',
		'login' => 'usu_sgbdo',
		'password' => '',
		'database' => 'lpna',
		'encoding' => 'utf8'
	);
}
?>
