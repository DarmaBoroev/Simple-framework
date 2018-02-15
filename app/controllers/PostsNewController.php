<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\controllers;
/**
 * Description of PostsNew
 *
 * @author dboro
 */
class PostsNewController extends AppController{
    public function indexAction() {
        echo 'PostsNew::index';
    }
    
    public function testAction(){
        echo 'PostsNew::test';
    }
    
    public function testPageAction(){
        echo 'PostsNew::testPageAction';
    }
}
