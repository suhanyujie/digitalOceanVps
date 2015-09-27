<include file="__PUBLIC__/header"/>
<body>
<div class="hd-menu-list">
    <ul>
        <li><a href="{|U:'index'}">模型列表</a></li>
        <li class="active"><a href="#">修改模型</a></li>
    </ul>
</div>
<div class="hd-title-header">
    修改模型
</div>
<form method="post" onsubmit="return hd_submit(this,'__ACTION__','{|U:'index'}')">

    <input type="hidden" name="mid" value="{$field.mid}"/>
    <table class="hd-table hd-table-form hd-form">
        <tr>
            <th class="hd-w100">模型名称 <span class="star">*</span> </th>
            <td>
                <input type="text" value="{$field.model_name}"
                       name="model_name" class="w200"/>
            </td>
        </tr>
        <tr>
            <th>模型描述</th>
            <td>
                <textarea name="description" class="hd-w350 hd-h80">{$field.description}</textarea>
            </td>
        </tr>
        <tr>
            <th>模型状态</th>
            <td>
                <label>
                    <input type="radio" name="enable" value="1"
                    <if value="$field.enable eq 1">checked=""</if>
                    /> 开启模型
                </label>
                <label>
                    <input type="radio" name="enable" value="0"
                    <if value="$field.enable eq 0">checked=""</if>
                    /> 关闭模型
                </label>
            </td>
        </tr>
        <tr>
            <th>允许投稿</th>
            <td>
                <label>
                    <input type="radio" name="contribute" value="1"
                    <if value="$field.contribute eq 1">checked=""</if>
                    /> 允许投稿
                </label>
                <label>
                    <input type="radio" name="contribute" value="0"
                    <if value="$field.contribute eq 0">checked=""</if>
                    /> 禁止投稿
                </label>
            </td>
        </tr>
    </table>
    <input type="submit" value="确定" class="hd-btn"/>
</form>
</body>
</html>