<include file="__PUBLIC__/header"/>
<body>
    <div class="hd-menu-list">
        <ul>
            <li class="active"><a href="{|U:'index'}">管理员</a></li>
            <li><a href="{|U:'add'}">添加管理员</a></li>
        </ul>
    </div>
    <table class="hd-table hd-table-list">
        <thead>
        <tr>
            <td class="hd-w30">aid</td>
            <td>用户名</td>
            <td>所属角色</td>
            <td>登录IP</td>
            <td>登录时间</td>
            <td>昵称</td>
            <td>邮箱</td>
            <td class="hd-w80">操作</td>
        </tr>
        </thead>
        <tbody>
        <list from="$data" name="$a">
            <tr>
                <td>{$a.uid}</td>
                <td>{$a.username}</td>
                <td>{$a.rname}</td>
                <td>{$a.lastip}</td>
                <td>{$a.logintime|date:'Y-m-d H:i',@@}</td>
                <td>{$a.nickname}</td>
                <td>{$a.email}</td>
                <td>
                    <a href="{|U:'edit',array('uid'=>$a['uid'])}">修改</a> |
                    <if value="C('WEB_MASTER') eq $a['username']">
                        删除
                    <else/>
                        <a href="javascript:del({$a.uid})">删除</a>
                    </if>
                </td>
            </tr>
        </list>
        </tbody>
    </table>
    <script>
        //删除
        function del(uid) {
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
                    hd_ajax('{|U:"del"}', {uid: uid}, '__URL__');
                }
            });
        }
    </script>
</body>
</html>