<include file="__PUBLIC__/header"/>
<body>
<div class="hd-menu-list">
    <ul>
        <li class="active"><a href="{|U:'index'}">配置组列表</a></li>
        <li><a href="{|U:'add'}">添加配置组</a></li>
    </ul>
</div>
<div class="hd-title-header">
    添加配置组
</div>
<form class="hd-form" onsubmit="return hd_submit(this,'__ACTION__','{|U:'index'}')">
    <table class="hd-table hd-table-form">
        <tr>
            <th class="hd-w100">组名称</th>
            <td>
                <input type="text" name="cgname" class="hd-w200"/>
            </td>
        </tr>
        <tr>
            <th>组标题</th>
            <td>
                <input type="text" name="cgtitle" class="hd-w200"/>
            </td>
        </tr>
        <tr>
            <th>排序</th>
            <td>
                <input type="text" name="cgorder" class="hd-w200" value="100"/>
            </td>
        </tr>
    </table>
    <input type="submit" value="确定" class="hd-btn"/>
</form>
</body>
</html>