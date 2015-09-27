<include file="__PUBLIC__/header"/>
<body>
<div class="hd-menu-list">
    <ul>
        <li><a href="{|U:'index'}">会员列表</a></li>
        <li class="active"><a href="javascript:;">添加会员</a></li>
    </ul>
</div>
<div class="hd-title-header">添加会员</div>
<form onsubmit="return hd_submit(this,'__ACTION__','{|U:index}')">
    <table class="hd-table hd-table-form hd-form">
        <tr>
            <th class="hd-w100">用户名 <span class="star">*</span></th>
            <td>
                <input type="text" name="username" class="hd-w300" required=""/>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">会员组</th>
            <td>
                <select name="rid">
                    <list from="$role" name="$r">
                        <option value="{$r.rid}">{$r.rname}</option>
                    </list>
                </select>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">密码 <span class="star">*</span></th>
            <td>
                <input type="password" name="password" class="hd-w300" required=""/>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">确认密码 <span class="star">*</span></th>
            <td>
                <input type="password" name="password_c" class="hd-w300" required=""/>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">邮箱</th>
            <td>
                <input type="text" name="email" class="hd-w300"/>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">QQ</th>
            <td>
                <input type="text" name="qq" class="hd-w300"/>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">积分</th>
            <td>
                <input type="text" name="credits" class="hd-w300" value="{$hd.config.INIT_CREDITS}" required=""/>
            </td>
        </tr>
    </table>
    <input type="submit" value="确定" class="hd-btn"/>
</form>
</body>
</html>