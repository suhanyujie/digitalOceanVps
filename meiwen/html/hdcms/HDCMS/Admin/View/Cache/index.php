<include file="__PUBLIC__/header"/>
<body>
<form method="post" action="{|U:'index'}" class="hd-form">
    <div class="hd-title-header">
        温馨提示
    </div>
    <div class="help">
        首次安装必须更新全站缓存
    </div>
    <div class="hd-title-header">
        更新缓存
    </div>
    <table class="hd-table hd-table-form hd-form">
        <tr>
            <th class="hd-w100">选择更新</th>
            <td>
                <table class="hd-table hd-table-list">
                    <tr>
                        <td><label>
                                <input type="checkbox" name="Action[]" value="Config" checked=''/>
                                更新网站配置 </label></td>
                    </tr>
                    <tr>
                        <td><label>
                                <input type="checkbox" name="Action[]" value="Model" checked=''/>
                                内容模型 </label></td>
                    </tr>
                    <tr>
                        <td><label>
                                <input type="checkbox" name="Action[]" value="Field" checked=''/>
                                模型字段 </label></td>
                    </tr>
                    <tr>
                        <td><label>
                                <input type="checkbox" name="Action[]" value="Category" checked=''/>
                                栏目缓存 </label></td>
                    </tr>
                    <tr>
                        <td><label>
                                <input type="checkbox" name="Action[]" value="Node" checked=''/>
                                权限节点 </label></td>
                    </tr>
                    <tr>
                        <td><label>
                                <input type="checkbox" name="Action[]" value="Role" checked=''/>
                                会员角色 </label></td>
                    </tr>
                    <tr>
                        <td><label>
                                <input type="checkbox" name="Action[]" value="Flag" checked=''/>
                                内容FLAG </label></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <input type="submit" value="开始更新" class="hd-btn"/>
</form>
</body>
</html>