<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vendor\core;

/**
 * Description of Db
 *
 * @author dboro
 */
class Db {
    protected $pdo;
    protected static $instance;
    public static $countSql = 0;
    public static $queries = [];
    
    protected function __construct() {
        $db = require ROOT . '/config/config_db.php';
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ];
        $this->pdo = new \PDO($db['dsn'], $db['user'], $db['pass'], $options);
    }
    
    public static function instance(){
        if(self::$instance === NULL){
            self::$instance = new self;
        }
        return self::$instance;
    }
    
    public function execute($sql){
        self::$countSql++;
        self::$queries[] = $sql;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute();
    }
    
    public function query($sql){
        self::$countSql++;
        self::$queries[] = $sql;
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute();
        if($res !== FALSE){
            return $stmt->fetchAll();
        }
        return [];
    }
}
