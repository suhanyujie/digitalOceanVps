<?php if(!defined('HDPHP_PATH'))EXIT;
$db->exe("REPLACE INTO ".$db_prefix."route (`id`,`title`,`route`,`url`)
						VALUES('1','列表页','/^list-(\\d+).html\$/','m=Index&c=Category&a=index&cid=#1')");
$db->exe("REPLACE INTO ".$db_prefix."route (`id`,`title`,`route`,`url`)
						VALUES('2','栏目分页','/^list-(\\d+)-(\\d+).html\$/','m=Index&c=Category&a=index&cid=#1&page=#2')");
$db->exe("REPLACE INTO ".$db_prefix."route (`id`,`title`,`route`,`url`)
						VALUES('3','内容页','/^article-(\\d+)-(\\d+).html\$/','m=Index&c=Content&a=index&cid=#1&aid=#2')");
