<?php
/**
 * Created by IntelliJ IDEA.
 * User: lihuanpeng
 * Date: 15/8/25
 * Time: 22:48
 */
include './config.php';

for ($i = $start_page; $i <= $end_page; $i++) {

    // 初始化curl
    $list_handle = curl_init();

    // curl配置参数
    $options = [
        CURLOPT_URL => $list_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_USERAGENT => rand_user_agent(), // 每次运行随机生成user_agent
    ];
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
    
    
    $thread_lists = $html->find('.maintable .spaceborder table');

    $urlPrev = 'http://yu.pk1024.com/bbs/';
    foreach($thread_lists as $threadTable){
    	$time = time();
    	// 标题和链接地址
    	foreach ($threadTable->find('tr .f_title a[href^="thread"]') as $url) {
    		$title = $url->innertext;
    		$data_url = "http://yu.pk1024.com/bbs/" . $url->href;
    		break;
    	}
    	if(strpos($title,'合集') == false) continue;
    	# 列表页
    	$parent_page = $options[CURLOPT_URL];
    	# 当前页面的id
    	preg_match_all('#forum(\-[\d]+\-[\d]+)#',$parent_page,$res1);
    	$parent_page_id = (int)str_replace('-','',$res1[1][0]);
    	
     	// 作者
        foreach ($threadTable->find('tr .f_author a') as $author) {
        	$author = $author->innertext;
        }
    	// 回复数量
    	foreach ($threadTable->find('tr .f_views') as $comment) {
    		$reply_num = $comment->innertext;
    	}
    	# 帖子发表日期,从title中匹配出来
    	
    	preg_match_all('#\[([\.\-\d]{3,5})\]#', $title, $res1);
    	$format_date = date('Y').'-'.$res1[1][0];
    	$publish_time = $res1[1][0] ? strtotime($format_date) : 0;
    	
    	//var_dump($publish_time);
    	# 查询是否采集过这个列表页
    	//...
    	
    	try {
    		$stmt = $pdo->prepare("INSERT INTO gongchang_thread (
    				parent_page,data_url,parent_page_id,add_time,title,author,reply_num,publish_time) 
    				VALUES (:parent_page, :data_url, :parent_page_id, :add_time, :title, :author, :reply_num, :publish_time)");
    		$stmt->bindParam(":parent_page", $parent_page);
    		$stmt->bindParam(":data_url", $data_url);
    		$stmt->bindParam(":parent_page_id", $parent_page_id);
    		$stmt->bindParam(":add_time", $time);
    		$stmt->bindParam(":title", $title);
    		$stmt->bindParam(":author", $author);
    		$stmt->bindParam(":reply_num", $reply_num);
    		$stmt->bindParam(":publish_time", $publish_time);
    		$stmt->execute();
    	} catch (PDOException $error) {
    		alert($error->getMessage());
    	}
    	
    }
    //var_dump($thread_lists);
    exit('done!');
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

    if (is_array($thread_urls) && count($thread_urls) > 0) {
        alert("第 $i 列表页主题帖链接获取完成!");
    }

    // 任务提示, 最后1页运行完成时提示
    if ($i == $end_page){
        alert('主题列表采集完成！');
        //$next_step = 'get_img_url';
    }

    $html->clear();
    unset($html);
}








