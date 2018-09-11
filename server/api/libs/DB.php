<?php

//include_once('../config/config.php');

class DB {
    private $pdo;

    public function __construct(){
        $dns = "mysql:dbname=".DB_NAME.";host=".DB_HOST;
        $this->pdo = new PDO($dns, DB_USER, DB_PASS);
        return $this->pdo;
    }

    public function query($query){
        $res = $this->pdo->query($query, PDO::FETCH_ASSOC);
        return $res->fetchAll();
    }

    public function queryFetch($query, $data)
    {
        $sth = $this->pdo->prepare($query);
        $sth->execute($data);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function queryFetchAll($query, $data){
        $sth = $this->pdo->prepare($query);
        $sth->execute($data);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}