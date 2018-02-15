<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace vendor\core\base;
/**
 * Description of Controller
 *
 * @author dboro
 */
abstract class Controller {
    
    /**
     * текущий маршрут и параметры
     * @var array 
     */
    public $route = [];
    
   /**
     * текущий вид
     * @var string
     */
    public $view;
    
    /**
     * текущий шаблон
     * @var string
     */
    public $layout;
    
    /**
     * пользовательские данные
     * @var array 
     */
    public $vars = [];
    
    public function __construct($route) {
        $this->route = $route;
        $this->view = $route['action'];
    }
    
    public function getView(){
        $vObj = new View($this->route, $this->layout, $this->view);
        $vObj->render($this->vars);
    }
    
    /**
     * Передает в вид переменные
     * @param array $vars
     */
    public function set($vars){
        $this->vars = $vars;
    }
}
