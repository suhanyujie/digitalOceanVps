<include file="__PUBLIC__/header"/>
<body>
<div class="hd-menu-list">
    <ul>
        <li class="active"><a href="{|U:'index'}">菜单管理</a></li>
        <li><a href="{|U:'add',array('pid'=>0)}">添加菜单</a></li>
    </ul>
</div>
<div class="hd-title-header">注意</div>
<div class="help">
    <ul>
        <li>将影响后台菜单布局与权限控制</li>
    </ul>
</div>
<form onsubmit="return hd_submit(this,'{|U:'updateOrder'}','__URL__');">
    <table class="hd-table hd-table-list hd-form">
        <thead>
        <tr>
            <td class="hd-w50">排序</td>
            <td class="hd-w50">ID</td>
            <td>菜单名称</td>
            <td>状态</td>
            <td class="hd-w80">类型</td>
            <td class="hd-w150">操作</td>
        </tr>
        </thead>
        <tbody>
        <list from="$node" name="$n">
            <tr>
                <td>
                    <input type="text" class="hd-w50" value="{$n.list_order}" name="list_order[{$n.nid}]"/>
                </td>
                <td>{$n.nid}</td>
                <td>{$n._name}</td>
                <td>
                    <if value="$n.is_show eq 1">
                        显示
                        <else/>
                        隐藏
                    </if>
                </td>
                <td>
                    <if value="$n.type eq 1">
                        权限菜单
                        <else/>
                        普通菜单
                    </if>
                </td>
                <td style="text-align: right">
                    <if value="$n._level eq 3">
                        <span class="disabled">添加子菜单  | </span>
                        <else/>
                        <a href="{|U:'add',array('pid'=>$n['nid'])}">添加子菜单</a> |
                    </if>

                    <if value="$n.is_system eq 0">
                        <a href="{|U:'edit',array('nid'=>$n['nid'])}">修改</a> |
                        <a href="javascript:del({$n.nid})">删除</a>
                        <else/>
                        <span class="disabled">修改 | </span>
                        <span class="disabled">删除</span>
                    </if>
                </td>
            </tr>
        </list>
        </tbody>
    </table>
    <input type="submit" class="hd-btn" value="排序""/>
</form>
<script>
    //删除栏目
    function del(nid) {
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
                hd_ajax('{|U:"del"}', {nid: nid}, '__URL__');
            }
        });
    }
</script>
</body>
</html>