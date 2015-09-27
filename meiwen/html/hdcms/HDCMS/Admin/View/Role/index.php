<include file="__PUBLIC__/header"/>
<body>
    <div class="hd-menu-list">
        <ul>
            <li class="active"><a href="{|U:'index'}">角色列表</a></li>
            <li><a href="{|U:'add'}">添加角色</a></li>
        </ul>
    </div>
    <table class="hd-table hd-table-form">
        <thead>
        <tr>
            <td class="hd-w30">rid</td>
            <td class="hd-w150">角色名称</td>
            <td>描述</td>
            <td class="hd-w100">系统</td>
            <td class="hd-w120">操作</td>
        </tr>
        </thead>
        <tbody>
        <list from="$data" name="$d">
            <tr>
                <td>{$d.rid}</td>
                <td>{$d.rname}</td>
                <td>{$d.title}</td>
                <td>
                    <if value="$d.system">
                        <font color="red">√</font>
                        <else/>
                        <font color="blue">×</font>
                    </if>
                </td>
                <td>
                    <a href="{|U:'edit',array('rid'=>$d['rid'])}">修改</a> |
                    <if value="$d.system eq 0">
                        <a href="javascript:del({$d.rid})">删除</a>
                    <else/>
                            删除
                    </if>
                    |
                    <if value="$d.rid eq 1">
                        权限设置
                        <else/>
                            <a href="{|U:'Access/edit',array('rid'=>$d['rid'])}">权限设置</a>
                    </if>
                </td>
            </tr>
        </list>
        </tbody>
    </table>
    <script>
        //删除栏目
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