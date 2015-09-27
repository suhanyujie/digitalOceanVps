<?php
require_cache(APP_PATH . 'Addons/Comment/Lib/function.php');

/**
 * 回复处理
 * Class ReplyController
 */
class ReplyController extends Controller
{
    /**
     * 回复列表
     */
    public function index()
    {
        $comment_id = Q('comment_id', 0, 'intval');
        $map['comment_id'] = array('EQ', $comment_id);
        $reply = M('addon_comment_reply')->join("__addon_comment_reply__ a JOIN __user__ u ON a.user_id=u.uid")
            ->where($map)->all();
        if (!IS_LOGIN&&empty($reply)) {
            $this->error('没有回复');
        } else {
            $this->assign('reply', $reply);
            $comment = M('addon_comment')->find($comment_id);
            $this->assign('comment', $comment);
            $this->success($this->fetch());
        }
    }

    /**
     * 添加回复
     */
    public function addReply()
    {
        if (empty($_SESSION['user'])) {
            $this->error('请登录');
        }
        if (empty($_POST['reply_content'])) {
            $this->error('内容不能为空');
        }
        //回复时间检测
        $replyTime = session('replytime');
        $config = $this->getConfig();
        if ($config['REPLY_TIME'] > 0 && ($replyTime + $config['REPLY_TIME'] > time())) {
            $this->error('你回复的有点快了..');
        }
        session('replytime',time());
        $_POST['user_id'] = $_SESSION['user']['uid'];
        $_POST['reply_time'] = time();
        $reply_id = M('addon_comment_reply')->add();
        if ($reply_id) {
            $field = M('addon_comment_reply')->join("__addon_comment_reply__ a JOIN __user__ u ON a.user_id=u.uid")
                ->find($reply_id);
            $this->assign('field', $field);
            $content = $this->fetch();
            $this->success($content);
        } else {
            $this->error('回复失败');
        }
    }

    /**
     * 删除回复
     */
    public function delReply()
    {
        $reply_id = Q('reply_id', 0, 'intval');
        $map['user_id'] = $_SESSION['user']['uid'];
        $map['reply_id'] = $reply_id;
        $status = M('addon_comment_reply')->where($map)->del();
        if ($status) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
}