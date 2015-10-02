<?php

    error_reporting(E_ALL);

    include('Library/log4php/Logger.php');

    // Tell log4php to use our configuration file.
    Logger::configure('log4php.xml');

    // Fetch a logger, it will inherit settings from the root logger
    $log = Logger::getLogger('myLogger');

    // Start logging
    /*$log->trace("My first message."); // Not logged because TRACE < WARN
    $log->debug("My second message."); // Not logged because DEBUG < WARN
    $log->info("My third message."); // Not logged because INFO < WARN
    $log->warn("My fourth message."); // Logged because WARN >= WARN
    $log->error("My fifth message."); // Logged because ERROR >= WARN
    $log->fatal("My sixth message."); // Logged because FATAL >= WARN*/

    require_once './Library/ez_sql_core.php';
    require_once './Library/ez_sql_mysql.php';
    require_once './Application/DatabaseConnection.php';
    require_once './Application/DAL/StudentDAL.php';
    require_once './Application/BLL/StudentBLL.php';
    require_once './Application/DTO/StudentDTO.php';
        // Insert the path where you unpacked log4php
?>