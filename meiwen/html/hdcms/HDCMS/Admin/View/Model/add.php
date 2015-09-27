<include file="__PUBLIC__/header"/>
<body>
<form action="{|U:'add'}" method="post" class="hd-form" onsubmit="return hd_submit(this,'__ACTION__','{|U:index}')">
    <div class="hd-menu-list">
        <ul>
            <li><a href="{|U:'index'}">模型列表</a></li>
            <li class="active"><a href="#">添加模型</a></li>
        </ul>
    </div>
    <div class="hd-title-header">温馨提示</div>
    <div class="help">
        <ul>
            <li>自定义模型对于新手来讲，不太好理解。请登录
                <a href="http://www.hdphp.com" target="_blank">hdphp.com</a>下载视频学习
            </li>
        </ul>
    </div>
    <div class="hd-title-header">
        添加模型
    </div>
    <div class="right_content">
        <table class="hd-table hd-table-form">
            <tr>
                <th class="hd-w100">模型名称 <span class="star">*</span> </th>
                <td>
                    <input type="text" name="model_name" class="w200"/>
                </td>
            </tr>
            <tr>
                <th>表名 <span class="star">*</span></th>
                <td>
                    <input type="text" name="table_name" class="w200"/>
                </td>
            </tr>
            <tr>
                <th>模型描述 </th>
                <td>
                    <textarea name="description" class="hd-w350 hd-h80"></textarea>
                </td>
            </tr>
            <tr>
                <th>模型状态</th>
                <td>
                    <label>
                        <input type="radio" name="enable" value="1" checked=""/> 开启模型
                    </label>
                    <label>
                        <input type="radio" name="enable" value="0"/> 关闭模型
                    </label>
                </td>
            </tr>
            <tr>
                <th>允许投稿</th>
                <td>
                    <label>
                        <input type="radio" name="contribute" value="1" checked=""/> 允许投稿
                    </label>
                    <label>
                        <input type="radio" name="contribute" value="0"/> 禁止投稿
                    </label>
                </td>
            </tr>
        </table>
    </div>
    <input type="submit" value="确定" class="hd-btn hd-btn-sm"/>
</form>
</body>
</html>