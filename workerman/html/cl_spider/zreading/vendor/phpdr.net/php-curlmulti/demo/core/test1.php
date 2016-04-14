<?php 
set_time_limit(0);
require '/www/html/workerman/html/cl_spider/zreading/vendor/autoload.php';

use Ares333\CurlMulti\Core;
use Ares333\CurlMulti\Base;

//use Slim\PDO\Database;

use QL\QueryList;


$curl = new Core ();
//$curl->cbUser = 'demo2_cb1';

// 链接数据库
require '/www/html/workerman/html/cl_spider/zreading/vendor/indieteq/indieteq-php-my-sql-pdo-database-class/Db.class.php';
// $db = new Db();
// $list = $db->query("SELECT id, detail_url,source_id from list limit 100");
// if($list){
//     foreach ($list as $k=>$v){
//         $curl->add(array('url'=>$v['detail_url']),'demo2_cb1');
//     }
// }



$url = 'http://projector.zol.com.cn/574/5745332.html';
$curl->add(array('url'=>$url),'demo2_cb1');


//var_dump($res1);exit();

$curl->start();

//$html=phpQuery::newDocumentHTML($r['content']);
//$list=$html['div.albumList ul li a.albumLink'];


//处理歌手详情页的回调函数
function demo2_cb1($r,$url){
    global $curl;
    echo $r['info']['http_code']."\n";
    if($r['info']['http_code']!=200){
        echo $url."\n";
    }
    //var_dump($r['content']);
    //$hj = QueryList::Query($r['content'],array("title"=>array('title','html')));
    
    //var_dump($hj->data);
}

