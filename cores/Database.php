<?php

class Database
{
    private $servername = 'localhost';
    private $dbname = 'mvc';
    private $email = 'root';
    private $password = 'root';

    protected function connect()
    {
        try {
            $conn = new PDO('mysql:host=' . $this->servername . ';dbname=' . $this->dbname . '', $this->email, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}