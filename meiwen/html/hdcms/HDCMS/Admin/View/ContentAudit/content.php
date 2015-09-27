<include file="__PUBLIC__/header"/>

<body>
<div class="hd-menu-list">
    <ul>
        <li class="active">
            <a href="{|U:'content',array('mid'=>$_REQUEST['mid'])}" >文章列表</a>
        </li>
    </ul>
</div>
    <form id="search"  class="hd-form" method="get">
        <input type="hidden" name="m" value="{$hd.get.m}"/>
        <input type="hidden" name="c" value="{$hd.get.c}"/>
        <input type="hidden" name="a" value="{$hd.get.a}"/>
        <div class="search">
            模型：
            <select name="mid" class="hd-w100">
                <list from='$model' name="$m">
                <option value="{$m.mid}" <if value="$mid eq $m.mid">selected=''</if>>{$m.model_name}</option>
                </list>
            </select>
        </div>
    </form>
    <script>
        $("[name='mid']").change(function(){
            $("#search").trigger('submit');
        })
    </script>

    <table class="hd-table hd-table-form hd-form">
        <thead>
        <tr>
            <td class="hd-w30">
                <input type="checkbox" id="select_all"/>
            </td>
            <td class="hd-w30">aid</td>
            <td>标题</td>
            <td class="hd-w100">栏目</td>
            <td class="hd-w100">作者</td>
            <td class="hd-w80">修改时间</td>
            <td class="hd-w50">操作</td>
        </tr>
        </thead>
        <list from="$data" name="$d">
            <tr>
                <td><input type="checkbox" name="aid[]" value="{$d.aid}"/></td>
                <td>{$d.aid}</td>
                <td>
                    <a href="{|U:'Index/Index/Content',array('mid'=>$mid,'cid'=>$d['cid'],'aid'=>$d['aid'])}" target="_blank">{$d.title}</a>
                </td>
                <td>
                    {$d.catname}
                </td>
                <td>
                    <a href="__ROOT__/index.php?{$d.uid}" target="_blank">{$d.username}</a>
                    </td>
                <td>{$d.updatetime|date:"Y-m-d",@@}</td>
                <td>
                    <a href="{|U:'Index/Article/show',array('mid'=>$mid,'cid'=>$d['cid'],'aid'=>$d['aid'])}" target="_blank">
                        访问</a>
                </td>
            </tr>
        </list>
    </table>
    <div class="hd-page">
        {$page}
    </div>

    <input type="button" class="hd-btn hd-btn-xm" value="全选" onclick="select_all('.table2')"/>
    <input type="button" class="hd-btn hd-btn-xm" value="反选" onclick="reverse_select('.table2')"/>
    <input type="button" class="hd-btn hd-btn-xm" onclick="batchDel({$mid})" value="批量删除"/>
    <input type="button" class="hd-btn hd-btn-xm" onclick="audit({$mid})" value="审核"/>
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
        var aid=$("input[name*=aid]:checked").serialize();
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
                hd_ajax('{|U:"batchDel",array("mid"=>$_GET['mid'],"cid"=>$_GET["cid"])}', aid, '__URL__');
            }
        });
    }
    /**
     * 设置状态
     */
    function audit(mid) {
        var url = CONTROLLER + "&a=audit" + "&mid="+mid;
        var aid=$("input[name*=aid]:checked").serialize();
        if (aid) {
            hd_ajax(url, aid, '__URL__',1);
        } else {
            hd_alert({
                message: '请选择文章',//显示内容
                timeout: 2
            })
        }
    }
</script>
</body>
</html>