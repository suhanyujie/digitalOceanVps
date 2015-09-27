<include file="__PUBLIC__/header"/>
<body>
<div class="hd-menu-list">
    <ul>
        <li class="active"><a href="__URL__">附件管理</a></li>
    </ul>
</div>
<form action="{|U:'BulkDel'}"onsubmit="return hd_submit(this,'{|U:'index'}');">

    <table class="hd-table hd-table-form hd-form">
        <thead>
        <tr>
            <td class="hd-w30">
                <input type="checkbox" id="selectAllContent"/>
            </td>
            <td class="hd-w50">ID</td>
            <td class="hd-w100">预览</td>
            <td>文件名</td>
            <td>大小</td>
            <td class="hd-w200">上传时间</td>
            <td class="hd-w100">用户</td>
        </tr>
        </thead>
        <list from="$upload" name="$u">
            <tr>
                <td>
                    <input type="checkbox" name="ids[]" value="{$u.id}"/>
                </td>
                <td>{$u.id}</td>
                <td>
                    <if value="$u.image && is_file($u.path)">
                        <a href="{$u.pic}" target="_blank">
                            <img src="__ROOT__/{$u.path}" class="hd-w40 hd-h30" title="点击预览大图" onmouseover="view_image(this)"/>
                        </a>
                        <else/>
                            <img src="__STATIC__/image/upload-pic.png'" class="hd-w40 h30" title="点击预览大图"/>
                    </if>
                </td>
                <td>
                    {$u.basename}
                </td>
                <td>
                    {$u.size|get_size}
                </td>
                <td>
                    {$u.uptime|date:"Y-m-d",@@}
                </td>
                <td>
                    {$u.username}
                </td>
            </tr>
        </list>
    </table>
    <div class="hd-page">
        {$page}
    </div>
    <input type="button" class="hd-btn hd-btn-xm" value="全选" onclick="select_all('.table2')"/>
    <input type="button" class="hd-btn hd-btn-xm" value="反选" onclick="reverse_select('.table2')"/>
        <input type="button" class="hd-btn hd-btn-xm" onclick="batchDel()" value="批量删除"/>
</form>
<script>
    //全选
    $("input#selectAllContent").click(function () {
        $("[type='checkbox']").attr("checked", $(this).attr("checked") == "checked");
    })
    //全选文章
    function select_all() {
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
    function batchDel(mid,cid){
        var ids=$("input[name*=ids]:checked").serialize();
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
                hd_ajax('{|U:"batchDel"}', ids, '__URL__');
            }
        });
    }
    //预览图片
    function view_image(obj) {
        var src = $(obj).attr('src');
        var viewImg = $('#view_img');
        //删除预览图
        if (viewImg.length >= 1) {
            viewImg.remove();
        }
        //鼠标移除时删除预览图
        $(obj).mouseout(function () {
            $('#view_img').remove();
        })
        if (src) {
            var offset = $(obj).offset();
            var _left = 100 + offset.left + "px";
            var _top = offset.top - 50 + "px";
            var html = '<img src="' + src + '" style="border:solid 5px #dcdcdc;position:absolute;z-index:1000;width:300px;height:200px;left:' + _left + ';top:' + _top + ';" id="view_img"/>';
            $('body').append(html);
        }
    }
</script>
</body>
</html>