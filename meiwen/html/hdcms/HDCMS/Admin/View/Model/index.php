<include file="__PUBLIC__/header"/>
<body>
<div class="hd-menu-list">
    <ul>
        <li class="active">
            <a href="{|U:'index'}">
                模型列表
            </a>
        </li>
        <li>
            <a href="{|U:'add'}">
                添加模型
            </a>
        </li>
        <li>
            <a href="javascript:;" onclick="hd_ajax('{|U:updateCache}')">
                更新缓存
            </a>
        </li>
    </ul>
</div>
<div class="content">
    <table class="hd-table hd-table-list">
        <thead>
        <tr>
            <td class="hd-w30">mid</td>
            <td>模型名称</td>
            <td class="hd-w100">主表</td>
            <td class="hd-w100">系统模型</td>
            <td class="hd-w100">前台投稿</td>
            <td class="hd-w30">状态</td>
            <td class="hd-w150">操作</td>
        </tr>
        </thead>
        <tbody>
        <list from="$model" name="$m">
            <tr>
                <td>{$m.mid}</td>
                <td>{$m.model_name}</td>
                <td>{$m.table_name}</td>
                <td>
                    <if value='$m.is_system eq 1'>
                        <font color="red">√</font>
                        <else/>
                        <font color="blue">×</font>
                    </if>
                </td>

                <td class="w30">
                    <if value='$m.contribute eq 1'>
                        <font color="red">√</font>
                        <else/>
                        <font color="blue">×</font>
                    </if>
                </td>
                <td>
                    <if value="$m['enable']">
                        <font color="red">√</font>
                        <else/>
                        <font color="blue">×</font>
                    </if>
                </td>
                <td>
                    <a href="{|U:'Field/index',array('mid'=>$m['mid'])}">
                        字段管理
                    </a> |
                    <a href="{|U:'edit',array('mid'=>$m['mid'])}">
                        修改
                    </a>
                    |
                    <if value="$m.is_system==1">
                        删除
                        <else/>
                        <a href="javascript:delModel({$m.mid})">删除</a>
                    </if>
                </td>
            </tr>
        </list>
        </tbody>
    </table>
</div>
<script>
    function delModel(mid) {
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
                hd_ajax('{|U:"del"}', {mid: mid}, '__ACTION__');
            },
            cancel: function () {//点击关闭后的事件

            }
        });
    }
</script>
</body>
</html>