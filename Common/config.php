<?php
/*
 * 通用配置文件
 * Date:2015-02-07
 */
$config1 = array(
    /* 数据库设置 */
    'DB_TYPE' => 'mysql', // 数据库类型
    'SHOW_PAGE_TRACE' => FALSE,
    'TOKEN_ON' => true, // 是否开启令牌验证
    'TOKEN_NAME' => '__hash__', // 令牌验证的表单隐藏字段名称
    'TOKEN_TYPE' => 'md5', //令牌哈希验证规则 默认为MD5
    'TOKEN_RESET' => FALSE, //令牌验证出错后是否重置令牌 默认为true

    /* 开发人员相关信息 */
    'AUTHOR_INFO' => array(
        'author' => 'lixuelian',
        'author_email' => 'lixuelianlk@163.com',
    ),
    'TMPL_PARSE_STRING' => array(
        '__UPLOAD__' => __ROOT__ . '/Uploads',
        '__TEMP__'=>THEME_NAME.'/Public',
    ),
    'DEFAULT_MODULE'=>'Index',
    'URL_MODEL'=>1,
    'SESSION_AUTO_START'=>true,//开启session
    
);
$config2 = WEB_ROOT . "Common/systemConfig.php";
$config2 = file_exists($config2) ? include "$config2" : array();
return array_merge($config1, $config2);

