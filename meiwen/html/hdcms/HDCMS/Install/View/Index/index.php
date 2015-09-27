<?php if (!defined("HDPHP_PATH")) exit; ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{$hd.config.HDCMS_NAME}</title>
    <link type="text/css" href="__CONTROLLER_VIEW__/css/css.css" rel="stylesheet"/>
    <hdjs/>
</head>
<body>
    <div class="step">
        <div class="index">
            <h1>
                {$hd.config.HDCMS_NAME} {$hd.config.HDCMS_VERSION}
            </h1>
            <p>
                百分百免费，无论任何网站都可以免费使用
            </p>
            <div class="btn">
                <button class="hd-btn hd-btn-primary" onclick="location.href='{|U:'copyright'}'">开始安装</button>
            </div>
        </div>
        <div class="bg"></div>
    </div>
</body>
</html>