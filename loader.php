<?php

    error_reporting(E_ALL);
    define('SITE_PATH', 'D:/wamp/www/pet-projects/student-info-php-oop/');

    include(SITE_PATH .'Library/log4php/Logger.php');

    // Tell log4php to use our configuration file.
    Logger::configure('log4php.xml');

    // Fetch a logger, it will inherit settings from the root logger
    $log = Logger::getLogger('myLogger');

    require_once SITE_PATH .'Library/ez_sql_core.php';
    require_once SITE_PATH .'Library/ez_sql_mysql.php';
    require_once SITE_PATH .'Application/DatabaseConnection.php';
    require_once SITE_PATH .'Application/DAL/StudentDAL.php';
    require_once SITE_PATH .'Application/BLL/StudentBLL.php';
    require_once SITE_PATH .'Application/DTO/StudentDTO.php';
    // Insert the path where you unpacked log4php

?>