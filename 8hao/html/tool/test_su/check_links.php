<?php 
require '/www/8hao/html/tool/test_su/Http.php';

$url1 = 'http://pad.zol.com.cn/slide/531/5310254_1.html#p=1';// 组图
//$url1 = 'http://ask.zol.com.cn/cell_phone/';
//$url1 = 'http://news.zol.com.cn/';
//$res1 = get_headers($url1);
//$res1 = curlHttpCode(array('url'=>$url1));
//var_dump($res1);exit('58_1');

$url1 = 'http://www.zol.com.cn/';
$paramArr = array(
		'url'       => $url1, #要请求的URL数组
		'timeout'   => 5,#超时时间 s
		'recErrLog' => 0,#是否记录错误日志
		'reConnect' => 0,#是否出错后重连
		'keepAlive' => 0,#是否执行保持长链接的处理
);
$htmlCode = API_Http::curlPage($paramArr);
$pattern = '@<a href=\"([^#\"\']*?)">.*?<\/a>@';
preg_match_all($pattern, $htmlCode, $res1);
if($res1){
	# 将非200的链接放到这个数组中
	$badData = array();
	foreach($res1[1] as $k1=>$v1){
		if($k1 > 200) break;
		$httpCode = curlHttpCode(array('url'=>$v1));
		if($httpCode != 200 || $httpCode != 0){
			$badData[] = $res1[0][$k1];
		}
	}
}

var_dump($badData);exit();

$httpCode = curlHttpCode(array('url'=>$url1));

var_dump($httpCode);exit('66_1');












/******************************以下是用到的一些函数******************************/
/**
 * 发送curl请求
 */
function curlHttpCode($paramArr){
	if (is_array($paramArr)) {
		$options = array(
				'url'      => false, #要请求的URL数组
				'timeout'  => 6,	 #超时时间 s    10
		);
		$options = array_merge($options, $paramArr);
		extract($options);
	}
	$timeout = (int)$timeout;
	if(0 == $timeout || empty($url))return false;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);// 0
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // true
	curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,0); // 1   by suhy
	$data = curl_exec($ch);
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);

	return (int)$http_code;
}


