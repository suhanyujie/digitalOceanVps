<include file="__PUBLIC__/header"/>
<body>
<form method="post" onsubmit="return hd_submit(this,'{|U:'add'}','{|U:'index',array('mid'=>$model['mid'])}')">
<input type="hidden" name="mid" value="{$model.mid}"/>

<div class="hd-menu-list">
    <ul>
        <li>
            <a href="{|U:'Model/index'}">
                模型列表
            </a>
        </li>
        <li>
            <a href="{|U:'index',array('mid'=>$_GET['mid'])}">
                字段列表
            </a>
        </li>
        <li class="active">
            <a href="#">
                添加字段
            </a>
        </li>
    </ul>
</div>
<div class="hd-title-header">
    添加字段
</div>

<table class="hd-table hd-table-form hd-form">
    <tr>
        <th class="hd-w400"> 模型</th>
        <td> {$model.model_name}</td>
    </tr>
    <tr>
        <th> 类型 <span class="notice"></span></th>
        <td>
            <select id="field_type" name="field_type">
                <option value="input">单行文本</option>
                <option value="textarea">多行文本</option>
                <option value="number">数字</option>
                <option value="box">选项</option>
                <option value="editor">编辑器</option>
                <option value="image">图片</option>
                <option value="images">多图片</option>
                <option value="datetime">日期与时间</option>
                <option value="files">文件</option>
            </select>
        </td>
    </tr>
    <tr>
        <th>
            表
            <span class="star">*</span>
            <span class="notice">字段所在表</span>
        </th>
        <td>
            <label>
                <input type="radio" name="table_type" value="1" checked=""/>主表
            </label>
            <label>
                <input type="radio" name="table_type" value="2"/>副表
            </label>
        </td>
    </tr>
    <tr>
        <th>
            字段标题
            <span class="star">*</span>
            <span class="notice">例如：文章标题</span>
        </th>
        <td>
            <input type="text" name="title" class="hd-w200"/>
        </td>
    </tr>
    <tr>
        <th>
            字段名
            <span class="star">*</span>
            <span class="notice">必须为英文小写字母</span>
        </th>
        <td>
            <input type="text" name="field_name" class="hd-w200"/>
        </td>
    </tr>
    <tr>
        <th> 字段提示</th>
        <td>
            <textarea name="tips" class="hd-w400 h80"></textarea>
        </td>
    </tr>
</table>
<div class="field_tpl">

</div>
<table class="hd-table hd-table-form hd-form">
    <tr>
        <th class="hd-w400">
            表单样式名
            <span class="notice">定义表单的CSS样式名</span>
        </th>
        <td>
            <input type="text" name="css" class="hd-w250"/>
        </td>
    </tr>
    <tr>
        <th>
            字符长度取值范围
            <span class="notice">系统将在表单提交时检测数据长度范围，如果不想限制长度请留空</span></th>
        <td>
            最小值：
            <input type="text" name="minlength" class="hd-w50" value="0"/>
            最大值：
            <input type="text" name="maxlength" class="hd-w50"/>
        </td>
    </tr>
    <tr>
        <th>
            表单验证
            <span class="notice">系统将通过此正则校验表单提交的数据合法性，如果不想校验数据请留空</span></th>
        <td>
            <input type="text" name="validate"
                   class="hd-w250 input_validation"/>
            <select id="field_check">
                <option value="">常用正则</option>
                <option value="/^[0-9.-]+$/">数字</option>
                <option value="/^[0-9-]+$/">整数</option>
                <option value="/^[a-z]+$/i">字母</option>
                <option value="/^[0-9a-z]+$/i">数字+字母</option>
                <option value="/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/">E-mail</option>
                <option value="/^[0-9]{5,20}$/">QQ</option>
                <option value="/^http:\/\//">超级链接</option>
                <option value="/^(1)[0-9]{10}$/">手机号码</option>
                <option value="/^[0-9-]{6,13}$/">电话号码</option>
                <option value="/^[0-9]{6}$/">邮政编码</option>
            </select><span id="hd_set[validation]"></span></td>
    </tr>
    <tr>
        <th>
            必须输入
            <span class="notice">如果表单必须设置值时选择‘是’</span>
        </th>
        <td>
            <label>
                <input type="radio" name="required" value="1"/>是
            </label>
            <label>
                <input type="radio" name="required" value="0"
                       checked="checked"/>
                否
            </label>
        </td>
    </tr>
    <tr>
        <th>
            错误提示
            <span class="notice">输入内容不正确时的提示信息</span>
        </th>
        <td>
            <input type="text" name="error" class="hd-w300"/>
        </td>
    </tr>
    <tr>
        <th> 值唯一</th>
        <td>
            <label>
                <input type="radio" name="isunique" value="1"/>
                是
            </label>
            <label>
                <input type="radio" name="isunique" value="0"
                       checked="checked"/>
                否
            </label>
        </td>
    </tr>
    <tr>
        <th>
            作为基本信息
            <span class="notice">基本信息将在添加页面左侧显示</span>
        </th>
        <td>
            <label>
                <input type="radio" name="isbase" value="1"
                       checked="checked"/>
                是</label>
            <label>
                <input type="radio" name="isbase" value="0"/>
                否</label>
        </td>
    </tr>
    <tr>
        <th> 作为搜索条件</th>
        <td><label>
                <input type="radio" name="issearch" value="1"/>
                是</label><label>
                <input type="radio" name="issearch" value="0"
                       checked="checked"/>
                否</label></td>
    </tr>
    <tr>
        <th> 在前台投稿中显示</th>
        <td>
            <label>
                <input type="radio" name="isadd" value="1"/>
                是</label>
            <label>
                <input type="radio" name="isadd" value="0"
                       checked="checked"/>
                否
            </label>
        </td>
    </tr>

</table>
<input type="submit" value="确定" class="hd-btn"/>
</form>
<script>
    $("#field_type").change(function () {
        /**
         * 字段类型
         * @type {*|jQuery}
         */
        var field_type = $(this).val();
        $.ajax({
            url: '{|U:"getAddFieldTpl"}',
            type: "POST",
            data: {
                action: 'add',
                field_type: field_type,
                mid: '{$hd.get.mid}'
            },
            success: function (data) {
                $(".field_tpl").html(data);
            }
        })
    })
    /**
     * 加载时触发
     */
    $("#field_type").trigger("change");
    /**
     * 表单验证切换
     */
    $("#field_check").live("change", function () {
        $("[name='validate']").val($(this).val());
    })
</script>
</body>
</html>

