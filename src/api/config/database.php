<?php
class Database
{
    //connection settings
    private $host = "renanroncarati.com";
    private $db_name = "renan465_db-applicationdevelopment";
    private $username = "renan465_appdev";
    private $password = "Password-application";


    public $conn;

    /**
     * get the database connection
     *
     * @return PDOConnection
     */
    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }

}
