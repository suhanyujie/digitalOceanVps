<include file="__PUBLIC__/header"/>
<body>
<div class="hd-menu-list">
    <ul>
        <li class="active"><a href="{|U:'webConfig'}">网站配置</a></li>
        <li><a href="{|U:'add'}">添加配置</a></li>
        <li><a href="javascript:hd_ajax('{|U:updateCache}',{},'__URL__')">更新缓存</a></li>
    </ul>
</div>
<div class="hd-title-header">温馨提示</div>
<div class="help">
    <ul>
        <li>模板中使用配置项方法为<literal>{$hd.config.变量名}</literal>，请仔细修改配置项，不当设置将影响网站的性能与安全</li>
    </ul>
</div>
<form class="hd-form" onsubmit="return hd_submit(this,'{|U:'webConfig'}','__URL__')">

        <div class="hd-tab">
            <ul class="hd-tab-menu">
                <list from="$data" name="$d">
                    <li lab="{$d.cgname}" <if value="$hd.list.d.first">class="active"</if>>
                        <a href="#">{$d.cgtitle}</a>
                    </li>
                </list>
            </ul>
            <div class="hd-tab-content">
                <list from="$data" name="$d">
                    <div lab="{$d.cgname}" class="hd-tab-area">
                        <table class="hd-table hd-table-form">
                            <thead>
                                <tr style="background: #E6E6E6;">
                                    <th class="hd-w50">排序</th>
                                    <th class="hd-w200">标题</th>
                                    <th>配置</th>
                                    <th class="hd-w300">变量</th>
                                    <th class="hd-w300">描述</th>
                                </tr>
                            </thead>
                            <list from="$d._config" name="$c">
                                <tr>
                                    <td>
                                        <input type="text" name="config[{$c.id}][order_list]" value="{$c.order_list}"
                                               class="hd-w30"/>
                                        <input type="hidden" name="config[{$c.id}][id]" value="{$c['id']}"/>
                                    </td>
                                    <td>{$c.title}
                                        <if value="$c.system eq 0">
                                            <a href="javascript:del({$c.id})">删除</a>
                                        </if>
                                    </td>
                                    <td>{$c._html}</td>
                                    <td>{$c.name}</td>
                                    <td>{$c.message}</td>
                                </tr>
                            </list>
                        </table>
                    </div>
                </list>
            </div>
        </div>
        <input type="submit" class="hd-btn" value="确定"/>
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