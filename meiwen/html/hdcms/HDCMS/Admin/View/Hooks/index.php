<include file="__PUBLIC__/header"/>
<body>
<form class="hd-form">
    <div class="hd-menu-list">
        <ul>
            <li class="active">
                <a href="{|U:'index'}">钓子列表</a>
            </li>
            <li>
                <a href="{|U:'add'}">添加钓子</a>
            </li>
        </ul>
    </div>
    <table class="hd-table hd-table-list hd-form">
        <thead>
        <tr>
            <td class="w50">ID</td>
            <td class="w300">名称</td>
            <td>描述</td>
            <td>类型</td>
            <td class="w50">开启</td>
            <td class="w50">系统</td>
            <td class="w80">操作</td>
        </tr>
        </thead>
        <tbody>
        <list from="$data" name="$d">
            <tr>
                <td>{$d.id}</td>
                <td>{$d.name}</td>
                <td>{$d.description}</td>
                <td>
                    <if value="$d.type eq 1">控制器
                        <else>视图
                    </if>
                </td>
                <td>
                    <if value='$d.status eq 1'>
                        <font color="red">√</font>
                        <else/>
                            <font color="blue">×</font>
                    </if>
                </td>
                <td class="w50">
                    <if value='$d.is_system eq 1'>
                        <font color="red">√</font>
                        <else/>
                            <font color="blue">×</font>
                    </if>
                </td>
                <td>
                    <if value="$d.is_system">
                        编辑 | 删除
                        <else/>
                            <a href="{|U:'edit',array('id'=>$d['id'])}">编辑</a> |
                            <a href="javascript:del({$d.id})">
                                删除</a>
                    </if>
                </td>
            </tr>
        </list>
        </tbody>
    </table>
</form>
<script>
    //删除栏目
    function del(id) {
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
                hd_ajax('{|U:"del"}', {id: id}, '__URL__');
            }
        });
    }
</script>
</body>
</html>