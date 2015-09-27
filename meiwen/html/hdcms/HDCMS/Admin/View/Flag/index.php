<include file="__PUBLIC__/header"/>
<body>
<div class="hd-menu-list">
    <ul>
        <li class="active"><a href="javascript:;">属性管理</a></li>
        <li><a href="{|U:'add',array('mid'=>$_REQUEST['mid'])}">添加属性</a></li>
        <li><a href="javascript:hd_ajax('{|U:updateCache}',{mid:{$hd.request.mid}})">更新缓存</a></li>
    </ul>
</div>
	<form id="search" class="hd-form" onsubmit="return false;">
        <div class="search" id="search">
            模型：
            <select name="mid" class="w100">
                <list from='$model' name="$m">
                <option value="{$m.mid}" <if value="$hd.request.mid eq $m.mid">selected=''</if>>{$m.model_name}</option>
                </list>
            </select>
        </div>
    </form>
    <script>
        $("[name='mid']").change(function(){
        	var mid = $(this).val();
           location.href="{|U:'index'}&mid="+mid;
        })
    </script>

    <form class="hd-form" onsubmit="return hd_submit(this,'{|U:'edit'}','__URL__',1)">
    	<input type="hidden" name="mid" value="{$hd.request.mid}" />
        <table class="hd-table hd-table-form">
            <thead>
            <tr>
                <td class="hd-w100">fid</td>
                <td>属性名称</td>
                <td class="hd-w50">操作</td>
            </tr>
            </thead>
            <tbody>
            <list from="$flag" name="$name">
                <tr>
                    <td>
                        {$name}
                    </td>
                    <td>
                        <input type="text" name="flag[]" value="{$name}"/>
                    </td>
                    <td>
                       <a href="javascript:;" onclick="del({$hd.get.mid},<?php echo $hd['list']['name']['index'] - 1; ?>);">删除
                               </a>
                    </td>
                </tr>
            </list>
            </tbody>
        </table>
        <input type="submit" class="hd-btn hd-btn-sm" id="updateSort" value="修改"/>
    </form>
<script>
    function del(mid,number){
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
                hd_ajax('{|U:"del"}', {mid: mid,number:number}, '__URL__');
            }
        });
    }
</script>
</body>
</html>