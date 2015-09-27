<include file="__PUBLIC__/header"/>
<body>
    <div class="hd-title-header">友情提示</div>
    <div class="help">
        <ul>
            <li>
                1. HDCMS官网不断更新免费优质模板 <a href="http://www.hdphp.com" class="action" target="_blank">立刻获取</a>
            </li>
            <li>
                2. 非HDCMS官网提供的模板，可能存在恶意木马程序
            </li>
            <li>
                3. 你需要了解HDCMS标签，才可以灵活编辑模板，当然这很简单 >>><a href="http://www.hdphp.com" target="_blank">获得视频教程</a>
            </li>
        </ul>
    </div>
    <div class="hd-title-header">当前模板</div>
    <div class="tpl-list">
        <ul>
            <list from="$style" name="$t">
                <li <if value="$t.current==1">class="active current"</if>>
                    <img src="{$t.image}" width="260"/>
                    <h2>{$t.name}</h2>
                    <p>作者: {$t.author}</p>
                    <p>Email: {$t.email}</p>
                    <p>目录: {$t.filename}</p>

                    <div class="link">
                        <if value="$t.current neq 1">
                            <a href="javascript:;" class="btn" attr='select_tpl' onclick="hd_ajax('{|U:selectStyle}', {dirName:'{$t.filename}'}, '__URL__',1)">使用</a>
                       <else/>
                        <strong>使用中...</strong>
                        </if>
                    </div>
                </li>
            </list>
        </ul>
    </div>
<style type="text/css">
    a:hover {
        text-decoration: underline;
    }

    div.tpl-list ul li {
        float: left;
        margin: 10px;
        height: auto;
        overflow: hidden;
        background: #efefef;
        border: solid 5px #DDDDDD;
        padding-bottom: 2px;
        position: relative;
    }

    div.tpl-list ul li.current {
        border: solid 5px #09AEEF;
        background: #09AEEF;
        color: #ffffff;
    }

    div.tpl-list ul li.current a, div.tpl-list ul li.current h2 {
        color: #ffffff;
    }

    div.tpl-list ul li.current img {
        opacity: 1;
    }

    div.tpl-list ul li img {
        width: 230px;
        height: 260px;
        border-bottom: solid 2px #DCDCDC;
        margin-bottom: 6px;
        opacity: 0.5;
    }

    div.tpl-list ul li h4 {
        font-size: 18px;
        padding-left: 10px;
        color: #333333;
        margin-bottom: 5px;
    }

    div.tpl-list ul li h4 strong {
        font-size: 12px;
        color: #03565E;
        font-weight: normal;
    }

    div.tpl-list ul li h2 {
        font-size: 18px;
        font-weight: bold;
        padding-left: 10px;
        margin-bottom: 5px;
        color: #333;
    }

    div.tpl-list ul li p {
        font-size: 12px;
        padding-left: 10px;
        margin: 0px;
    }

    div.tpl-list ul li div.link {
        padding-left: 10px;
        margin-top: 6px;
        padding-top: 5px;
    }

    div.tpl-list ul li div.link a, div.tpl-list ul li div.link strong {
        font-size: 16px;
        padding: 2px 8px 0px 0px;
        line-height: 25px;
    }
</style>
<script>
    //改变li样式
    $(".tpl-list li").mouseover(function () {
        $(this).addClass("active")
    }).mouseout(function () {
        $(this).removeClass("active")
    })
</script>
</body>
</html>