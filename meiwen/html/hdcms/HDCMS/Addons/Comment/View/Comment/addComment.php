<div class="comment-list" id="c-{$field.comment_id}">
    <div class="icon">
        <img src="{$field.icon|icon}"/>
    </div>
    <div class="comment-body">
        <div class="comment-author">
            <a href="javascript:;" class="c-user-name">{$field.username}</a>
        </div>
        <div class="comment-content">
           {$field.comment_content|ContentSecurity}
        </div>
        <div class="comment-info">
            <div class="comment-time">
                {$field.comment_time|date_before}
            </div>
        </div>
    </div>
</div>