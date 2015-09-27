<?php if(!defined('HDPHP_PATH'))EXIT;
$db->exe("REPLACE INTO ".$db_prefix."config_group (`cgid`,`cgname`,`cgtitle`,`cgorder`,`isshow`,`system`)
						VALUES('1','site','站点配置','100','1','1')");
$db->exe("REPLACE INTO ".$db_prefix."config_group (`cgid`,`cgname`,`cgtitle`,`cgorder`,`isshow`,`system`)
						VALUES('2','upload','上传配置','100','1','1')");
$db->exe("REPLACE INTO ".$db_prefix."config_group (`cgid`,`cgname`,`cgtitle`,`cgorder`,`isshow`,`system`)
						VALUES('3','member','会员配置','100','1','1')");
$db->exe("REPLACE INTO ".$db_prefix."config_group (`cgid`,`cgname`,`cgtitle`,`cgorder`,`isshow`,`system`)
						VALUES('4','email','邮箱设置','100','0','1')");
$db->exe("REPLACE INTO ".$db_prefix."config_group (`cgid`,`cgname`,`cgtitle`,`cgorder`,`isshow`,`system`)
						VALUES('5','water','水印设置','100','0','1')");
$db->exe("REPLACE INTO ".$db_prefix."config_group (`cgid`,`cgname`,`cgtitle`,`cgorder`,`isshow`,`system`)
						VALUES('6','content','内容相关','100','1','1')");
$db->exe("REPLACE INTO ".$db_prefix."config_group (`cgid`,`cgname`,`cgtitle`,`cgorder`,`isshow`,`system`)
						VALUES('7','optimize','性能优化','100','1','1')");
$db->exe("REPLACE INTO ".$db_prefix."config_group (`cgid`,`cgname`,`cgtitle`,`cgorder`,`isshow`,`system`)
						VALUES('8','rewrite','伪静态','100','1','1')");
$db->exe("REPLACE INTO ".$db_prefix."config_group (`cgid`,`cgname`,`cgtitle`,`cgorder`,`isshow`,`system`)
						VALUES('9','template','模板设置','100','0','1')");
