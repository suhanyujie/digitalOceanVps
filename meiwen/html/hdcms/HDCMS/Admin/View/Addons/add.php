<include file="__PUBLIC__/header"/>
<body>
<div class="hd-menu-list">
    <ul>
        <li>
            <a href="{|U:'index'}">插件列表</a>
        </li>
        <li class="active">
            <a href="{|U:'add'}">创建插件</a>
        </li>
    </ul>
</div>

<div class="hd-title-header">
    创建插件
</div>
<form method="post" onsubmit="return hd_submit(this,'__ACTION__','{|U:'index'}')">
        <table class="hd-table hd-table-form hd-form">
            <tr>
                <th class="hd-w120">标识名 <span class="star">*</span></th>
                <td>
                    <input type="text" name="name" class="hd-w200" value="Example"/>
                    <span class="hd-validate-notice">只能是英文字母开头，且首字母大写，标识只能包含英文、数子、下划线</span>
                </td>
            </tr>
            <tr>
                <th>插件名 <span class="star">*</span></th>
                <td>
                    <input type="text" name="title" class="hd-w200" value="示例"/>
                    <span class="hd-validate-notice">插件的中文名称</span>
                </td>
            </tr>
            <tr>
                <th>版本 <span class="star">*</span></th>
                <td>
                    <input type="text" name="version" class="hd-w200" value="1.0"/>
                </td>
            </tr>
            <tr>
                <th>作者 <span class="star">*</span></th>
                <td>
                    <input type="text" name="author" class="hd-w200" value="无名"/>
                </td>
            </tr>

            <tr>
                <th>描述</th>
                <td>
                    <textarea name="description" class="hd-w300 hd-h100">这是一个临时描述</textarea>
                </td>
            </tr>
            <tr>
                <th>插件是否有后台</th>
                <td>
                    <label><input type="checkbox" name="has_adminlist" value="1"/> 有</label>
                    <span class="hd-validate-notice">访问方法:?g=Addon&m=插件名&c=Admin&a=index</span>
                </td>
            </tr>
            <tr>
                <th>开启外部访问</th>
                <td>
                    <label><input type="checkbox" name="has_outurl" value="1"/> 开启</label>
                    <span class="hd-validate-notice">访问方法:?g=Addon&m=插件名&c=Index&a=index</span>
                </td>
            </tr>
            <tr>
                <th>是否需要配置</th>
                <td>
                    <label><input type="checkbox" name="config" value="1" checked=""/> 需要</label>
                </td>
            </tr>
            <tr>
                <th>是否需要模板标签</th>
                <td>
                    <label><input type="checkbox" name="viewTag" value="1"/> 需要</label>
                </td>
            </tr>
            <tr>
                <th>实现的钩子方法</th>
                <td>
                    <select name="hooks[]" multiple="multiple" size="10">
                        <list from="$hooks" name="$h">
                            <option value="{$h.name}">{$h.name} ({$h.description})</option>
                        </list>
                    </select>
                    <span class="hd-validate-notice">如果不挂钩子可以不选择</span>
                </td>
            </tr>
        </table>

    </div>
        <input type="submit" value="确定" class="hd-btn"/>
</form>
</body>
</html>