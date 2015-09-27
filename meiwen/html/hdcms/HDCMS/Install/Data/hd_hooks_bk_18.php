<?php if(!defined('HDPHP_PATH'))EXIT;
$db->exe("REPLACE INTO ".$db_prefix."hooks (`id`,`name`,`description`,`type`,`update_time`,`addons`,`status`,`is_system`)
						VALUES('1','APP_BEGIN','应用开始','1','0','','1','1')");
$db->exe("REPLACE INTO ".$db_prefix."hooks (`id`,`name`,`description`,`type`,`update_time`,`addons`,`status`,`is_system`)
						VALUES('2','PAGE_HEADER','页面头部钩子，一般用于加载插件JS文件和JS代码','1','0','','1','1')");
$db->exe("REPLACE INTO ".$db_prefix."hooks (`id`,`name`,`description`,`type`,`update_time`,`addons`,`status`,`is_system`)
						VALUES('3','PAGE_FOOTER','页面底部r钩子，一般用于加载插件CSS文件和代码','1','0','','1','1')");
$db->exe("REPLACE INTO ".$db_prefix."hooks (`id`,`name`,`description`,`type`,`update_time`,`addons`,`status`,`is_system`)
						VALUES('4','CONTENT_EDIT_BEGIN','内容编辑前','1','0','','1','1')");
$db->exe("REPLACE INTO ".$db_prefix."hooks (`id`,`name`,`description`,`type`,`update_time`,`addons`,`status`,`is_system`)
						VALUES('5','CONTENT_EDIT_END','内容编辑后','1','0','','1','1')");
$db->exe("REPLACE INTO ".$db_prefix."hooks (`id`,`name`,`description`,`type`,`update_time`,`addons`,`status`,`is_system`)
						VALUES('6','CONTENT_DEL','内容删除后','1','0','','1','1')");
$db->exe("REPLACE INTO ".$db_prefix."hooks (`id`,`name`,`description`,`type`,`update_time`,`addons`,`status`,`is_system`)
						VALUES('7','CONTENT_ADD_BEGIN','内容添加前','1','0','','1','1')");
$db->exe("REPLACE INTO ".$db_prefix."hooks (`id`,`name`,`description`,`type`,`update_time`,`addons`,`status`,`is_system`)
						VALUES('8','CONTENT_ADD_END','内容添加后','1','0','','1','1')");
$db->exe("REPLACE INTO ".$db_prefix."hooks (`id`,`name`,`description`,`type`,`update_time`,`addons`,`status`,`is_system`)
						VALUES('10','ADMIN_LOGIN_START','后台登录开始','1','0','','1','1')");
$db->exe("REPLACE INTO ".$db_prefix."hooks (`id`,`name`,`description`,`type`,`update_time`,`addons`,`status`,`is_system`)
						VALUES('11','ADMIN_LOGIN_SUCCESS','后台登录成功','1','0','','1','1')");
$db->exe("REPLACE INTO ".$db_prefix."hooks (`id`,`name`,`description`,`type`,`update_time`,`addons`,`status`,`is_system`)
						VALUES('9','CONTENT_SHOW','内容显示','1','0','','1','1')");
