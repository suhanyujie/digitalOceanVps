<include file="__PUBLIC__/header"/>
<body>
<div class="hd-title-header">个人资料修改</div>
<form onsubmit="return hd_submit(this,'__ACTION__','__ACTION__')">
    <table class="hd-table hd-table-form hd-form">
        <tr>
            <th class="hd-w100">管理员名称</th>
            <td>
                {$user.username}
            </td>
        </tr>
        <tr>
            <th class="hd-w100">最后登录时间</th>
            <td>
                {$user.logintime|date:"Y-m-d",@@}
            </td>
        </tr>
        <tr>
            <th class="hd-w100">最后登录IP</th>
            <td>
                {$user.lastip}
            </td>
        </tr>
        <tr>
            <th class="hd-w100">昵称</th>
            <td>
                <input type="text" name="nickname" class="hd-w200" value="{$user.nickname}"/>
            </td>
        </tr>
        <tr>
            <th class="w100">邮箱</th>
            <td>
                <input type="text" name="email" class="hd-w200" value="{$user.email}"/>
            </td>
        </tr>
    </table>
    <input type="submit" class="hd-btn" value="确定"/>
</form>
</div>
</body>
</html>