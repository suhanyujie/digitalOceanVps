# php-timer

php����״̬���湤��
-------------------
ʹ�÷�������  
```php
require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

//��ʼ���������ڴ浥λ
$timer = new \Jenner\Timer(\Jenner\Timer::UNIT_KB);
//��¼a״̬
$timer->mark('a');
sleep(2);
//��¼b״̬
$timer->mark('b');
sleep(3);
//��¼c״̬
$timer->mark('c');
sleep(4);
//��¼d״̬
$timer->mark('d');
//��ӡ���屨�棨��������ֵ��
$timer->printReport();
//��ȡ���屨�棬��������
$report = $timer->getReport();
//��ȡһ��mark�ı���
$a_report = $timer->getReport('a');
print_r($a_report);
//��ӡa״̬��b״̬�Ĳ�����Ϣ����������ʱ�䡢ʹ���ڴ��
$timer->printDiffReportByStartAndEnd('a', 'b');
//��ȡa״̬��b״̬�Ĳ��챨��
$ab_diff_report = $timer->getDiffReportByStartAndEnd('a', 'b');
//��ӡ��һ��mark�����һ��mark֮��Ĳ�����Ϣ
$timer->printDiffReport();
//��ȡ��һ��mark�����һ��mark֮��Ĳ�����Ϣ
$diff_report = $timer->getDiffReport();
```

����������  
```shell
------------------------------------------
mark:a
time:1437535424.9998s
memory_real:1280KB
memory_emalloc:833.046875KB
memory_peak_real:1280KB
memory_peak_emalloc:843.2890625KB
------------------------------------------
mark:b
time:1437535427s
memory_real:1280KB
memory_emalloc:834.2265625KB
memory_peak_real:1280KB
memory_peak_emalloc:843.2890625KB
------------------------------------------
mark:c
time:1437535430.0002s
memory_real:1280KB
memory_emalloc:835.1875KB
memory_peak_real:1280KB
memory_peak_emalloc:843.2890625KB
------------------------------------------
mark:d
time:1437535434.0004s
memory_real:1280KB
memory_emalloc:836.1484375KB
memory_peak_real:1280KB
memory_peak_emalloc:843.2890625KB
Array
(
    [time] => 1437535424.9998
    [memory_real] => 1310720
    [memory_emalloc] => 853040
    [memory_peak_real] => 1310720
    [memory_peak_emalloc] => 863528
)
------------------------------------------
mark:[diff] start_mark:a end_mark:b
time:2.0001850128174s
memory_real:0KB
memory_emalloc:1.1796875KB
memory_peak_real:0KB
memory_peak_emalloc:0KB
------------------------------------------
mark:[total diff]
time:9.0006000995636s
memory_real:0KB
memory_emalloc:3.1015625KB
memory_peak_real:0KB
memory_peak_emalloc:0KB
```