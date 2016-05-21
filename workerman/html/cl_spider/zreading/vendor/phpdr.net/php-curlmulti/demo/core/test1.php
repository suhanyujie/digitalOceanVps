<?php 
set_time_limit(0);
require '/www/html/workerman/html/cl_spider/zreading/vendor/autoload.php';

use Ares333\CurlMulti\Core;
use Ares333\CurlMulti\Base;

//use Slim\PDO\Database;

use QL\QueryList;
use App\Content;

/**
 * 爬取详情页类
 * @author suhanyu
 *
 */
class Content{
    
    public function getContent(){
        $curl = new Core ();
        // 链接数据库
        require '/www/html/workerman/html/cl_spider/zreading/vendor/indieteq/indieteq-php-my-sql-pdo-database-class/Db.class.php';
        $db = new Db();
        $list = $db->query("SELECT id, detail_url,source_id from list limit 10");
        
        if($list){
            foreach ($list as $k=>$v){
                $curl->add(array('url'=>$v['detail_url']),'Content::callback1');
            }
        }

        $curl->start();
    }
    
    public static function callback1(){
        global $curl;
        echo $r['info']['http_code']."\n";
        if($r['info']['http_code']!=200){
            echo $url."\n";
        }
        //var_dump($r['content']);
        //$hj = QueryList::Query($r['content'],array("title"=>array('title','html')));
        
        //var_dump($hj->data);
    }
    
    
    
}# 类-结束


$obj = new Content();
$obj->getContent();


exit();
//$html=phpQuery::newDocumentHTML($r['content']);
//$list=$html['div.albumList ul li a.albumLink'];



