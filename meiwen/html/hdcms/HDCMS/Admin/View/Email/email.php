<include file="__PUBLIC__/header"/>
<body>
<div class="hd-title-header">温馨提示</div>
<div class="help">
    <ul>
        <li>设置邮箱后，请检测发送是否成功</li>
    </ul>
</div>
<form class="hd-form" onsubmit="return hd_submit(this,'__URL__','__URL__')">
    <table class="hd-table hd-table-form">
        <thead>
        <tr>
            <td class="hd-w200">标题</td>
            <td>配置
            </th>
            <td class="hd-w300">变量</td>
            <td class="hd-w300">描述</td>
        </tr>
        </thead>
        <foreach from="$config" key="$key" value="$val">
            <tr>
                <td>{$val.title}</td>
                <td>
                    <input type="{$val.show_type}" name="{$val.name}" value="{$val.value}" class="hd-w250"/>
                </td>
                <td>{$val.name}</td>
                <td>{$val.message}</td>
            </tr>
        </foreach>
    </table>
    <input type="submit" class="hd-btn" value="确定"/>
    <button class="hd-btn hd-btn-danger hd-btn-sm" type="button" onclick="checkEmail();">发邮件测试</button>
</form>
<script type="text/javascript" charset="utf-8">
    //发邮件测试
    function checkEmail() {
        $.post("{|U:'checkEmail'}", $('form').serialize(), function (json) {
            hd_alert({
                message: json.message,//显示内容
                timeout: 3
            })
        }, 'json');
    }
</script>
</body>
</html>