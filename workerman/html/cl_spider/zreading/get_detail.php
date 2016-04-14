<?php
/**
 * 抓取详情页的内容
 * @author 苏汉宇
 * @date 2015-12-20
 */
#exit('#退出#');
include '/www/html/workerman/html/cl_spider/zreading/config.php';
require '/www/html/workerman/html/cl_spider/zreading/vendor/autoload.php';

use Slim\PDO\Database;
use QL\QueryList;

if(1){
	ini_set("display_errors", "On");
	error_reporting(E_ALL);
}

#var_dump($pdo);exit();
// 查询出已经采集到的所有主题链接
$threads = $pdo->query("SELECT id, detail_url,source_id from list limit 60");
$threads = $threads->fetchAll();
$thread_quantity = count($threads);
// 数据库连接
require '/www/html/workerman/html/cl_spider/zreading/vendor/indieteq/indieteq-php-my-sql-pdo-database-class/Db.class.php';
$db = new Db();
// 多进程遍历,进行抓取
$workers = 1;
$timer = new \Jenner\Timer(\Jenner\Timer::UNIT_KB);
$timer->mark('a');

$pids = array();
for ($i = 0; $i < $workers; $i++) {
    $pids[$i] = pcntl_fork(); // 创建子进程
    switch ($pids[$i]) {
        case -1:
            alert('创建子进程失败：' . $i);
            exit;
        case 0:
            $key_start = $thread_quantity / $workers * $i;
            $key_end   = $thread_quantity / $workers * ($i + 1);
            for ($j = $key_start; $j < $key_end; $j++){
                $url = $threads[$j]['detail_url'];
                $sourceId = $threads[$j]['source_id'];
                $reg = array(
                    'title'=>array('.entry-header .entry-name','text','-ins'),    //获取纯文本格式的标题,并调用回调函数1
                    //'list_id'=>$sourceId,
                   # 'summary'=>array('.summary','text','-input strong'), //获取纯文本的文章摘要，但保strong标签并去除input标签
                    'content'=>array('.entry-content','html','-div -script'),    //获取html格式的文章内容，但过滤掉div和a标签,去除类名为copyright的元素
                   # 'callback'=>array('HJ','callfun2')      //调用回调函数2作为全局回调函数
                );
                $rang = '#content';
                // sleep(1);
                $hj = QueryList::Query($url,$reg,$rang);
                $res = $hj->data;
                //var_dump($res[0]['title']);
                //exit('#50-1#');
                // 链接数据库
               
                $insertData = array(
                	'author'=>'左岸读书',
                	'content'=>isset($res[0]['content']) ? addslashes($res[0]['content']) : '', 
                	'list_id'=>$sourceId,
                	'add_time'=>date('Y-m-d H:i:s'),	 
                );
                // 插入数据到数据库
                $insert = $db->query("INSERT INTO content(author,content,list_id,add_time) VALUES (:p1,:p2,:p3,:p4)", 
                                array("p1"=>"左岸读书","p2"=>$insertData['content'],'p3'=>$insertData['list_id'],'p4'=>date('Y-m-d H:i:s')));
                
                var_dump($insert);
            }
            // 子进程退出
            $curPid = getmypid();
            exit('#子进程退出：'.$curPid."#\n");
            break;
        default;
        	echo 'This is parent Process!['.getmypid()."]\n";
        	pcntl_waitpid($pids[$i], $status);
            break;
    }
}

// 当pcntl_fork出来以后，会返回一个pid值，这个pid在子进程中看是0，在父进程中看是子进程的pid（>0），如果pid为-1说明fork出错了。
// 使用一个$pids数组就可以让主进程等候所有进程完结之后再结束了
// foreach ($pids as $k => $pid) {
//     if($pid) {
//         pcntl_waitpid($pid, $status);
//     }
// }
$timer->mark('b');
$timer->printDiffReportByStartAndEnd('a', 'b');
exit('#主进程退出~#');
/*********************************************************************/
/**
 * 去重 根据原始文章id
 */
function check_exists($articleId){
    global $pdo;
    $sql = 'select "x" from content where list_id='.$articleId;
    $resObj = $pdo->query($sql);
    $res = $resObj->fetchAll();

    return $res ? true : false;
}
