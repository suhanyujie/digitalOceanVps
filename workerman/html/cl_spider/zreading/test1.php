<?php 
require('/www/html/workerman/html/cl_spider/zreading/vendor/autoload.php');
use QL\QueryList;
#use Slim\PDO\Database;
use Slim\PDO\MyPDO;


#$hj = QueryList::Query('http://mobile.csdn.net/',array("title"=>array('.unit h1','text')));
#print_r($hj->data);
$dsn = 'localhost';
$usr = 'root';
$pwd = '685';
$pdo = \Slim\PDO\MyPDO::getInstance($dsn,$usr,$pwd.'2432','spider','utf-8');


var_dump($pdo->query('select * from content limit 1'));
exit();

# SELECT
$selectStatement = $pdo->select()
					->from('users')
					->limit(1);
# INSERT
$insertStatement = $slimPdo->insert(array('id', 'usr', 'pwd'))
						->into('users')
						->values(array(1234, 'your_username', 'your_password'));
						
$insertId = $insertStatement->execute(false);
# UPDATE
// UPDATE users SET usr = ? , pwd = ? WHERE id = ?
$updateStatement = $slimPdo->update(array('usr' => 'your_new_username'))
							->set(array('pwd' => 'your_new_password'))
							->table('users')
							->where('id', '=', 1234);
# DELETE
$deleteStatement = $slimPdo->delete()
						->from('users')
						->where('id', '=', 1234);

$affectedRows = $deleteStatement->execute();





$stmt = $selectStatement->execute();
$data = $stmt->fetch();
var_dump($data);


echo 123;



