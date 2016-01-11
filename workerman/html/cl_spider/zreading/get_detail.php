<?php
/**
 * 抓取详情页的内容
 * @author 苏汉宇
 * @date 2015-12-20
 */
#exit('#退出#');
include '/www/html/workerman/html/cl_spider/zreading/config.php';
#var_dump($pdo);exit();
// 查询出已经采集到的所有主题链接
$threads = $pdo->query("SELECT id, detail_url,source_id from list limit 10");
$threads = $threads->fetchAll();
$thread_quantity = count($threads);
// 多进程遍历,进行抓取
$workers = 2;
$pids = array();
for ($i = 0; $i < $workers; $i++) {
    $pids[$i] = pcntl_fork(); // 创建子进程

    switch ($pids[$i]) {
        case -1:
            alert('创建子进程失败：' . $i);
            exit;
        case 0;

            $key_start = $thread_quantity / $workers * $i;
            $key_end   = $thread_quantity / $workers * ($i + 1);

            for ($j = $key_start; $j < $key_end; $j++){
                $url = $threads[$j]['detail_url'];
                $reg = array(
                    'title'=>array('.entry-header .entry-name','text','-ins'),    //获取纯文本格式的标题,并调用回调函数1
                   # 'summary'=>array('.summary','text','-input strong'), //获取纯文本的文章摘要，但保strong标签并去除input标签
                    'content'=>array('.entry-content','html','-div -script'),    //获取html格式的文章内容，但过滤掉div和a标签,去除类名为copyright的元素
                   # 'callback'=>array('HJ','callfun2')      //调用回调函数2作为全局回调函数
                );
                $rang = '#content';
                $hj = QueryList::Query($url,$reg,$rang);
                #print_r($hj->data);
                var_dump($hj->data);
                exit();

                if (curl_errno($thread_handle)) {
                    beep();
                    alert('curl出错:' . curl_error($thread_handle));
                    alert('出错的URL是：' . $threads[$j]['detail_url']);
                } else {
                    curl_close($thread_handle);
                }

                $html = str_get_html($thread_content);
                print_r($html);exit();
                // 匹配出详情页内容
                if (is_object($html)) {
                    $e = $html->find('#content .entry-content');
                    foreach($e as $k=>$v){
                        $str = trim($v->innertext);
                    }
                    #$str = $e->innertext;
                    $sourceId = $threads[$j]['source_id'];
                    $addTime = date('Y-m-d H:i:s');

                    try {
                        $pdo = new PDO('mysql:host=127.0.0.1;dbname=spider;charset=utf8', 'root', '6852432');
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = 'INSERT INTO content(content,list_id,add_time)
   				VALUES ';
                        $partSql = "('$str',$sourceId,'$addTime')";
                        $sql .= $partSql;
                        $pdo->exec($sql);
                        exit();
                    } catch (PDOException $error) {
                        alert($error->getMessage());
                    }
                }

                // 释放系统资源
                $html->clear();
                unset($html);
            }
            exit;

        default;
            break;
    }

}
/*********************************************************************/
/**
 * 去重
 */
function check_exists($articleId){
    global $pdo;
    $sql = 'select "x" from content where list_id='.$articleId;
    $resObj = $pdo->query($sql);
    $res = $resObj->fetchAll();

    return $res ? true : false;
}
