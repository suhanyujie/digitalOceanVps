<?php if(!defined('HDPHP_PATH'))EXIT;
$db->exe("REPLACE INTO ".$db_prefix."addons (`id`,`name`,`title`,`description`,`status`,`config`,`author`,`version`,`create_time`,`has_adminlist`)
						VALUES('265','Backup','数据备份','数据备份还原插件','1','a:0:{}','后盾网向军','1.0','1417657359','1')");
$db->exe("REPLACE INTO ".$db_prefix."addons (`id`,`name`,`title`,`description`,`status`,`config`,`author`,`version`,`create_time`,`has_adminlist`)
						VALUES('290','Comment','评论','网站评论插件','1','a:1:{s:10:\"REPLY_TIME\";s:1:\"0\";}','后盾网向军','1.0','1418731991','1')");
$db->exe("REPLACE INTO ".$db_prefix."addons (`id`,`name`,`title`,`description`,`status`,`config`,`author`,`version`,`create_time`,`has_adminlist`)
						VALUES('292','Search','前台搜索','前台搜索','1','a:0:{}','后盾网向军','1.0','1418887777','0')");
$db->exe("REPLACE INTO ".$db_prefix."addons (`id`,`name`,`title`,`description`,`status`,`config`,`author`,`version`,`create_time`,`has_adminlist`)
						VALUES('293','Sitemap','网站地图','网站地图','1','a:0:{}','后盾网向军','1.0','1418887782','0')");
