<?php

class Config {	

	public static function get($param) {
		
		$config = array (
			
			// name of website
			'site_name' => 'Ukraine International Airlines ',
			
			// base url
			'base_url' => '://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']),
			
			// base path
			'base_path' => realpath(__DIR__ . '/..'),
			
			// home page
			'home' => 'home',
			
			// write user actions to usage.log file (true/false)
			'write_log' => false,
		
			// database server
			'db_host' => 'ddaclasthope93.mysql.database.azure.com',
			'db_port' => '3306',
			
			// database login
			'db_username' => 'lasthope93@ddaclasthope93',
			'db_password' => 'aabbccddee@11223344',
			
			// database name
            'db_name' => 'ddac',
            
			// file directory mode
			// 0755 = everything for owner, read and execute for others
			'new_dir_mode' => 0755,
			
			// time/date format - see php date()
			'time_format' => 'd/m/y',
		
			// this restricted files will be hidden (no wildcards)
			'restricted_files' => array('.htaccess','Thumbs.db'),
		
			// user's cookie
			'cookie_name' => 'hash',
			
			// cookie expiry (86400 = a day)
			'cookie_expiry' => 86400
					
		);
		
		if(isset($config[$param])) {
			return $config[$param];
		}
	}
}