<include file="__PUBLIC__/header"/>
<body>
<div class="wrap">
    <div class="hd-menu-list">
        <ul>
            <li class="active"><a href="{|U:'index'}">tag列表</a></li>
        </ul>
    </div>
    <table class="hd-table hd-table-list hd-form">
        <thead>
        <tr>
            <td class="hd-w30">
                <input type="checkbox" id="select_all"/>
            </td>
            <td class="hd-w30">tid</td>
            <td>关键词</td>
            <td class="hd-w100">统计</td>
            <td class="hd-w50">操作</td>
        </tr>
        </thead>
        <list from="$data" name="$d">
            <tr>
                <td><input type="checkbox" name="tid[]" value="{$d.tid}"/></td>
                <td>{$d.tid}</td>
                <td>
                    <a href="{|U:edit,array('tid'=>$d['tid'])}">{$d.tag}</a>
                </td>
                <td>
                    {$d.total}
                </td>
                <td>
                    <a href="{|U:edit,array('tid'=>$d['tid'])}">编辑</a>
                </td>
            </tr>
        </list>
    </table>
    <div class="hd-page">
        {$page}
    </div>
</div>
<div class="position-bottom">
    <input type="button" class="hd-btn hd-btn-xm" value="全选" onclick="selectAll('.table2')"/>
    <input type="button" class="hd-btn hd-btn-xm" value="反选" onclick="reverse_select('.table2')"/>
    <input type="button" class="hd-btn hd-btn-xm" onclick="del()" value="批量删除"/>
</div>
<script>
    //全选
    $("input#select_all").click(function () {
        $("[type='checkbox']").attr("checked", $(this).attr("checked") == "checked");
    })
    //全选文章
    function selectAll() {
        $("[type='checkbox']").attr("checked", "checked");
    }
    //反选文章
    function reverse_select() {
        $("[type='checkbox']").attr("checked", function () {
            return !$(this).attr("checked") == 1;
        });
    }
    /**
     * 批量删除文章
     */
    function del(mid,cid){
        var tid=$("input[name*=tid]:checked").serialize();
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
                hd_ajax('{|U:"del"}', tid, '__URL__');
            }
        });
    }
</script>
</body>
</html>