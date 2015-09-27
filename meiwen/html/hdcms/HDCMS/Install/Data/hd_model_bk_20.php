<?php if(!defined('HDPHP_PATH'))EXIT;
$db->exe("REPLACE INTO ".$db_prefix."model (`mid`,`model_name`,`table_name`,`enable`,`model_description`,`is_system`,`contribute`)
						VALUES('1','普通文章','content','1','普通文章','1','1')");
$db->exe("REPLACE INTO ".$db_prefix."model (`mid`,`model_name`,`table_name`,`enable`,`model_description`,`is_system`,`contribute`)
						VALUES('2','下载模型','download','1','下载模型','1','0')");
$db->exe("REPLACE INTO ".$db_prefix."model (`mid`,`model_name`,`table_name`,`enable`,`model_description`,`is_system`,`contribute`)
						VALUES('3','图片模型','picture','1','图片模型','1','0')");
