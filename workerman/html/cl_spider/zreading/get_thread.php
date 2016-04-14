<?php
/**
 * 获取列表到数据库
 * by suhy
 * php /www/html/workerman/html/cl_spider/zreading/get_thread.php
 */
include './config.php';

for ($i = $start_page; $i <= $end_page; $i++) {

    // 初始化curl
    $list_handle = curl_init();

    // curl配置参数
    $options = [
        CURLOPT_URL => $list_url.$i,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_USERAGENT => rand_user_agent(), // 每次运行随机生成user_agent
    ];
    echo $options[CURLOPT_URL]."\r\n";

    curl_setopt_array($list_handle, $options);

    // 执行curl
    $pageContent = curl_exec($list_handle);
    if (curl_errno($list_handle)) {
        beep();
        alert('curl出错:' . curl_error($list_handle));
        alert('出错的URL是：' . $list_url . $i);
    } else {
        curl_close($list_handle);
        alert("第 $i 列表页html内容获取成功！");
    }

    $html = str_get_html($pageContent);
    
    
    $thread_lists = $html->find('#container');

    $urlPrev = 'http://yu.pk1024.com/bbs/';
    foreach($thread_lists as $threadTable){
    	$dataArr = array();
    	// 标题和链接地址   find('tr .f_title a[href^="thread"]')
    	foreach ($threadTable->find('#content header h2 a') as $url) {
    		$title = trim($url->innertext);
    		#$data_url = "http://yu.pk1024.com/bbs/" . $url->href;
            $detailUrl = trim($url->href);
            $sourceId = get_article_id($detailUrl);
    		$addTime = date('Y-m-d H:i:s');
            if(check_exists_data($sourceId)){
                echo "$sourceId 存在 \r\n";
                continue;
            }
            $dataArr[] = '("'.$detailUrl.'","'.$sourceId.'","'.$addTime.'")';
    	}
        $partSql = implode(',',$dataArr);
        # 没有数据 则跳过
    	if(!$dataArr)continue;
    	try {
//    		$stmt = $pdo->prepare("INSERT INTO list(
//    				detail_url,source_id,add_time)
//    				VALUES (:detail_url, :source_id, :add_time)");
//    		$stmt->bindParam(":detail_url", $detailUrl);
//    		$stmt->bindParam(":source_id", $sourceId);
//    		$stmt->bindParam(":add_time", $addTime);
//    		$stmt->execute();
            $sql = 'INSERT INTO list(detail_url,source_id,add_time)
   				VALUES ';
            $sql .= $partSql;
            $pdo->exec($sql);
    	} catch (PDOException $error) {
    		alert($error->getMessage());
    	}
    	
    }
    //var_dump($thread_lists);
    #exit('done!');
    /*
    foreach ($thread_lists as $thread_tr) {

        // 标题和链接地址
        foreach ($thread_tr->find('td h3 a') as $url) {
            $title = iconv('gb2312', 'utf-8//IGNORE', $url->innertext);
            $url = "http://t66y.com/" . $url->href;
        }
        // 回复数量
        foreach ($thread_tr->find('td[class=tal f10 y-style]') as $comment) {
            $comments = $comment->innertext;
        }
        // 作者
        foreach ($thread_tr->find('a[class=bl]') as $author) {
            $author = iconv('gb2312', 'utf-8', $author->innertext);
        }
        // 发表时间
        foreach ($thread_tr->find('a[class=f10]') as $create_time) {
            $create_time = $create_time->innertext;
        }

        try {
            $stmt = $pdo->prepare("INSERT INTO test_thread (title, author, comments, create_time, url) VALUES (:title, :author, :comments, :create_time, :url)");
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":author", $author);
            $stmt->bindParam(":comments", $comments);
            $stmt->bindParam(":create_time", $create_time);
            $stmt->bindParam(":url", $url);
            $stmt->execute();
        } catch (PDOException $error) {
            alert($error->getMessage());
        }

    }*/

    if (is_array($dataArr) && count($dataArr) > 0) {
        alert("第 $i 列表页主题帖链接获取完成!");
    }

    // 任务提示, 最后1页运行完成时提示
    if ($i == $end_page){
        alert('列表采集完成！');
        //$next_step = 'get_img_url';
    }

    $html->clear();
    unset($html);
}

/*********************以下是一些用到的函数***********************************/
/**
 * 根据url获取文章的id
 *  http://www.zreading.cn/archives/5175.html
 */
function get_article_id($url){
    if(!$url) return false;
    $pattern = '@(\d+).html@';
    preg_match_all($pattern,$url,$res1);
    $res1[1][0] = (int)$res1[1][0];

    return $res1[1][0];
}
/**
 * 检查数据是否存在过
 */
function check_exists_data($sourceId){
    global $pdo;
    $sql = 'select "x" from list where source_id='.$sourceId;
    $resObj = $pdo->query($sql);
    $res1 = $resObj->fetch();

    return $res1 ? true : false;
}







