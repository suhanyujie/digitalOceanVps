<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache"/>
    <title>密码已发送至邮箱...</title>
    <css file="__CONTROLLER_VIEW__/css/login.css"/>
</head>
<body>
<div class="left">
    <div class="icon">
        <img src="__CONTROLLER_VIEW__/image/qr.png" alt="HDCMS"/>

        <p>微信：后盾网<br/>QQ群：1728288289</p>
    </div>
</div>
<div class="right">
    <div class="logo">
        <a href="http://www.hdphp.com">
            <img src="__CONTROLLER_VIEW__/image/logo_reg.png" alt="HDCMS"/>
        </a>
        <p class="">
            密码已发送到您的邮箱 {$email}<br/>
        </p>
    </div>
    <div class="form">
        <div class="reg">
           <a href="{|U:'Login/login'}">重新登录</a> |
            <a href="__ROOT__">返回首页</a>
        </div>
    </div>
    <div class="copyright" style="position: fixed;bottom: 0px;">
        Copyright © 2013 - 2014 HDCMS All Right Reserved.
    </div>
</div>
</body>
</html>