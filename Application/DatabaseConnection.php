<?php
/**
 * User: Arif Uddin
 * Date: 4/6/12
 * Time: 4:51 PM
 */

class DatabaseConnection {

    private $dbUser;
    private $dbPassword;
    private $dbName;
    private $dbHost;

    public function DatabaseConnection() {
        $this->dbUser = 'root';
        $this->dbPassword = '';
        $this->dbName = 'stdinfo';
        $this->dbHost = 'localhost';
    }

    public function GetDB() {
        $db = new ezSQL_mysql($this->dbUser, $this->dbPassword, $this->dbName, $this->dbHost);
        return $db;
    }
}
