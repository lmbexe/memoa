<?php

use Exception;
use PDO;
use PDOException;

class Database
{
    private $host;
    private $login;
    private $passwd;
    private $base;
    private PDO $connexion;
    private $port;

    public function __construct()
    {
        $this->host = "localhost";
        $this->login = "root";
        $this->passwd = "";
        $this->base = "appnote";
        $this->port = "3306";
        $this->connexion();
    }

    private function connexion()
    {
        try {
            $this->connexion = new PDO("mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->base . ";charset=utf8", $this->login, $this->passwd);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}