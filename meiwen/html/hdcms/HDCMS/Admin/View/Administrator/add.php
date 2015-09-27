<include file="__PUBLIC__/header"/>
<body>
<div class="hd-menu-list">
    <ul>
        <li><a href="{|U:'index'}">管理员</a></li>
        <li class="active"><a href="javascript:;">添加管理员</a></li>
    </ul>
</div>
<div class="hd-title-header">管理员信息</div>
<form class="hd-form" onsubmit="return hd_submit(this,'__ACTION__','__CONTROLLER__')">
    <table class="hd-table hd-table-form">
        <tr>
            <th class="hd-w100">帐号 <span class="star">*</span></th>
            <td>
                <input type="text" name="username" class="hd-w200"/>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">所属角色 <span class="star">*</span></th>
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
                <input type="password" name="password" class="hd-w200"/>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">确认密码 <span class="star">*</span></th>
            <td>
                <input type="password" name="c_password" class="hd-w200"/>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">积分 <span class="star">*</span></th>
            <td>
                <input type="text" name="credits" class="hd-w200" value="{$hd.config.INIT_CREDITS}"/>
            </td>
        </tr>
    </table>
    <input type="submit" class="hd-btn" value="确定"/>
</form>
</body>
</html>