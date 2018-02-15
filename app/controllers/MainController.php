<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\controllers;
use app\models\Main;
/**
 * Description of Main
 *
 * @author dboro
 */
class MainController extends AppController{
    public function indexAction() {
        $model = new Main;
        $posts = $model->findAll();
        $posts2 = $model->findAll();
        $title = 'Page title';
        $this->set(compact('title', 'posts'));
        
    }
}
