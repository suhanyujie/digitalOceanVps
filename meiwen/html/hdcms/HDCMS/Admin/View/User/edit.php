<include file="__PUBLIC__/header"/>
<body>
<js file="__STATIC__/cal/lhgcalendar.min.js"/>
<div class="hd-menu-list">
    <ul>
        <li><a href="{|U:'index'}">会员列表</a></li>
        <li class="active"><a href="javascript:;">修改会员</a></li>
    </ul>
</div>
<div class="hd-title-header">添加会员组</div>
<form onsubmit="return hd_submit(this,'__ACTION__','{|U:index}')">
    <input type="hidden" name="uid" value="{$field.uid}"/>
    <table class="hd-table hd-table-form hd-form">
        <tr>
            <th class="hd-w100">用户名</th>
            <td>
                {$field.username}
            </td>
        </tr>
        <tr>
            <th class="hd-w100">会员组</th>
            <td>
                <select name="rid">
                    <list from="$role" name="$r">
                        <option value="{$r.rid}"
                        <if value="$field.rid eq $r.rid">selected=""</if>
                        >{$r.rname}</option>
                    </list>
                </select>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">昵称</th>
            <td>
                <input type="text" name="nickname" value="{$field.nickname}" class="hd-w300"/>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">锁定到期时间</th>
            <td>
                <label>
                    <input type="text" name="lock_end_time" id="lock_end_time"
                           value="{$field.lock_end_time|date:'Y/m/d',@@}"/>
                    <script>
                        $('#lock_end_time').calendar({format: 'yyyy/MM/dd'})
                    </script>
                    <span class="hd-validate-notice">超过这个时间自动解锁</span>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">密码</th>
            <td>
                <input type="password" name="password" value="" class="hd-w300"/>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">确认密码</th>
            <td>
                <input type="password" name="password_c" value="" class="hd-w300"/>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">邮箱</th>
            <td>
                <input type="text" name="email" value="{$field.email}" class="hd-w300"/>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">QQ</th>
            <td>
                <input type="text" name="qq" value="{$field.qq}" class="hd-w300"/>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">积分</th>
            <td>
                <input type="text" name="credits" value="{$field.credits}" class="hd-w300" required=""/>
            </td>
        </tr>

    </table>
    <input type="submit" value="确定" class="hd-btn"/>
</form>
</body>
</html>