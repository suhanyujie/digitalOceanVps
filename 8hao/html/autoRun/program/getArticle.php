<?php
/**
 *  采集互联网上的文章，用于学习和交流
 * @author suhanyu<suhanyujie@qq.com>
 */
define('PHP_QUERY', '/www/8hao/html/tool/QueryList/');
include(PHP_QUERY.'QueryList.class.php');
require(PHP_QUERY.'../include/connector.php');


 //获取左岸的文章列表标题
$url = 'http://www.zreading.cn/';



$hj = QueryList::Query($url,array("title"=>array('#content .entry-name a','text'),
									"url"=>array('#content .entry-name','text','a','getUrl'),
									'tag'=>array('#content .entry-meta','html','a'),
									'category'=>array('#content .entry-meta','html','a','getCategory'),
									
									));

$nowDate = time();
if($hj->jsonArr){
	foreach($hj->jsonArr as $key=>$value){
		$data = array();
		$data['sourceId'] = get_article_id($value['url']);
		# 如果存在，则不执行添加操作
		$res1 = $arti->select('select "X" from uctoo_article_article where sourceId='.$data['sourceId']);
		if($res1) continue;
		$data['title'] = $value['title'];
		$data['source'] = $value['url'];
		$data['sourceType'] = 2;// 2表示来源是互联网
		$data['classId'] = 3; // 3表示左岸频道
		$data['category'] = 1; // 1表示创造之路
		$data['isPublish'] = 1;
		$data['publishTime'] = $nowDate;
		$data['changeTime'] = $nowDate;				
		$data['createTime'] = $nowDate;		
		$data['isDel'] = 0;
		
		$con_hj = QueryList::Query($value['url'],array(
									"content"=>array('#content .entry-content','html','-div'),
								));
		$docId = $arti->insertData('uctoo_article_article',$data);
		if($docId > 0){
			$data2 = array();
			$data2['docId'] = $docId;
			$data2['content'] = $con_hj->jsonArr[0]['content'];
			# 如果存在，则不执行添加操作
			$res1 = $arti->select('select "X" from uctoo_article_content_1 where docId='.$docId);
			if($res1) continue;
			$arti->insertData('uctoo_article_content_1',$data2);
		}
		
	}
}

print_r($hj->jsonArr);

/************************以下是要用到的一些函数****************************************/

/**
 * 从标题的a链接中获取该文章的链接
 * @param string $content 传过来的a标签包含href等属性的整个内容
 */
function getUrl($content,$key){
	if(!$content) return false;
	$pattern = '@href="(.*?)"@';
	preg_match_all($pattern, $content,$res1);
	
	return $res1[1][0];
}

/**
 * 获取左岸文章的分类名称
 * @param string $content 整个页面的内容
 */
 function getCategory($content,$key){
 	if(!$content) return false;
	$pattern = '@分类：([^|]*)@';
	preg_match_all($pattern,$content,$res);
	
	return $res[1][0];
 }

/**
 * 根据含有文章id的url中匹配出文章的id
 * @param string $url 文章的url。 例如：http://www.zreading.cn/archives/4934.html
 */
function get_article_id($url){
 	if(!$url){ return false; }
	$pattern = '@(\d+\.)@';
	preg_match_all($pattern,$url,$res);
	
	return (int)$res[1][0];
}



