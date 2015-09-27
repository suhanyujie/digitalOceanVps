<include file="__PUBLIC__/header"/>
<body>
    <div class="hd-menu-list">
        <ul>
            <li><a href="{|U:'index'}">角色列表</a></li>
            <li class="active"><a href="javascript:;">修改角色</a></li>
        </ul>
    </div>
    <div class="hd-title-header">角色信息</div>
    <form onsubmit="return hd_submit(this,'{|U:edit}','{|U:index}')">
        <input type="hidden" name="rid" value="{$field.rid}"/>
        <input type="hidden" name="admin" value="1"/>
        <table class="hd-table hd-table-form hd-form">
            <tr>
                <th class="hd-w100">角色名称</th>
                <td>
                    <input type="text" name="rname" value="{$field.rname}" class="hd-w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">角色描述</th>
                <td>
                    <textarea name="title" class="hd-w300 hd-h100">{$field.title}</textarea>
                </td>
            </tr>
        </table>
            <input type="submit" class="hd-btn" value="确定"/>
    </form>

</body>
</html>