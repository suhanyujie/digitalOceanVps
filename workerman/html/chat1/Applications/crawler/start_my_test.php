<?php
// 自动保存成功~  12222
use \Workerman\Worker;
use \Workerman\WebServer;
use \GatewayWorker\Gateway;
use \GatewayWorker\BusinessWorker;
use \Workerman\Autoloader;
use Workerman\MyWorker;

// 自动加载类
require_once __DIR__ . '/../../Workerman/Autoloader.php';
Autoloader::setRootPath(__DIR__);

// WebServer
$worker = new MyWorker();
// worker名称
$worker->name = 'MyTestWorker';
// bussinessWorker进程数量
new addreviation
$worker->count = 1;





// 如果不是在根目录启动，则运行runAll方法
if(!defined('GLOBAL_START'))
{
    Worker::runAll();
}
