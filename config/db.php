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

    public function userExist($login, $password): array|bool
    {
        try {
            $query = 'SELECT * FROM utilisateurs WHERE login = ? and password = MD5(?)';
            $req = $this->connexion->prepare($query);
            $req->execute([$login, $password]);
            $result = $req->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $result;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }
}

