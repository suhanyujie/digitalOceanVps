<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>网站地图</title>
    <script type="text/javascript" src="__STATIC__/hdjs/jquery-1.8.2.min.js"></script>
    <css file="__CONTROLLER_VIEW__/css/css.css"/>
</head>
<body>
<div class="box">
    <div class="header">
        <a href="__ROOT__">
            <img src="__CONTROLLER_VIEW__/image/logo.gif"/>
        </a>
    </div>
    <div class="sp-title">
        <h2>网站地图</h2>
        <span class="more">	<a href="http://localhost">返回首页</a></span>
    </div>
    <list from="$data" name="$d">
        <div class="linkbox">
            <h3>
                <a href="<?php echo Url::category($d); ?>">{$d.catname}</a>
            </h3>
            <ul>
                <list from="$d._data" name="$c">
                    <li>
                        <a href="<?php echo Url::category($d); ?>">{$c.catname}</a>
                    </li>
                </list>
            </ul>
        </div>
    </list>
</div>
</body>
</html>