<?php 
namespace Workerman;

use Slim\PDO\Database;
use QL\QueryList;


class MyWorker extends Worker{
    public $count = 0;
    
    /**
     * 构造函数
     * @param string $socket_name
     * @param array $context_option
     */
    public function __construct($socket_name = '', $context_option = array())
    {
        parent::__construct($socket_name, $context_option);
        $backrace = debug_backtrace();
        $this->_appInitPath = dirname($backrace[0]['file']);
    }
    
    /**
     * 运行
     * @see Workerman.Worker::run()
     */
    public function run()
    {
        echo 123;
        $htmlStr = file_get_contents('http://www.baidu.com');

        for($i = 0; $i<200; $i++){
            if($this->count < 200){
                file_put_contents('/www/html/workerman/html/chat1/test.log', $this->count++."\r\n", FILE_APPEND);
                sleep(3);
            }
        }
        echo 456;
        parent::run();
    }
    
    
    
    
    
}



