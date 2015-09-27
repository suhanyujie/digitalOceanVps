<include file="__PUBLIC__/header"/>
<body>
<div class="hd-menu-list">
    <ul>
        <li class="active"><a href="{|U:'index'}">会员组列表</a></li>
        <li><a href="{|U:'add'}">添加会员组</a></li>
    </ul>
</div>
<table class="hd-table hd-table-list hd-form">
    <thead>
    <tr>
        <td class="hd-w30">rid</td>
        <td>会员组名</td>
        <td class="hd-w150">系统组</td>
        <td class="hd-w150">积分小于</td>
        <td class="hd-w150">评论不需要审核</td>
        <td class="hd-w150">允许发短消息</td>
        <td class="hd-w60">操作</td>
    </tr>
    </thead>
    <tbody>
    <list from="$data" name="$d">
        <tr>
            <td>{$d.rid}</td>
            <td>
                {$d.rname}
            </td>
            <td>
                <if value="$d.system">
                    <font color="red">√</font>
                    <else/>
                    <font color="blue">×</font>
                </if>
            </td>
            <td>{$d.creditslower}</td>

            <td>
                <if value="$d.comment_state">
                    <font color="red">√</font>
                    <else/>
                    ×
                </if>
            </td>
            <td>
                <if value="$d.allowsendmessage">
                    <font color="red">√</font>
                    <else/>
                    ×
                </if>
            </td>
            <td>
                <a href="{|U:'edit',array('rid'=>$d['rid'])}">修改</a>
                <span class="line">|</span>
                <if value="$d.system eq 1">
                    <span>删除</span>
                    <else/>
                    <a href="javascript:del({$d['rid']})">删除</a>
                </if>
            </td>
        </tr>
    </list>
    </tbody>
</table>
<script>
    //删除
    function del(rid) {
        hd_modal({
            width: 400,//宽度
            height: 200,//高度
            title: '提示',//标题
            content: '确定删除吗',//提示信息
            button: true,//显示按钮
            button_success: "确定",//确定按钮文字
            button_cancel: "关闭",//关闭按钮文字
            timeout: 0,//自动关闭时间 0：不自动关闭
            shade: true,//背景遮罩
            shadeOpacity: 0.1,//背景透明度
            success: function () {//点击确定后的事件
                hd_ajax('{|U:"del"}', {rid: rid}, '__URL__');
            }
        });
    }
</script>
</body>
</html>