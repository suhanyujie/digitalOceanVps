$(function () {
    parentIframeHeight();
})
function parentIframeHeight() {
    var h = $(document).height() + 120;
    $(parent.document).find('iframe#comment').height(h);
}
$(function () {
    $(".c-user-name").on('click', function (e) {
        var username = $.trim($(this).text());
        username= username.replace(/\W/ig,'');
        var url = root + "/index.php?m=Member&c=Space&a=index&username=" + username;
        window.open(url);
    });
})
/**
 * 添加评论
 * @param obj
 */
function addComment(obj) {
    //纯文本内容
    var content_text = $.trim($("#comment_content").val());
    //内容检测
    if (content_text.length < 5) {
        alert('回复内容字数不得少于 5个字');
        return false;
    }
    var data = $(obj).serialize();
    //清除文本框
    $("#comment_content").val('')
    //回复内容
    $.post('?g=Addon&m=Comment&c=Comment&a=addComment', data, function (json) {
        if (json.status) {
            $('.comment-form').before(json.message);
            $("#total").html($.trim($("#total").html()) * 1 + 1);
            parentIframeHeight();
            SyntaxHighlighter.all();
        } else {
            alert(json.message);
        }
    }, 'JSON');
    return false;
}
/**
 * 删除评论
 * @param comment_id
 */
function delComment(comment_id) {
    if (!confirm('确定删除吗？'))return;
    $.post("?g=Addon&m=Comment&c=Comment&a=delComment", {comment_id: comment_id}, function (data) {
        if (data.status) {
            $("#c-" + comment_id).remove();
            $("#total").html($("#total").text() * 1 - 1);
            parentIframeHeight();
        } else {
            alert(data.message);
        }
    }, 'json');
}
/**
 * 点赞
 */
function praise(obj, comment_id) {
    $.post('?g=Addon&m=Comment&c=Comment&a=praise', {comment_id: comment_id}, function (data) {
        if (data.status) {
            $(obj).html('赞 (' + data.message + ')');
        }
    }, 'json');
}

/**
 * 删除回复框
 */
function hideReplyForm(obj) {
    $(obj).parents('.reply-form').eq(0).hide();
    parentIframeHeight();
}
/**
 * 回复文字链接
 */
function reply(obj, user) {
    $('.reply-form').hide();
    $(obj).parents('.comment-body').eq(0).find('.reply').show();
    //表单
    var f = $(obj).parents('.comment-body').eq(0).find(".reply-form");
    var content = user ? '@' + user + ':' : '';
    f.find("[name='reply_content']").val(content);
    f.show();
    //滚动到文本框
    $("html,body").animate({scrollTop: f.offset().top}, 1000);
    parentIframeHeight();

}
/**
 * 添加回复
 * @param obj
 */
function addReply(obj, comment_id) {
    if ($(obj).find("[name='reply_content']").val().length < 5) {
        alert('回复不能小于5个字');
        return false;
    }
    var data = $(obj).serialize();
    $.post('?g=Addon&m=Comment&c=Reply&a=addReply', data, function (data) {
        if (data.status) {
            $(obj).parents('.reply').eq(0).find('.reply-list').append(data.message);
            $(obj).find("[name='reply_content']").val('');
            parentIframeHeight();
        } else {
            alert(data.message);
        }
    }, 'json');
    return false;
}
/**
 * 删除回复
 * @param reply_id
 */
function delReply(comment_id, reply_id) {
    $.post('?g=Addon&m=Comment&c=Reply&a=delReply', {reply_id: reply_id}, function (data) {
        if (data.status) {
            $("#r-" + reply_id).remove();
            parentIframeHeight();
        }
    }, 'json');
}