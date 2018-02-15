<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vendor\core\base;

use vendor\core\Db;
/**
 * Description of Model
 *
 * @author dboro
 */
abstract class Model {
    
    protected $pdo;
    protected $table;
    protected $pk = 'id';


    public function __construct() {
        $this->pdo = Db::instance();
    }
    
    /**
     * Запрос в бд без возврата данных
     * @param string $sql
     * @return bool
     */
    public function query($sql){
        return $this->pdo->execute($sql);
    }
    
    /**
     * Запрос к бд с возвратом данных
     * @return array
     */
    public function findAll(){
        $sql = "SELECT * FROM {$this->table}";
        return $this->pdo->query($sql); 
    }
    
    /**
     * Запрос к бд с возвратом одной записи
     * @param int $id
     * @param string $field
     * @return array
     */
    public function findOne($id, $field = ''){
        $field = $field ?: $this->pk;
        $sql = "SELECT * FROM {$this->table} WHERE {$field} = ? LIMIT 1";
        return $this->pdo->query($sql, [$id]);
    }
    
    /**
     * Произвольный запрос к бд
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function findBySql($sql, $params = []){
        return $this->pdo->query($sql, $params);
    }
    
    /**
     * Запрос к бд с LIKE
     * @param string $str
     * @param string $field
     * @param string $table
     * @return array
     */
    public function findByLike($str, $field, $table = ''){
        $table = $table ?: $this->table;
        $sql = "SELECT * FROM $table WHERE $field LIKE ?";
        return $this->pdo->query($sql, ['%' . $str .'%']);
    }
}
