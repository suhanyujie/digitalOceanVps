<include file="__PUBLIC__/header"/>
<body>
<div class="hd-menu-list">
    <ul>
        <li>
            <a href="{|U:'index'}">钓子列表</a>
        </li>
        <li class="active">
            <a href="{|U:'add'}">添加钓子</a>
        </li>
    </ul>
</div>
<div class="hd-title-header">
    修改钓子
</div>
<form onsubmit="return hd_submit(this,'__ACTION__','{|U:index}')">
    <table class="hd-table hd-table-form hd-form">
        <tr>
            <th class="hd-w100">钩子名称 <span class="star">*</span></th>
            <td>
                <input type="text" name="name" class="hd-w200" required=""/>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">钩子描述 <span class="star">*</span></th>
            <td>
                <textarea name="description" class="hd-w300 hd-h100" required=""></textarea>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">状态</th>
            <td>
                <label><input type="radio" name="status" value="1" checked=""/> 开启</label>
                <label><input type="radio" name="status" value="0"/> 关闭</label>
            </td>
        </tr>
        <tr>
            <th>钩子类型</th>
            <td>
                <select name="type" class="hd-w150">
                    <option value="1">控制器</option>
                    <option value="1">视图</option>
                </select>
            </td>
        </tr>
    </table>
    <input type="submit" value="确定" class="hd-btn"/>
</form>
</body>
</html>