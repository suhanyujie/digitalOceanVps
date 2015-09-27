<?php if(!defined('HDPHP_PATH'))EXIT;
$db->exe("REPLACE INTO ".$db_prefix."user (`uid`,`nickname`,`username`,`password`,`code`,`email`,`regtime`,`logintime`,`regip`,`lastip`,`user_status`,`lock_end_time`,`qq`,`sex`,`credits`,`rid`,`signature`,`spec_num`,`icon`)
						VALUES('1','admin','admin','96be3a97b43f0499ba83923ec435de33','fb866d1817','2300071698@qq.com','1418747710','1417190096','0.0.0.0','0.0.0.0','1','0','2300071698','1','10000','1','后盾网 人人做后盾','140','')");
