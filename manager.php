<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of manager
 *后台入口文件
 * @author 李雪莲 <lixuelianlk@163.com>
 */


ini_set('date.timezone', 'Asia/Shanghai');
ini_set('magic_quotes_gpc','off');

define('APP_NAME', 'Admin');
define('APP_PATH', './Admin/');
define("WEB_ROOT", dirname(__FILE__) . "/");

define('WEB_CACHE_PATH', WEB_ROOT."temp/");
define('RUNTIME_PATH',WEB_ROOT.'temp/Admin/');
define('DatabaseBackDir',WEB_ROOT.'Databases/');

define('APP_DEBUG',true);


require './ThinkPHP/ThinkPHP.php';


