<?php
# 调试模式
ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);


echo  '<script>alert("事实上，你不应该访问这个文件的。。。  （8号公馆台球室~）");</script>';
echo date('Y-m-d H:i:s',time());
echo time();
phpinfo();



