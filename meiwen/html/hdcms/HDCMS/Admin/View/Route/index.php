<include file="__PUBLIC__/header"/>
<body>
<div class="hd-menu-list">
    <ul>
        <li class="active"><a href="__URL__">路由器设置</a></li>
    </ul>
</div>
<form onsubmit="return hd_submit(this,'{|U:index}','{|U:index}')">
    <table class="hd-table hd-table-form hd-form">
        <thead>
        <tr style="background: #E6E6E6;">
            <td class="hd-w250">描述</td>
            <td class="hd-w300">路由规则</td>
            <td>正常URL</td>
        </tr>
        </thead>
        <tbody id="route">
        <list from="$route" name="$r">
            <tr>
                <td><input type="text" name="title[]" class="hd-w250" value="{$r.title}"/></td>
                <td><input type="text" name="route[]" class="hd-w300" value="{$r.route}"/></td>
                <td>
                    <input type="text" name="url[]" class="hd-w400" value="{$r.url}"/>
                    <a href="javascript:;" class="hd-btn hd-btn-xm" onclick="delRoute(this);">删除</a>
                    <a href="javascript:;" class="hd-btn hd-btn-xm" onclick="addRoute();">添加</a>
                </td>
            </tr>
        </list>
        </tbody>
    </table>
    <input type="submit" class="hd-btn hd-btn-sm" value="确定"/>
</form>
<script type="text/javascript">
    function addRoute() {
        var tr = $('#route tr').eq(0).clone().find('input').val('').end();
        $('#route').append(tr);
    }
    function delRoute(obj) {
        if (confirm('确定删除吗？')) {
            if ($('#route tr').length == 1) {
                alert('再删就没了..');
            } else {
                $(obj).parents('tr').eq(0).remove();
            }
        }
    }
</script>
</body>
</html>