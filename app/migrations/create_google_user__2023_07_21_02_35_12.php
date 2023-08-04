<?php

namespace App\Migrations;

use App\Core\Database\NativeDB;

class create_google_user__2023_07_21_02_35_12{
      
     
	   public function up($db)
	   {     
           $db->query('CREATE TABLE if NOT EXISTS `google_users` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `oauth_uid` varchar(50) NOT NULL,
				  `first_name` varchar(25) NOT NULL,
				  `last_name` varchar(25) DEFAULT NULL,
				  `email` varchar(50) NOT NULL,
				  `profile_pic` varchar(200) NOT NULL,
				  `gender` varchar(10) DEFAULT NULL,
				  `local` varchar(20) DEFAULT NULL,
				  PRIMARY KEY (`id`),
				  UNIQUE KEY `email` (`email`),
				  UNIQUE KEY `oauth_uid` (`oauth_uid`)
				) ENGINE=InnoDB');
           

	   }

	   public function down($db)
	   { 

	     $db->query("DROP TABLE if EXISTS `google_users`");

	   }
	   
}