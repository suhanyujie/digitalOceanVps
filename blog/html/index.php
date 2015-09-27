<?php
#echo date();
echo 'suhy20150530';
$url = 'http://www.facebook.com';
$str = file_get_contents($url);
echo $str;
#echo '<iframe src="'.$url.'"></iframe>';

