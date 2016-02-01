<?php  
function dbcp_query($sql){  
    $link=new swoole_client(SWOOLE_SOCK_TCP,SWOOLE_SOCK_SYNC);//TCP方式、同步  
    $link->connect('127.0.0.1',55151);//连接  
    $link->send($sql);//执行查询  
    die(var_dump($link->recv()));  
    return unserialize($link->recv()); //这行会报错，注释掉了：PHP Notice:  unserialize(): Error at offset 0 of 292 bytes in /data/htdocs/mysql.swoole.com/mysqlSwooleCli.php on line 6  
    //swoole_client类析构时会自动关闭连接  
}


$sql="SELECT * FROM `content` limit 1";  
$dbRetArr = dbcp_query($sql);  
var_dump($dbRetArr);




