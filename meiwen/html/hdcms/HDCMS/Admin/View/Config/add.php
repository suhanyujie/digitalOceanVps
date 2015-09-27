<include file="__PUBLIC__/header"/>
<body>
<div class="hd-menu-list">
    <ul>
        <li><a href="{|U:'webConfig'}">网站配置</a></li>
        <li class="active"><a href="{|U:'add'}">添加配置</a></li>
    </ul>
</div>
<div class="hd-title-header">
    添加配置
</div>
<form class="hd-form" onsubmit="return hd_submit(this,'{|U:add}','{|U:'webConfig'}')">
    <input type="hidden" name="type" value="custom"/>
    <table class="hd-table hd-table-form">
        <tr>
            <th class="hd-w100">标题（中文）</th>
            <td>
                <input type="text" name="title" class="hd-w200"/>
            </td>
        </tr>
        <tr>
            <th class="hd-w100">变量名(英文)</th>
            <td>
                <input type="text" name="name" class="hd-w200"/>
                <span class="hd-validate-notice">大写英文字母</span>
            </td>
        </tr>
        <tr>
            <th>提示信息</th>
            <td>
                <textarea name="message" class="hd-w350 hd-h80"></textarea>
            </td>
        </tr>
        <tr>
            <th>配置组</th>
            <td>
                <select name="cgid" class="hd-w200">
                    <list from="$configGroup" name="$g">
                        <option value="{$g.cgid}">{$g.cgtitle}</option>
                    </list>
                </select>
            </td>
        </tr>
        <tr>
            <th>显示方法</th>
            <td>
                <label>
                    <input type="radio" name="show_type" value="text" checked=""/> text
                </label>
                <label>
                    <input type="radio" name="show_type" value="radio"/> radio
                </label>
                <label>
                    <input type="radio" name="show_type" value="textarea"/> textarea
                </label>
                <label>
                    <input type="radio" name="show_type" value="select"/> select
                </label>
            </td>
        </tr>
        <tr>
            <th>配置值</th>
            <td>
                <input type="text" name="value" class="hd-w200"/>
            </td>
        </tr>
        <tr>
            <th>参数（对radio与select有效)</th>
            <td>
                <textarea name="info" class="hd-w350 hd-h100"></textarea>
                <span class="hd-validate-notice">如：1|开启,0|关闭</span>
            </td>
        </tr>

    </table>
    <input type="submit" value="确定" class="hd-btn"/>
</form>
</body>
</html>