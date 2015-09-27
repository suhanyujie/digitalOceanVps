<include file="__PUBLIC__/header.php"/>
<body>
<form method="post" class="hd-form">
    <div class="hd-title-header">
        温馨提示
    </div>
    <div class="help">
        <ul>
            <li>
                1. 开启伪静态与缓存功能性能也是很好的<br/>
                2. 所以可以不用生成静态
            </li>
        </ul>
    </div>
    <?php if (C('CREATE_INDEX_HTML')) { ?>
        <input type="submit" value="生成首页" class="hd-btn"/>
    <?php } else { ?>
        <div class="alert alert-danger" role="alert">首页生成已经关闭，请修改配置项开启</div>
    <?php } ?>
</form>
<style type="text/css">
    div.alert {
        color: #a94442;
        background-color: #f2dede;
        border-color: #ebccd1;
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }
</style>
</body>
</html>