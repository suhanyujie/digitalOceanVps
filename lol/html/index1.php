<?php
echo '
焦宝京(导师：张旭勇) 2015-06-10 16:36:56
774931768
焦宝京(导师：张旭勇) 2015-06-10 16:36:59
bestruiwen.na
';
$obj = new pdo_connect_pool('mysql:host=127.0.0.1;dbname=eight8hao',"root","6852432");
var_dump($obj);

$stmt = $obj->query("show tables");
$data = $stmt->fetchAll();

var_dump($data);

$obj->release();


