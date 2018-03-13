<?php

require 'rb.php';
$db = require '../config/config_db.php';
R::setup($db['dsn'], $db['user'], $db['pass'], $options);
R::freeze(TRUE);
R::fancyDebug(TRUE);

//$cat = R::dispense('category');
//$cat->title = 'Category 4';
//$id = R::store($cat);
//var_dump($id);


//$cat = R::load('category', 3);
//echo $cat['title'];

//$cat = R::load('category', 3);
//$cat->title = 'category 2';
//R::store($cat);

//$cat = R::load('category', 3);
//R::trash($cat);

//R::wipe('category');

//$cats = R::findAll('category', 'title LIKE ?', ['%ry 2%']);
$cat = R::findOne('category', 'id = 2');
print_r($cat);