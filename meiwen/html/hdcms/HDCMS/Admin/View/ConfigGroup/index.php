<include file="__PUBLIC__/header"/>
<body>
    <div class="hd-menu-list">
        <ul>
            <li class="active"><a href="{|U:'index'}">配置组列表</a></li>
            <li><a href="{|U:'add'}">添加配置组</a></li>
        </ul>
    </div>
    <table class="hd-table hd-table-list hd-form">
        <thead>
            <tr>
                <td class="hd-w50">ID</td>
                <td class="hd-w100">组名</td>
                <td>中文标题</td>
                <td>系统组</td>
                <td class="hd-w80"></td>
            </tr>
        </thead>
        <tbody>
        <list from="$data" name="$d">
            <tr>
                <td>{$d.cgid}</td>
                <td>{$d.cgname}</td>
                <td>{$d.cgtitle}</td>
                <td>
                    <if value="$d['system']">
                        <font color="red">√</font>
                        <else/>
                            <font color="blue">×</font>
                    </if>
                </td>
                <td>
                    <if value="$d['system']">
                        <span>修改</span> |
                        <span>删除</span>
                    <else/>
                        <a href="{|U:'edit',array('cgid'=>$d['cgid'])}">修改</a> |
                        <a href="javascript:del({$d.cgid})">删除</a>
                    </if>
                </td>
            </tr>
        </list>
        </tbody>
    </table>
    <script>
        //删除栏目
        function del(cgid) {
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
                    hd_ajax('{|U:"del"}', {cgid: cgid}, '__URL__');
                }
            });
        }
    </script>
</body>
</html>