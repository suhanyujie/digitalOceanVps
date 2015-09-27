<include file="__PUBLIC__/header.php"/>
<body>
<div class="hd-menu-list">
    <ul>
        <li class="active">
            <a href="{|U:'index'}">插件列表</a>
        </li>
        <li>
            <a href="{|U:'add'}">创建插件</a>
        </li>
    </ul>
</div>
    <form class="hd-form">
        <table class="hd-table hd-table-list hd-form">
            <thead>
            <tr>
                <td class="hd-w150">名称</td>
                <td class="hd-w100">标识</td>
                <td>描述</td>
                <td class="hd-w60">安装</td>
                <td class="hd-w100">作者</td>
                <td class="hd-w50">版本</td>
                <td class="hd-w200">操作</td>
            </tr>
            </thead>
            <tbody>
            <list from="$data" name="$d">
                <tr>
                    <td>
                        {$d.name}
                    </td>
                    <td>{$d.title}</td>
                    <td>{$d.description}</td>
                    <td>
                        <if value="$d.status">
                            <font color="red">√</font>
                            <else/>
                            <font color="blue">×</font>
                        </if>
                    </td>
                    <td>{$d.author}</td>
                    <td>{$d.version}</td>
                    <td>
                        <a href="javascript:package('{$d.name}')">打包</a>
                        <if value="$d.install">
                            <if value="$d.config">
                                <a href="{|U:'config',array('id'=>$d['id'])}">设置</a>
                            <else/>
                                设置
                            </if>
                            <if value="$d.status">
                                <a href="javascript:disabled('{$d['name']}')">禁用</a>
                            <else/>
                                <a href="javascript:enabled('{$d['name']}')">启用</a>
                            </if>
                            <a href="javascript:uninstall('{$d['title']}','{$d['name']}')">卸载</a>
                        <else/>
                            <a href="javascript:install('{$d['name']}')">安装</a>
                        </if>
                        <if value="$d.IndexAction">
                            <a href="{$d.IndexAction}" target="_blank">前台</a>
                        <else/>
                            前台
                        </if>
                        <if value="$d.help">
                            <a href="{$d.help}" target="_blank">帮助</a>
                        <else/>
                            帮助
                        </if>
                    </td>
                </tr>
            </list>
            </tbody>
        </table>
    </form>
<script>
    //打包
    function package(name){
        hd_ajax("{|U:'package'}",{addon:name},'__URL__');
    }
    //启用
    function enabled(name){
        hd_ajax("{|U:'enabled'}",{addon:name},'__URL__');
    }
    //禁用
    function disabled(name){
        hd_ajax("{|U:'disabled'}",{addon:name},'__URL__');
    }
    //安装
    function install(name){
        hd_ajax("{|U:'install'}",{addon:name},'__URL__');
    }
    //卸载
    function uninstall(title,name){
        if(confirm('确证卸载 【'+title+'】 插件吗？')){
            hd_ajax("{|U:'uninstall'}",{addon:name},'__URL__');
        }
    }
</script>
</body>
</html>