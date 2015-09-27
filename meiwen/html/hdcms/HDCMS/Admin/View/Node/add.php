<include file="__PUBLIC__/header"/>
<body>
<div class="hd-menu-list">
    <ul>
        <li><a href="{|U:'index'}">菜单管理</a></li>
        <li class="active"><a href="javascript:;">添加菜单</a></li>
    </ul>
</div>
<div class="hd-title-header">菜单信息</div>
<form onsubmit="return hd_submit(this,'__ACTION__','{|U:index}')">
    <table class="hd-table hd-table-form hd-form">
        <tr>
            <th class="hd-w100">上级</th>
            <td>
                <select name="pid">
                    <option value="0">一级菜单</option>
                    <list from="$node" name="$n">
                        <option value="{$n.nid}"
                        <if value="$n.nid==$hd.get.pid">selected="selected"</if>
                        >{$n._name}</option>
                    </list>
                </select>
            </td>
        </tr>
        <tr>
            <th>名称 <span class="star">*</span></th>
            <td>
                <input type="text" name="title" class="hd-w200"/>
            </td>
        </tr>
        <tr>
            <th>模块 <span class="star">*</span></th>
            <td>
                <input type="text" name="module" class="hd-w200"/>
            </td>
        </tr>
        <tr>
            <th>控制器 <span class="star">*</span></th>
            <td>
                <input type="text" name="controller" class="hd-w200"/>
            </td>
        </tr>
        <tr>
            <th>动作 <span class="star">*</span></th>
            <td>
                <input type="text" name="action" class="hd-w200"/>
            </td>
        </tr>
        <tr>
            <th>参数</th>
            <td>
                <input type="text" name="param" class="hd-w300"/>
                <span class="hd-validate-notice">例:cid=1&mid=2</span>
            </td>
        </tr>
        <tr>
            <th>备注</th>
            <td>
                <textarea name="comment" class="hd-w350 hd-h100"></textarea>
            </td>
        </tr>
        <tr>
            <th>状态</th>
            <td>
                <label><input type="radio" name="is_show" value="1" checked="checked"> 显示</label>
                <label><input type="radio" name="is_show" value="0"> 隐藏</label>
            </td>
        </tr>
        <tr>
            <th>类型</th>
            <td>
                <select name="type">
                    <option value="1">菜单+权限控制</option>
                    <option value="2">普通菜单</option>
                </select>
            </td>
        </tr>
    </table>
    <input type="submit" class="hd-btn" value="提交"/>
</form>
</body>
</html>