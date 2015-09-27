/**
 * 删除回复框
 */
function delReplyBox(obj) {
    $(obj).parents('.reply').eq(0).remove();
}
/**
 * 回复文字链接
 */
function replyLink(obj,user){
    $(obj).parents('.reply').find("[name='reply_content']").val(user);
}
/**
 * 添加回复
 * @param obj
 */
function addReply(obj,comment_id) {
    if($(obj).find("[name='reply_content']").val().length<5){
        alert('回复不能小于5个字');
        return false;
    }
    var data = $(obj).serialize();
    var action = $(obj).attr('action');
    $.post(action, data, function (data) {
        if (data.status) {
            $(obj).parents('.reply').eq(0).find('.reply-list').append(data.message);
            $(obj).find("[name='reply_content']").val('');
            updateReplyNum(comment_id);
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
function delReply(comment_id,reply_id,url) {
    $.post(url, {reply_id: reply_id}, function (data) {
        if (data.status) {
            $("#r-"+reply_id).remove();
            updateReplyNum(comment_id);
        }
    }, 'json');
}
/**
 * 修改回复数
 * @param comment_id
 */
function updateReplyNum(comment_id){
    var obj = $("#c-"+comment_id).find('span.reply_num');
    obj.html($("#c-"+comment_id).find('.reply-body').length);
}