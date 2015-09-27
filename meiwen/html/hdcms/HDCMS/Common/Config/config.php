<?php
//网站配置
$config = require APP_CONFIG_PATH.'config.inc.php';
//系统名称
$config['HDCMS_NAME'] = 'HDCMS 简体中文 UTF8 版';
//版本号
$config['HDCMS_VERSION'] = '2014.12.21';
//session配置
$config['SESSION_OPTIONS'] = array('type' => 'mysql', 'table' => 'session', 'expire' => 864000, 'domain' => '');
//钩子
$config['HOOK'] = array("APP_INIT" => array("AppInitHook"));
//GET模式
$config['URL_TYPE'] = 2;
$config['TPL_FIX'] = '.php';
/**
 * 伪静态设置
 * 只有前台Index模块开启伪静态
 */
$module = isset($_GET['m']) ? $_GET['m'] : '';//模块
if ($config['REWRITE_ENGINE'] && ($module != "Admin")) {
    $config['URL_REWRITE'] = true;
    $route = include APP_CONFIG_PATH . 'route.inc.php';
    if ($route && is_array($route)) {
        $config['ROUTE'] =$route;
    }
}
/**
 * 返回配置项
 * 压入数据库连接配置
 */
return array_merge($config, require  APP_CONFIG_PATH.'db.inc.php');
?>