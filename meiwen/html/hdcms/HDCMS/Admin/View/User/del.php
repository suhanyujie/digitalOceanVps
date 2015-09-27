<include file="__PUBLIC__/header"/>
<body>
<div class="hd-menu-list">
    <ul>
        <li><a href="{|U:'index'}">会员列表</a></li>
        <li class="active"><a href="javascript:;">删除会员</a></li>
    </ul>
</div>
<div class="hd-title-header">删除会员</div>
<form onsubmit="return hd_submit(this,'__ACTION__','{|U:index}');">
    <input type="hidden" name="uid" value="{$field.uid}"/>
    <table class="hd-table hd-table-form hd-form">
        <tr>
            <th class="hd-w100">用户名</th>
            <td>
                {$field.username}
            </td>
        </tr>
        <tr>
            <th class="hd-w100">删除选项</th>
            <td>
                <label><input type="checkbox" name="delcontent" checked=""/> 文章</label>
                <label><input type="checkbox" name="delcomment" checked=""/> 评论</label>
                <label><input type="checkbox" name="delupload" checked=""/> 附件</label>
            </td>
        </tr>

    </table>
    <input type="submit" value="确定" class="hd-btn"/>
</form>
</body>
</html>