<include file="__PUBLIC__/header"/>
<body>
<div class="hd-menu-list">
    <ul>
        <li>
            <a href="{|U:'index'}">钓子列表</a>
        </li>
        <li class="active">
            <a href="{|U:'edit'}">编辑钓子</a>
        </li>
    </ul>
</div>
<div class="hd-title-header">
    修改钓子
</div>
<form onsubmit="return hd_submit(this,'__ACTION__','{|U:index}')">
    <input type="hidden" name="id" value="{$field.id}"/>
    <table class="hd-table hd-table-form hd-form">
        <tr>
            <th class="hd-w100">钩子名称 <span class="star">*</span></th>
            <td>
                <input type="text" name="name" class="hd-w200" value="{$field.name}" required=""/>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">钩子描述 <span class="star">*</span></th>
            <td>
                <textarea name="description" class="hd-w300 hd-h100" required="">{$field.description}</textarea>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">状态</th>
            <td>
                <label>
                    <input type="radio" name="status" value="1" <if value="$field.status eq 1">checked=""</if>/> 开启
                </label>
                <label>
                    <input type="radio" name="status" value="0"<if value="$field.status eq 0">checked=""</if>/> 关闭
                </label>
            </td>
        </tr>
        <tr>
            <th>钩子类型</th>
            <td>
                <select name="type" class="hd-w150">
                    <option value="1" <if value="$field.type eq 1"> checked=""</if>>控制器</option>
                    <option value="2" <if value="$field.type eq 2"> checked=""</if>>视图</option>
                </select>
            </td>
        </tr>
    </table>
    <input type="submit" value="确定" class="hd-btn"/>
</form>
</body>
</html>