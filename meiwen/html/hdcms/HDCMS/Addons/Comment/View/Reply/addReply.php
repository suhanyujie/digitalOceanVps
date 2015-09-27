<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="__STATIC__/jquery-1.11.1.min.js"></script>
<!--代码高亮-->
<script type="text/javascript" src="__STATIC__/SyntaxHighlighter/scripts/shCore.js"></script>
<script type="text/javascript" src="__STATIC__/SyntaxHighlighter/scripts/shBrushPhp.js"></script>
<link type="text/css" rel="stylesheet" href="__STATIC__/SyntaxHighlighter/styles/shCore.css">
<link type="text/css" rel="stylesheet" href="__STATIC__/SyntaxHighlighter/styles/shThemeDefault.css">
<script type="text/javascript">
    SyntaxHighlighter.config.clipboardSwf = '__STATIC__/SyntaxHighlighter/scripts/clipboard.swf';
    SyntaxHighlighter.all();
</script>
<css file="__STATIC__/hdjs/hdjs.css"/>
<script type="text/javascript" src="__STATIC__/hdjs/hdjs.min.js"></script>
<js file="__APP__/Addons/Comment/View/Comment/js/comment.js"/>
<css file="__APP__/Addons/Comment/View/Comment/css/css.css"/>
<!--内容Start-->
<div class="reply-body" id="r-{$field.reply_id}">
    <div class="reply-icon">
        <img src="{$field.icon|icon}"/>
    </div>
    <div class="reply-box">
        <div class="reply-author">
            <div class="user">
                <a href="javascript:;" class="c-user-name">{$field.username}</a> • 1 分钟前
            </div>
            <div class="reply-del">
                <a href="javascript:;" onclick="delReply({$field.comment_id},{$field.reply_id},'{|U:'Reply/delReply'}')">删除</a>
            </div>
        </div>
        <div class="reply-content">
            {$field.reply_content|ContentSecurity}
        </div>
    </div>
</div>
<!--内容End-->