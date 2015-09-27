<?php if (!defined("HDPHP_PATH")) exit; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{$hd.config.HDCMS_NAME}</title>
    <link type="text/css" href="__CONTROLLER_VIEW__/css/css.css" rel="stylesheet"/>
    <hdjs/>
</head>
<body>
<div class="step">
    <div class="bg"></div>
    <div class="environment">

        <div class="title">HDCMS 安装向导</div>
        <div class="process">
            <ul>
                <li>许可协议</li>
                <li class="current">环境检测</li>
                <li>数据库设定</li>
                <li>生成数据</li>
                <li>安装完成</li>
            </ul>
        </div>
        <!--协议说明-->
        <div class="install">
            <div class="check set">
                <table width="100%">
                    <tr>
                        <th class="w250">环境检测</th>
                        <th>当前状态</th>
                    </tr>
                    <tr>
                        <td>服务器域名</td>
                        <td>{$hd.server.HTTP_HOST}</td>
                    </tr>
                    <tr>
                        <td>服务器解译引擎</td>
                        <td>{$hd.server.SERVER_SOFTWARE}</td>
                    </tr>
                    <tr>
                        <td>PHP版本</td>
                        <td>{$hd.const.PHP_VERSION}</td>
                    </tr>
                    <tr>
                        <td>系统安装目录</td>
                        <td>{$hd.const.ROOT_PATH}</td>
                    </tr>
                    </tr>
                </table>
            </div>

            <div class="check set">
                <table>
                    <tr>
                        <th class="w250">需开启的变量或函数</th>
                        <th class="w80">当前状态</th>
                        <th>说明</th>
                    </tr>
                    <tr>
                        <td>safe_mode</td>
                        <td>{$safe}</td>
                        <td> <span class="desc">
                        本系统不支持在非win主机的安全模式下运行
                    </span></td>
                    </tr>
                    <tr>
                        <td>GD 库</td>
                        <td>{$gd}</td>
                        <td> <span class="desc">
                        不支持将导致与图片相关的功能无法使用
                    </span></td>
                    </tr>
                    <tr>
                        <td>CURL库</td>
                        <td>{$curl}</td>
                        <td> <span class="desc">
                        不符合要求将导致采集、远程资料本地化等功能无法使用
                    </span></td>
                    </tr>
                    <tr>
                        <td>MySQLI扩展</td>
                        <td>{$mysqli}</td>
                        <td> <span class="desc">
                        不支持将无法使用本系统
                    </span></td>
                    </tr>
                    <tr>
                        <td>mb_substr</td>
                        <td>{$mb_substr}</td>
                        <td> <span class="desc">
                        不支持将导致中文字符处理出现问题
                    </span></td>
                    </tr>
                </table>
            </div>
            <div class="check set">
                <table>
                    <tr>
                        <th class="w250">目录、文件权限检查</th>
                        <th class="w100">写入</th>
                        <th>读取</th>
                    </tr>
                    <?php foreach ($dirctory as $d): ?>
                        <tr>
                            <td><?php echo $d; ?></td>
                            <td><?php echo is_writable($d) ? '<span class="hd-validate-success">可写</span>' : '<span class="hd-validate-error">不可写</span>'; ?>
                            <td><?php echo is_readable($d) ? '<span class="hd-validate-success">可读</span>' : '<span class="hd-validate-error">不可读</span>'; ?></td>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </table>
            </div>
        </div>
        <!--协议说明-->
        <div class="btn">
            <button class="hd-btn" onclick="location.href='{|U:'copyright'}'">上一步</button>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button class="hd-btn hd-btn-primary" onclick="check();">下一步</button>
        </div>
    </div>
</div>
<script>
    function check() {
        if ($(".hd-validate-error").length > 0) {
            alert("您的系统环境不可以安装HDCMS");
            return false;
        } else {
            location.href = "{|U:'database'}";
        }
    }
</script>
</body>
</html>