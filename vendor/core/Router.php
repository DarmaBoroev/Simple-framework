<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace vendor\core;
/**
 * Description of Router
 *
 * @author dboro
 */
class Router {
    
    /**
     * таблица марщрутов
     * @var array 
     */
    public static $routes = [];
    
    /**
     * текущий маршрут
     * @var array 
     */
    public static $route = [];
    
    /**
     * Добавляет маршрут в таблицу маршрутов
     * @param string $regexp
     * @param array $route
     */
    public static function add($regexp, $route = []){
        self::$routes[$regexp] = $route;
    }
    
    /**
     * возвращает таблицу маршрутов
     * @return array
     */
    public static function getRoutes(){
        return self::$routes;
    }
    
    /**
     * возвращает текущий маршрут
     * @return array
     */
    public static function getRoute(){
        return self::$route;
    }
    
    /**
     * Ищет совпадения в таблице маршрутов
     * @param string $url
     * @return boolean
     */
    public static function matchRoute($url){
        foreach(self::$routes as $pattern => $route){
            if(preg_match("#$pattern#i", $url, $matches)){
                foreach($matches as $k => $v){
                    if(is_string($k)){
                        $route[$k] = $v;
                    }
                }
                if(!isset($route['action'])){
                    $route['action'] = 'index';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }
    
    /**
     * Перенаправляет url по корректному маршруту
     * @param string $url входящий URL
     * @return void
     */
    public static function dispatch($url){
        $url = self::removeQueryString($url);
        if(self::matchRoute($url)){
            $controller = 'app\controllers\\' . self::$route['controller'];
            if(class_exists($controller)){
                $cObj = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']) . 'Action';
                if(method_exists($cObj, $action)){
                    $cObj->$action();
                    $cObj->getView();
                }else{
                    echo "Method $controller::$action not found";
                }
            }else{
                echo "Controller $controller not found!";
            }
        }else{
            http_response_code(404);
            include '404.html';
        }
    }
    
    protected static function upperCamelCase($name){
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }
    
    protected static function lowerCamelCase($name){
        return lcfirst(self::upperCamelCase($name));
    }
    
    /**
     * Обрезает URL
     * @param string $url
     * @return string
     */
    protected static function removeQueryString($url){
        if($url){
            $params = explode('&', $url);
            if(false === strpos($params[0], '=')){
                return rtrim($params[0], '/');
            }else{
                return '';
            }
        }
    }
    
}
