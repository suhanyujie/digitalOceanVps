<?php
// test

/*
// task worker，使用Text协议
$task_worker = new Worker('Text://0.0.0.0:12345');
// task进程数可以根据需要多开一些
$task_worker->count = 100;
$task_worker->name = 'testTaskWorker';
$task_worker->onMessage = function($connection, $task_data) {
    // 假设发来的是json数据
    $task_data = json_decode($task_data, true);
    // 根据task_data处理相应的任务逻辑.... 得到结果，这里省略....
    $task_result =
    // 发送结果
    $connection->send(json_encode($task_result));
};
Worker::runAll();

*/