<include file="__PUBLIC__/header"/>
<body>
<div class="hd-menu-list">
    <ul>
        <li><a href="{|U:'Model/index'}">模型列表</a></li>
        <li class="active"><a href="#">字段列表</a></li>
        <li><a href="{|U:'add',array('mid'=>$_GET['mid'])}">添加字段</a></li>
        <li>
            <a href="javascript:;"
               onclick="hd_ajax('{|U:updateCache}',{mid:{$hd.get.mid}},'__URL__',1)">更新缓存</a>
        </li>
    </ul>
</div>
<form method="post" onsubmit="return hd_submit(this,'{|U:'updateSort'}','__URL__',2)">
    <table class="hd-table hd-table-list hd-form">
        <thead>
        <tr>
            <td class="hd-w50">排序</td>
            <td class="hd-w50">Fid</td>
            <td class="hd-w200">描述</td>
            <td>字段名</td>
            <td class="hd-w200">表名</td>
            <td class="hd-w100">类型</td>
            <td class="hd-w80">系统</td>
            <td class="hd-w80">必填</td>
            <td class="hd-w80">搜索</td>
            <td class="hd-w80">投稿</td>
            <td class="hd-w120">操作</td>
        </tr>
        </thead>
        <tbody>
        <list from="$field" name="$f">
            <tr>
                <td>
                    <input type="text" name="fieldsort[{$f.fid}]" class="hd-w30"
                           value="{$f.fieldsort}"/>
                </td>
                <td>
                    {$f.fid}
                </td>
                <td>{$f.title}</td>
                <td>{$f.field_name}</td>
                <td>{$f.table_name}</td>
                <td>{$f.field_type}</td>
                <td>
                    <if value="$f.is_system">
                        <font color="red">√</font>
                        <else/>
                        <font color="blue">×</font>
                    </if>
                </td>
                <td>
                    <if value="$f.required">
                        <font color="red">√</font>
                        <else/>
                        <font color="blue">×</font>
                    </if>
                </td>
                <td>
                    <if value="$f.issearch">
                        <font color="red">√</font>
                        <else/>
                        <font color="blue">×</font>
                    </if>
                </td>
                <td>
                    <if value="$f.isadd">
                        <font color="red">√</font>
                        <else/>
                        <font color="blue">×</font>
                    </if>
                </td>
                <td>
                    <?php if (in_array($f['field_name'], $noallowedit)) { ?>
                        <span style='color:#666'>编辑</span>
                    <?php } else { ?>
                        <a href="{|U:'edit',array('mid'=>$f['mid'],'fid'=>$f['fid'])}">修改</a>
                    <?php } ?>
                    |
                    <?php if (in_array($f['field_name'], $noallowforbidden)) { ?>
                        <span style='color:#666'>禁用</span>
                    <?php } else if ($f['status'] == 1) { ?>
                        <a href="javascript:hd_ajax('{|U:forbidden}',{fid:{$f.fid},status:0,mid:{$f.mid}},'__URL__',1)">禁用</a>
                    <?php } else { ?>
                        <a href="javascript:hd_ajax('{|U:forbidden}',{fid:{$f.fid},status:1,mid:{$f.mid}},'__URL__',1)"style='color:red'>启用</a>
                    <?php } ?>
                    |
                    <?php if (in_array($f['field_name'], $noallowdelete)): ?>
                        <span style='color:#666'>删除</span>
                    <?php else: ?>
                        <a href="javascript:" onclick="javascript:delField({$f.fid})">删除</a>
                    <?php endif; ?>
                </td>
            </tr>
        </list>
        </tbody>
    </table>
    <input type="submit" class="hd-btn" value="排序"/>
</form>
<script>
    function delField(fid) {
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
                hd_ajax('{|U:"del"}', {fid: fid}, '__URL__',1);
            },
            cancel: function () {//点击关闭后的事件

            }
        });
    }
</script>
</body>
</html>