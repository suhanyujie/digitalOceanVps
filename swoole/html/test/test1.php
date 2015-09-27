<?php
$funcMap=array('methodOne' , 'methodTwo' ,'methodThree' );
$worker_num =3;//�����Ľ�����

for($i=0;$i<$worker_num ; $i++){
    $process = new swoole_process($funcMap[$i]);
    $pid = $process->start();
    sleep(2);
}

 while(1){
            $ret = swoole_process::wait();
            if ($ret){// $ret �Ǹ����� code�ǽ����˳�״̬�룬
                $pid = $ret['pid'];
                var_dump($ret);
                echo PHP_EOL."Worker Exit, PID=" . $pid . PHP_EOL;
            }else{
                break;
            }
}

function methodOne(swoole_process $worker){// ��һ������
    echo $worker->callback .PHP_EOL;
    echo 'methodOne';
}

function methodTwo(swoole_process $worker){// �ڶ�������
    echo $worker->callback .PHP_EOL;
    echo 'methodTwo';
}

function methodThree(swoole_process $worker){// ����������
    echo $worker->callback .PHP_EOL;
    echo 'methodThree';
}

