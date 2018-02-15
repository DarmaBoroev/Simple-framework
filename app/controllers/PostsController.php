<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\controllers;
/**
 * Description of Posts
 *
 * @author dboro
 */
class PostsController extends AppController{
    public function indexAction() {
        echo 'Posts::index';
    }
    
    public function testAction(){
        debug($this->route);
    }
}
