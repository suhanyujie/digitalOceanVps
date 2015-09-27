<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HDCMS永久免费 - {$hd.config.webname} - by HDCMS</title>
    <script type="text/javascript" src="__STATIC__/hdjs/jquery-1.8.2.min.js"></script>
    <link rel="stylesheet" href="__STATIC__/hdjs/hdjs.css"/>
    <script type="text/javascript" src="__STATIC__/hdjs/hdjs.min.js"></script>
    <jsconst/>
</head>
<body style="padding: 10px;">
    <div class="hd-menu-list">
        <ul>
            <li class="active">
                <a href="{|addon_url:index}">评论列表</a>
            </li>
        </ul>
    </div>
    <form >
    <table class="hd-table hd-table-list hd-form">
        <thead>
        <tr>
            <td class="hd-w30">
                <input type="checkbox" class="select_all"/>
            </td>
            <td>评论</td>
            <td class="hd-w100">用户</td>
            <td class="hd-w50">操作</td>
        </tr>
        </thead>
        <tbody>
        <list from="$data" name="$d">
            <tr>
                <td>
                    <input type="checkbox" name="comment_id[]" value="{$d.comment_id}"/>
                </td>
                <td>{$d.comment_content|htmlspecialchars|mb_substr:0,20,'utf-8'}</td>
                <td>
                    {$d.username}
                </td>
                <td>
                    <a href="{|addon_url:'preview',array('comment_id'=>$d['comment_id'],'mid'=>$d['mid'],'cid'=>$d['cid'],'aid'=>$d['aid'],'g'=>'Addons')}" target="_blank">
                        查看
                    </a>
                </td>
            </tr>
        </list>
        </tbody>
    </table>
    <input type="button" class="hd-btn hd-btn-xm" onclick="select_all(1)" value='全选'/>
    <input type="button" class="hd-btn hd-btn-xm" onclick="select_all(0)" value='反选'/>
    <input type="button" class="hd-btn hd-btn-xm" onclick="BulkDel()" value="批量删除"/>
    </form>
<div class="hd-page">
    {$page}
</div>
<style type="text/css">
    img.explodeCategory {
        cursor: pointer;
    }
</style>
<script>
    //全选
    $("input.select_all").click(function () {
        $("[type='checkbox']").attr("checked", $(this).attr('checked') == 'checked');
    })
    //全选复选框
    function select_all(state) {
        if (state == 1) {
            $("[type='checkbox']").attr("checked", state);
        } else {
            $("[type='checkbox']").attr("checked", function () {
                return !$(this).attr('checked')
            });
        }
    }
    //删除栏目
    function delComment(comment_id) {
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
                hd_ajax('{|addon_url:"del"}', {comment_id: comment_id}, '__URL__');
            }
        });
    }
    //指量删除
    function BulkDel() {
        //栏目检测
        if ($("input[type='checkbox']:checked").length == 0) {
            alert('请选择评论');
            return false;
        }
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
                hd_ajax('{|addon_url:"BulkDel"}', $('form').serialize(), '__URL__');
            }
        });
    }
</script>
</body>
</html>