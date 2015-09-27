<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache"/>
    <title>登录</title>
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
            简单而强大的内容管理系统<br/>
            开源、安全值得信赖！
        </p>
    </div>
    <div class="form">
        <div class="reg">
            已有帐号？ <a href="{|U:'login'}">立即登录</a>
        </div>
        <form method="post">
            <div class="input">
                <input type="text" name="username" placeholder="帐号" required=""/>
            </div>
            <div class="input">
                <input type="text" name="nickname" placeholder="昵称" required=""/>
            </div>
            <div class="input">
                <input type="password" name="password" placeholder="密码" required=""/>
            </div>
            <div class="input">
                <input type="password" name="passwordc" placeholder="确认密码" required=""/>
            </div>
            <div class="input">
                <input type="email" name="email" placeholder="邮箱( 请填写有效邮箱地址，以便收取账号激活邮件 )" required=""/>
            </div>
            <div class="input">
                <input type="submit" value="注册"/>
            </div>
        </form>
    </div>
    <div class="copyright">
        Copyright © 2013 - 2014 HDCMS All Right Reserved.
    </div>
</div>
</body>
</html>