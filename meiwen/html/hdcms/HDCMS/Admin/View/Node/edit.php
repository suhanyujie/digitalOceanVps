<include file="__PUBLIC__/header"/>
<body>
<div class="hd-menu-list">
    <ul>
        <li><a href="{|U:'index'}">菜单管理</a></li>
        <li class="active"><a href="__URL__">修改菜单</a></li>
    </ul>
</div>
<div class="hd-title-header">
    菜单信息
</div>
<form onsubmit="return hd_submit(this,'__ACTION__','{|U:index}')">
    <input type="hidden" name="nid" value="{$field.nid}"/>
    <table class="hd-table hd-table-form hd-form">
        <tr>
            <th class="hd-w100">上级</th>
            <td class="pid">
                <select name="pid">
                    <option value="0">一级菜单</option>
                    <list from="$node" name="$n">{$n.level}<br/>
                        <if value="$n._level lt 3">
                            <option value="{$n.nid}"{$n.disabled}<if value="$n.nid==$field.pid">selected="selected"</if>>{$n._name}</option>
                        </if>
                    </list>
                </select>
            </td>
        </tr>
        <tr>
            <th>名称</th>
            <td>
                <input type="text" name="title" class="hd-w200" value="{$field.title}"/>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">模块</th>
            <td>
                <input type="text" name="module" value="{$field.module}" class="hd-w200"/>
            </td>
        </tr>
        <tr>
            <th>控制器</th>
            <td>
                <input type="text" name="controller" value="{$field.controller}" class="hd-w200"/>
            </td>
        </tr>
        <tr>
            <th>动作</th>
            <td>
                <input type="text" name="action" value="{$field.action}" class="hd-w200"/>
            </td>
        </tr>
        <tr>
            <th>参数</th>
            <td>
                <input type="text" name="param" value="{$field.param}" class="hd-w300"/>
                <span class="hd-validate-notice">例:cid=1&mid=2</span>
            </td>
        </tr>
        <tr>
            <th>备注</th>
            <td>
                <textarea name="comment" class="hd-w350 hd-h100">{$field.comment}</textarea>
            </td>
        </tr>
        <tr>
            <th>状态</th>
            <td>
                <label>
                    <input type="radio" name="is_show" value="1"
                    <if value="$field.is_show==1">checked="checked"</if>
                    /> 显示
                </label>
                <label>
                    <input type="radio" name="state" value="0"
                    <if value="$field.is_show==0">checked="checked"</if>
                    /> 隐藏
                </label>
            </td>
        </tr>
        <tr>
            <th>类型:</th>
            <td>
                <select name="type">
                    <option value="1"
                    <if value="$field.status==1">checked="checked"</if>
                    >菜单+权限控制</option>
                    <option value="2"
                    <if value="$field.status==2">checked="checked"</if>
                    >普通菜单</option>
                </select>
            </td>
        </tr>
    </table>
    <input type="submit" value="提交" class="hd-btn"/>
</form>
</body>
</html>