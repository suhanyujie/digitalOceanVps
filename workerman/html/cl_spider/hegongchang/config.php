<?php
/**
 * Created by IntelliJ IDEA.
 * User: lihuanpeng
 * Date: 15/8/28
 * Time: 14:22
 */

header("Content-type: text/html; charset=utf-8");

// 定义应用常量和变量
error_reporting(E_ERROR);
define('APP_PATH', dirname(__FILE__));
define('ROOT_PATH', dirname(APP_PATH));

// 载入配置文件、类库
include ROOT_PATH . '/function/user_agent.php';
include ROOT_PATH . '/function/helper.php';
include ROOT_PATH . '/library/simplehtmldom/simple_html_dom.php';
include ROOT_PATH . '/library/runtime.class.php';
include ROOT_PATH . '/library/pscws4/pscws4.class.php';

// mysql 初始化
try{
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=spider;charset=utf8', 'root', '6852432');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error ){
    alert("PDO连接出错：" . $error->getMessage());
    exit;
}


// 计算某段代码耗时
$runtime = new runtime();

// 采集的入口链接和起止页码
$list_url = 'http://yu.pk1024.com/bbs/forum-3-1.html';
$start_page = 1;
$end_page = 1;