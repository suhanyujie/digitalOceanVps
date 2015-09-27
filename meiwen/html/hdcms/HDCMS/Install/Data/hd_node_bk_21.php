<?php if(!defined('HDPHP_PATH'))EXIT;
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('1','内容','','Admin','','','','','1','2','0','2','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('2','内容管理','','Admin','','','','','1','1','1','10','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('3','系统','','Admin','','','','','1','1','0','10','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('4','后台菜单管理','','Admin','Node','index','','','1','1','87','100','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('8','栏目管理','','Admin','Category','index','','','1','1','2','20','0','1')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('9','模型管理','','Admin','Model','index','','','1','1','37','100','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('10','推荐位','','Admin','Flag','index','mid=1','','1','1','37','100','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('11','基本配置','','Admin','','','','','1','1','3','98','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('12','文章列表','','Admin','Content','index','','','1','1','2','10','0','1')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('13','管理员设置','','Admin','','','','','1','1','3','100','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('14','管理员管理','','Admin','Administrator','index','','','1','1','13','100','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('15','角色管理','','Admin','Role','index','','','1','1','13','100','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('16','网站配置','','Admin','Config','webConfig','','','1','1','11','100','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('17','生成静态','','Admin','','','','','1','1','1','11','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('18','更新栏目页','','Admin','Html','createCategory','','生成栏目页','1','1','17','102','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('19','生成首页','','Admin','Html','createIndex','','生成首页','1','1','17','101','0','1')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('20','更新内容页','','Admin','Html','createContent','','生成内容页','1','1','17','103','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('21','修改密码','','Admin','MyPassword','edit','','','1','2','24','100','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('22','修改个人信息','','Admin','MyInfo','edit','','','1','2','24','100','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('23','我的面板','','Admin','','','','','1','2','0','100','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('24','个人信息','','Admin','','','','','1','2','23','100','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('26','会员','','Admin','','','','','1','1','0','100','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('27','会员管理','','Admin','','','','','1','1','26','100','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('28','会员管理','','Admin','User','index','','','1','1','27','100','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('29','审核会员','','Admin','UserAudit','index','','','1','1','27','100','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('30','会员组管理','','Admin','','','','','1','1','26','100','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('31','管理会员组','','Admin','Group','index','','','1','1','30','100','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('32','模板','','Admin','','','','','1','1','0','100','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('33','模板管理','','Admin','','','','','1','1','32','100','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('34','模板风格','','Admin','WebStyle','styleList','','','1','1','33','90','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('35','标签云','','Admin','Tag','index','','','1','1','37','100','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('37','其他操作','','Admin','','','','','1','1','1','100','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('59','附件管理','','Admin','Attachment','index','','','1','1','37','100','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('39','扩展','','Admin','','','','','1','1','0','1000','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('40','插件管理','','Admin','','','','','1','1','39','99','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('41','插件管理','','Admin','Addons','index','','','1','1','40','100','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('42','审核文章','','Admin','ContentAudit','content','mid=1','','1','1','2','11','0','1')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('49','钓子管理','','Admin','Hooks','index','','','1','1','40','100','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('44','添加栏目','','Admin','Category','add','','','0','1','2','21','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('45','删除栏目','','Admin','Category','del','','','0','1','2','22','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('46','修改栏目','','Admin','Category','edit','','','0','1','2','23','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('47','批量修改栏目','','Admin','Category','BulkEdit','','','0','1','2','24','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('68','水印设置','','Admin','Water','water','','','1','1','86','90','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('50','已装插件','','Admin','','','','','1','1','39','100','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('168','数据备份','Addons','Backup','Admin','index','','插件Backup后台管理','1','1','50','100','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('69','邮箱配置','','Admin','Email','email','','','1','1','86','90','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('86','扩展配置','','Admin','','','','','1','1','3','98','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('87','后台菜单管理','','Admin','','','','','1','1','3','98','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('112','配置组','','Admin','ConfigGroup','index','','配置组管理','1','1','11','110','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('191','评论','Addons','Comment','Admin','index','','插件Comment后台管理','1','1','50','100','0','0')");
$db->exe("REPLACE INTO ".$db_prefix."node (`nid`,`title`,`group`,`module`,`controller`,`action`,`param`,`comment`,`is_show`,`type`,`pid`,`list_order`,`is_system`,`favorite`)
						VALUES('193','路由设置','','Admin','Route','index','','','1','1','11','100','0','0')");
