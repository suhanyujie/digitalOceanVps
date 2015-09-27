<include file="__PUBLIC__/header"/>
<body>
<div class="hd-title-header">修改密码</div>
<form onsubmit="return hd_submit(this,'__ACTION__','__ACTION__')" class="hd-form">
    <table class="hd-table hd-table-form hd-form">
        <tr>
            <th class="hd-w100">管理员名称</th>
            <td>
                {$user.username}
            </td>
        </tr>
        <tr>
            <th class="hd-w100">旧密码 <span class="star">*</span></th>
            <td>
                <input type="password" name="old_password" class="hd-w200" required=""/>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">新密码 <span class="star">*</span></th>
            <td>
                <input type="password" name="password" class="hd-w200" required=""/>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">确认密码 <span class="star">*</span></th>
            <td>
                <input type="password" name="passwordc" class="hd-w200" required=""/>
            </td>
        </tr>
    </table>
    <input type="submit" class="hd-btn" value="确定"/>
</form>
</body>
</html>