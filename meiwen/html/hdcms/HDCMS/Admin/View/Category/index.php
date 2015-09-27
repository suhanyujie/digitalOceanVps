<include file="__PUBLIC__/header"/>
<body>
<form action="{|U:'BulkEdit'}" method="post">
    <div class="hd-menu-list">
        <ul>
            <li class="active">
                <a href="{|U:index}">栏目列表</a>
            </li>
            <li>
                <a href="{|U:'add'}">添加顶级栏目</a>
            </li>
            <li>
                <a href="javascript:hd_ajax('{|U:updateCache}',{},'__URL__',1)">更新栏目缓存</a>
            </li>
        </ul>
    </div>
    <table class="hd-table hd-table-list hd-form">
        <thead>
        <tr>
            <td class="hd-w30">
                <input type="checkbox" class="select_all"/>
            </td>
            <td class="hd-w30">cid</td>
            <td class="hd-w50">排序</td>
            <td>栏目名称</td>
            <td class="hd-w100">类型</td>
            <td class="hd-w100">模型</td>
            <td class="hd-w180">操作</td>
        </tr>
        </thead>
        <tbody>
        <list from="$category" name="$c">
            <tr <if value="$c.pid eq 0">class="top"</if>>
            <td>
                <input type="checkbox" name="cid[]" value="{$c.cid}"/>
            </td>
            <td>{$c.cid}</td>
            <td>
                <input type="text" class="hd-w30" value="{$c.catorder}" name="list_order[{$c.cid}]"/>
            </td>
            <td>
                <if value="$c.pid eq 0 && Data::hasChild(S('category'),$c.cid)">
                    <img src="__STATIC__/image/contract.gif" action="2" class="explodeCategory"/>
                </if>
                <if value="$c.pid eq 0">
                    <strong>{$c._name}</strong>
                    <else/>
                    {$c._name}
                </if>
            </td>
            <td>{$c.cat_type_name}</td>
            <td>{$c.model_name}</td>
            <td>
                <a href="{|U:'Index/Category/index',array('mid'=>$c['mid'],'cid'=>$c['cid'])}" target="_blank">
                    访问
                </a>
                <span class="line">|</span>
                <a href="{|U:'add',array('pid'=>$c['cid'],'mid'=>$c['mid'])}">
                    添加子栏目
                </a>
                <span class="line">|</span>
                <a href="{|U:'edit',array('cid'=>$c['cid'])}">
                    修改
                </a>
                <span class="line">|</span>
                <a href="javascript:delCategory({$c.cid})">
                    删除
                </a></td>
            </tr>
        </list>
        </tbody>
    </table>
    <input type="button" class="hd-btn hd-btn-xm" onclick="select_all(1)" value='全选'/>
    <input type="button" class="hd-btn hd-btn-xm" onclick="select_all(0)" value='反选'/>
    <input type="button" class="hd-btn hd-btn-xm" onclick="explodeCategory()" value="收缩"/>
    <input type="button" class="hd-btn hd-btn-xm" onclick="updateOrder()" value="更改排序"/>
    <input type="button" class="hd-btn hd-btn-xm" onclick="BulkEdit()" value="批量编辑"/>
</form>
<style type="text/css">
    img.explodeCategory {
        cursor: pointer;
    }
</style>
<script>
    //展开栏目
    $(".explodeCategory").click(function () {
        var action = parseInt($(this).attr("action"));
        var tr = $(this).parents('tr').eq(0);
        switch (action) {
            case 1://展示
                $(tr).nextUntil('.top').show();
                $(this).attr('action', 2);
                $(this).attr('src', "__STATIC__/image/contract.gif");
                break;
            case 2://收缩
                $(tr).nextUntil('.top').hide();
                $(this).attr('action', 1);
                $(this).attr('src', "__STATIC__/image/explode.gif");
                break;
        }
    })
    //关闭栏目子栏目（隐藏子栏目）
    $(".explodeCategory").trigger('click');
    //全部收起子栏目
    function explodeCategory() {
        $(".explodeCategory").each(function (i) {
            $(this).trigger('click');
        })
    }
    //更新排序
    function updateOrder() {
        //栏目检测
        if ($("input[type='text']").length > 0) {
            var post = $("input[type='text']").serialize();
            hd_ajax("{|U:'updateOrder'}", post, '__URL__', 1);
        }

    }
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
    function delCategory(cid) {
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
                hd_ajax('{|U:"del"}', {cid: cid}, '__URL__');
            }
        });
    }
    //指量编辑
    function BulkEdit() {
        //栏目检测
        if ($("input[type='checkbox']:checked").length == 0) {
            alert('请选择栏目');
            return false;
        }
        var cid = '';
        $("[name='cid[]']:checked").each(function (i) {
            cid += $(this).val() + '|';
        })
        cid = cid.slice(0, -1);
        var url = CONTROLLER + '&a=BulkEdit&cids=' + cid;
        location.href = url;
    }
</script>
</body>
</html>