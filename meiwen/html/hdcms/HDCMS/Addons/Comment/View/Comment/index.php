<script>
    var root="__ROOT__";
</script>
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

<div id="comment">
    <div class="comment-total">
        <span id="total">{$count}</span> 个回复
    </div>
    <list from="$data" name="$d">
        <div class="comment-list" id="c-{$d.comment_id}">
            <div class="icon">
                <img src="{$d.icon|icon}"/>
            </div>
            <div class="comment-body">
                <div class="comment-author">
                    <a href="javascript:;" class="c-user-name">{$d.username}</a>
                    <div class="comment-time">
                        {$d.comment_time|date_before}
                    </div>
                    <?php if (IS_LOGIN) { ?>
                        <a href="javascript:;" class="praise" onclick="praise(this,{$d.comment_id})">
                            赞({$d.praise})
                        </a>
                    <?php } else { ?>
                        <a href="javascript:;" class="praise" style="color: #777777">
                            赞 ({$d.praise})
                        </a>
                    <?php } ?>
                    <?php if (IS_LOGIN && $d['user_id'] == $_SESSION['user']['uid']) { ?>
                        <a href="javascript:;"  onclick="delComment({$d.comment_id})">删除</a>
                    <?php } ?>
                    <if value="IS_LOGIN">
                    <div class="reply-link">
                        <a href="javascript:;"  onclick="reply(this,'')">
                            回复
                        </a>
                    </div>
                    </if>
                </div>
                <div class="comment-content">
                    {$d.comment_content|ContentSecurity}
                </div>
                <!--回复Start-->
                <div class="reply">
                    <!--回复Start-->
                    <div class="reply-list">
                        <list from="$d.reply" name="$r">
                            <!--内容Start-->
                            <div class="reply-body" id="r-{$r.reply_id}">
                                <div class="reply-icon">
                                    <img src="{$r.icon|icon}"/>
                                </div>
                                <div class="reply-box">
                                    <div class="reply-author">
                                        <div class="user">
                                            <a href="javascript:;" class="c-user-name">{$r.username}</a> • {$r.reply_time|date_before}
                                        </div>
                                        <div class="reply-del">
                                            <?php if(isset($_SESSION['user'])){?>
                                                <?php if($_SESSION['user']['uid']==$r['user_id']){?>
                                                    <a href="javascript:;" onclick="delReply({$r.comment_id},{$r.reply_id})">删除</a>
                                                <?php }?>
                                                <?php if($_SESSION['user']['uid']!=$r['user_id']){?>
                                                    <a href="javascript:;" onclick="reply(this,'{$r.username}')">回复</a>
                                                <?php }?>
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="reply-content">
                                        {$r.reply_content|ContentSecurity}
                                    </div>
                                </div>
                            </div>
                            <!--内容End-->
                        </list>
                    </div>
                    <?php if (IS_LOGIN) { ?>
                        <!--回复框-->
                        <div class="reply-form">
                            <form class="hd-form" onsubmit="return addReply(this,{$d.comment_id})" action="{|U:'addReply'}">
                                <input type="hidden" name="cid" value="{$d.cid}"/>
                                <input type="hidden" name="aid" value="{$d.aid}"/>
                                <input type="hidden" name="comment_id" value="{$d.comment_id}"/>
                                <textarea name="reply_content" class="reply-form" placeholder="评论一下..."></textarea>
                                <br/>
                                <input type="submit" value="确定" class="hd-btn hd-btn-sm"/>
                                <input type="button" value="取消" class="hd-btn hd-btn-sm" onclick="hideReplyForm(this)"/>
                            </form>
                        </div>
                        <!--回复End-->
                    <?php }?>
                </div>
                <!--回复End-->
            </div>
        </div>
    </list>
    <div class="comment-form">
        <?php if (IS_LOGIN) { ?>
                <form action="{|U:'addComment'}" method="post" onsubmit="return addComment(this)">
                    <input type="hidden" name="cid" value="{$hd.get.cid}"/>
                    <input type="hidden" name="aid" value="{$hd.get.aid}"/>
                    <textarea name="comment_content" id="comment_content"></textarea>
                    <div class="submit">
                        <input type="submit" class="hd-btn hd-btn-success" value="评论"/>
                        使用[code][/code]标签可添加代码
                    </div>
                </form>
        <?php } else { ?>
            <p align="center">要回复请先 <a href="__ROOT__/index.php?m=Member&c=Login&a=login" target="_top">
                    登录</a> 或
                <a href="__ROOT__/index.php?m=Member&c=Login&a=reg" target="_top">注册
                </a>
            </p>
        <?php } ?>
    </div>
    <div class="hd-page">
        <?php
        if($page->totalPage>1){
            echo $page->show();
        }?>
    </div>
</div>