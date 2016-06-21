<?php
date_default_timezone_set('Asia/Shanghai');
phpinfo();

header('Content-type:text/html;charset=utf-8');

$classifyInfo=array(
		'name'=>'aa',
		'children'=>array(
				'name'=>'aaa',
		),
);
foreach($classifyInfo as $k=>$v){
	if(isset($v['pro']) && !empty($v['pro'])){
		echo 'b';
	}
}

exit;


