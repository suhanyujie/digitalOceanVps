<?php if ( ! defined("HDPHP_PATH")) {
    exit;
} ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link type="text/css" href="__CONTROLLER_VIEW__/css/css.css"
          rel="stylesheet"/>
    <hdjs/>
    <jsconst/>
</head>
<body>
<div class="step">
    <div class="bg"></div>
    <div class="database">
        <div class="title">HDCMS 安装向导</div>
        <div class="process">
            <ul>
                <li>许可协议</li>
                <li>环境检测</li>
                <li class="current">数据库设定</li>
                <li>生成数据</li>
                <li>安装完成</li>
            </ul>
        </div>
        <!--协议说明-->
        <form onsubmit="return false;" method="post" class="hd-form">
            <div class="check set">
                <h3>数据库配置</h3>
                <table>
                    <tr>
                        <td width="150">数据库主机</td>
                        <td>
                            <input type="text" name="DB_HOST" value="127.0.0.1"
                                   class="w200"/>
                        </td>
                    </tr>
                    <tr>
                        <td>数据库用户</td>
                        <td>
                            <input type="text" name="DB_USER" value="root"
                                   class="w200"/>
                        </td>
                    </tr>
                    <tr>
                        <td>数据库密码</td>
                        <td>
                            <input type="text" name="DB_PASSWORD" value=""
                                   class="w200"/>
                        </td>
                    </tr>
                    <tr>
                        <td>数据表前缀</td>
                        <td>
                            <input type="text" name="DB_PREFIX" value="hd_"
                                   class="w200"/>
                        </td>
                    </tr>
                    <tr>
                        <td>数据库名称</td>
                        <td>
                            <input type="text" name="DB_DATABASE" value="hdcms"
                                   class="w200"/>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="check set">
                <h3>管理员初始密码</h3>
                <table width="100%">
                    <tr>
                        <td width="150">超级管理员</td>
                        <td>
                            <input type="text" name="ADMIN" value="admin"
                                   class="w200"/>
                        </td>
                    </tr>
                    <tr>
                        <td>密　码</td>
                        <td>
                            <input type="password" name="PASSWORD"
                                   class="w200"/>
                        </td>
                    </tr>
                    <tr>
                        <td>确认密码</td>
                        <td>
                            <input type="password" name="C_PASSWORD"
                                   class="w200"/>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="check set">
                <h3>网站设置</h3>
                <table width="100%">
                    <tr>
                        <td width="150">网站名称</td>
                        <td>
                            <input type="text" name="WEBNAME"
                                   value="HDCMS内容管理系统" class="w200"/>
                        </td>
                    </tr>
                    <tr>
                        <td>站长邮箱</td>
                        <td>
                            <input type="text" name="EMAIL" value=""
                                   class="w200"/>
                        </td>
                    </tr>
                </table>
            </div>
            <!--协议说明-->
            <div class="btn">
                <button class="hd-btn" type="button"
                        onclick="location.href='{|U:'environment'}'">上一步
                </button>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button class="hd-btn hd-btn-primary" type="submit">下一步</button>
            </div>
        </form>
    </div>
</div>
<script>
    $('form').validate({
        'DB_HOST': {
            rule: {
                required: true
            },
            error: {
                required: '主机名不能为空'
            }
        },
        'DB_USER': {
            rule: {
                required: true
            },
            error: {
                required: '帐号不能为空'
            }
        },
        'DB_PREFIX': {
            rule: {
                required: true
            },
            error: {
                required: '表前缀不能为空'
            }
        },
        'DB_DATABASE': {
            rule: {
                required: true
            },
            error: {
                required: '数据库名称不能为空'
            }
        },
        'ADMIN': {
            rule: {
                required: true
            },
            error: {
                required: '超级管理员不能为空'
            }
        },
        'PASSWORD': {
            rule: {
                required: true,
                confirm: 'C_PASSWORD'
            },
            error: {
                required: '密码不能为空',
                confirm: '两次密码不一致'
            }
        },
        'WEBNAME': {
            rule: {
                required: true
            },
            error: {
                required: '网站名称不能为空'
            }
        },
        'EMAIL': {
            rule: {
                required: true,
                email: true
            },
            error: {
                required: '站长邮箱不能为空',
                email: '邮箱格式错误'
            }
        }
    })

    $("form").submit(function () {
        //异步验证数据库连接
        $.post(ACTION, $(this).serialize(), function (json) {
            if (json.status == 1) {
                location.href = CONTROLLER + "&a=Complete";
            } else {
                hd_alert({
                    message: json.message,//显示内容
                    timeout: 2
                })
            }
        }, 'json');
        return false;
    })
</script>
</body>
</html>