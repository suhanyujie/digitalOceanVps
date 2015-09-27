<include file="__PUBLIC__/header"/>
<body>
<div class="hd-menu-list">
    <ul>
        <li><a href="{|U:'index'}">会员组列表</a></li>
        <li class="active"><a href="__URL__">添加会员组</a></li>
    </ul>
</div>
<div class="hd-title-header">添加会员组</div>
<form onsubmit="return hd_submit(this,'__ACTION__','{|U:'index'}')">
    <table class="hd-table hd-table-form hd-form">
        <tr>
            <th class="hd-w100">会员组名 <span class="star">*</span></th>
            <td>
                <input type="text" name="rname" class="hd-w300" required=""/>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">积分小于 <span class="star">*</span></th>
            <td>
                <input type="text" name="creditslower" class="hd-w300" required=""/>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">评论不需要审核</th>
            <td>
                <label>
                    <input type="radio" name="comment_state" value="1"/> 是
                </label>
                <label>
                    <input type="radio" name="comment_state" value="0" checked="checked"/> 否
                </label>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">允许发短消息</th>
            <td>
                <label>
                    <input type="radio" name="allowsendmessage" value="1"/>是
                </label>
                <label>
                    <input type="radio" name="allowsendmessage" value="0" checked="checked"/>否
                </label>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">描述</th>
            <td>
                <input type="text" name="title" class="hd-w300"/>
            </td>
        </tr>
    </table>
    <input type="submit" value="确定" class="hd-btn"/>
</form>
</body>
</html>