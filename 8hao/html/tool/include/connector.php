<?php
# 调试模式
ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);

require('/www/8hao/html/tool/include/Db.class.php');


define('DB_USERNAME','root');
define('DB_PASSWORD','6852432');


class DB_Document extends Db {
    private $ServerName     = "localhost";
    private $DBName 		= "eight8hao";
    private $UserName     	= DB_USERNAME;
    private $Password 		= DB_PASSWORD;
}

$arti = new DB_Document;

//$res = $arti->select('desc article_article');









