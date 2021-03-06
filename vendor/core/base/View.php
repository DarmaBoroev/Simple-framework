<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vendor\core\base;

/**
 * Description of View
 *
 * @author dboro
 */
class View {

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

    public function __construct($route, $layout = '', $view = '') {
        $this->route = $route;
        if ($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }
        $this->view = $view;
    }
    
    /**
     * Подключает нужный вид и шаблон
     * @param array $vars
     */
    public function render($vars) {
        if(is_array($vars)) extract($vars);
        $file_view = APP . "/views/{$this->route['controller']}/$this->view.php";
        ob_start();
        if (is_file($file_view)) {
            require $file_view;
        } else {
            echo "Not found view <b>$file_view</b>";
        }
        $content = ob_get_clean();

        if (false !== $this->layout) {
            $file_layout = APP . "/views/layouts/{$this->layout}.php";
            if (is_file($file_layout)) {
                require $file_layout;
            } else {
                echo "Not found layout <b>$file_layout</b>";
            }
        }
    }

}
