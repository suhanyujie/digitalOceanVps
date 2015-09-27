<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HDCMS后台登录</title>
    <hdjs/>
    <css file="__CONTROLLER_VIEW__/css/css.css"/>
    <script>
//        $(function () {
//            var error = '{$error}';
//            if (error) {
//                $("div#error_tips").show();
//                $(".err_m").html(error);
//                setTimeout(function () {
//                    $("div#error_tips").hide()
//                }, 511000);
//            }
//        })
        if (window.parent != window) {
            window.parent.location.href = location.href;
        }
    </script>
</head>
<body>
<div class="big">
    <div class="header">
        <div class="links">
            <a href="__WEB__">首页</a> |
            <a href="http://www.houdunwang.com">PHP实战培训</a> |
            <a href="http://www.hdphp.com">HDCMS官网</a>

        </div>
    </div>
    <div class="main">
        <div class="pics">
        </div>
        <div class="login">
            <div class="title">
                后台登录
            </div>
            <div id="tips" class="tips"></div>
            <div class="web_login">
                <div class="login_form">
<!--                    <div id="error_tips">-->
<!--                        <span class="error_logo"></span>-->
<!--                        <span class="err_m"></span>-->
<!--                    </div>-->
                    <form action="" method="post" class="hd-form">
                        <div class="input">
                            <div class="inputOuter">
                                <input type="text" name="username" autofocus='true' placeholder="帐号" required=""/>
                            </div>
                        </div>
                        <div class="input">
                            <div class="inputOuter">
                                <input type="password" name="password" placeholder="密码" required=""/>
                            </div>
                        </div>
                        <div class="input">
                            <div class="inputOuter">
                                <input type="text" name="code" placeholder="验证码" required=""/>
                            </div>
                        </div>

                        <div class="verifyimgArea">
                            <img src="{|U:'code'}" class="code" style="cursor: pointer;float:left;"
                                 onclick="this.src='{|U:'code'}&'+Math.random()"/>
                            <a href="javascript:void(0);" onclick="$('.code').trigger('click')">看不清，换一张</a>
                        </div>
                        <div class="send">
                            <input type="submit" class="btn2" value="登录"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <iframe name="checkLogin" style="display:none;"></iframe>
</div>
</body>
</html>