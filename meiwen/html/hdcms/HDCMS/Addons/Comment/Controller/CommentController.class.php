<?php
require_cache(APP_PATH . 'Addons/Comment/Lib/function.php');

/**
 * 评论模块
 * Class IndexController
 * @author hdxj <2300071698@qq.com>
 */
class CommentController extends Controller
{
    private $cid;
    private $aid;
    private $category;

    public function __init()
    {
        $this->category = S('category');
        $this->cid = Q('cid', 0, 'intval');
        $this->aid = Q('aid', 0, 'intval');
    }

    /**
     * 评论列表
     */
    public function index()
    {
        if (!isset($this->category[$this->cid])) {
            $this->error('栏目不存在');
        }
        if (empty($this->aid)) {
            $this->error('文章不存在');
        }
        $category = S('category');
        $model = S('model');
        $contentData = M($model[$category[$this->cid]['mid']]['table_name'])->find($this->aid);
        if (empty($contentData)) {
            $this->error('文章不存在', __ROOT__);
        }
        $db = M('addon_comment');
        $map['cid'] = array('EQ', $this->cid);
        $map['aid'] = array('EQ', $this->aid);
        $count = $db->where($map)->count();
        $page = new Page($count, 10);
        $data = M('addon_comment')->field('c.comment_id,c.user_id,icon,username,comment_content,comment_time,praise,cid,aid,status,count(r.reply_id) AS reply_count')
            ->join('__user__ u JOIN __addon_comment__ c ON u.uid=c.user_id LEFT JOIN __addon_comment_reply__ r ON c.comment_id=r.comment_id')->group('c.comment_id')
            ->where($map)->limit($page->limit())->all();
        //回复数据
        foreach($data as $id=>$d){
            $data[$id]['reply']= M('addon_comment_reply')->join("__addon_comment_reply__ a JOIN __user__ u ON a.user_id=u.uid")
                ->where("comment_id={$d['comment_id']}")->all();
        }
        $this->assign('data', $data);
        $this->assign('count', $count);
        $this->assign('page',$page);
        $this->display();
        exit;
    }

    //添加评论
    public function addComment()
    {
        $config = $this->getConfig();
        $CommentTime = session('CommentTime');
        if ($config['REPLY_TIME'] > 0 && ($CommentTime + $config['REPLY_TIME'] > time())) {
            $this->error('你回复的有点快了..');
        }else{
            session('CommentTime',time());
        }

        if (!isset($this->category[$this->cid])) {
            $this->error('栏目不存在');
        }
        if (empty($this->aid)) {
            $this->error('文章不存在');
        }
        $db = M('addon_comment');
        if (empty($_SESSION['user'])) {
            $this->error('请登录');
        }
        if (empty($_POST['comment_content'])) {
            $this->error('内容不能为空');
        }
        if (empty($_POST['cid'])) {
            $this->error('栏目不存在');
        }
        if (empty($_POST['aid'])) {
            $this->error('文章不存在');
        }
        $_POST['user_id'] = $_SESSION['user']['uid'];
        $_POST['comment_time'] = time();
        $_POST['praise'] = 0;
        $_POST['status'] = 1;
        if ($comment_id = $db->add()) {
            $field = M('addon_comment')->join('__user__ u JOIN __addon_comment__ c ON u.uid=c.user_id')->find($comment_id);
            $this->assign('field', $field);
            $html = $this->fetch();
            $this->success($html);
        } else {
            $this->error('发表失败');
        }
    }

    /**
     * 修改评论
     */
    public function editComment()
    {
        $comment_id = Q('comment_id', 0, 'intval');
        $map['comment_id'] = $comment_id;
        $map['user_id'] = $_SESSION['user']['uid'];
        $status = M('addon_comment')->where($map)->find();
        if ($status) {
            if (M('addon_comment')->where($map)->save()) {
                $this->success('修改成功');
            } else {
                $this->error('修改失败');
            }
        } else {
            $this->error('回复不存在');
        }
    }

    /**
     * 删除评论
     */
    public function delComment()
    {
        $comment_id = Q('comment_id', 0, 'intval');
        $map['comment_id'] = $comment_id;
        $map['user_id'] = $_SESSION['user']['uid'];
        $status = M('addon_comment')->where($map)->find();
        if ($status) {
            if (M('addon_comment')->where($map)->del()) {
                //删除回复
                M('addon_comment_reply')->where($map)->del();
                //删除点赞
                M('addon_comment_praise')->where($map)->del();
                $this->success('删除成功');
            } else {
                $this->error('删除失败');
            }
        } else {
            $this->error('回复不存在');
        }

    }

    /**
     * 点赞
     */
    public function praise()
    {
        $db = M('addon_comment_praise');
        $comment_id = Q('comment_id', 0, 'intval');
        $map['user_id'] = array('EQ', $_SESSION['user']['uid']);
        $map['comment_id'] = array('EQ', $comment_id);
        $id = $db->where($map)->getField('id');
        $pre = C('DB_PREFIX');
        if ($id) {
            $db->del($id);
            $sql = "UPDATE {$pre}addon_comment set praise=praise-1 where comment_id=".$comment_id;
            M()->exe($sql);
        } else {
            $data['comment_id'] = $comment_id;
            $data['user_id'] = $_SESSION['user']['uid'];
            $db->add($data);
            $sql = "UPDATE {$pre}addon_comment set praise=praise+1 where comment_id=".$comment_id;
            M()->exe($sql);
        }
        $comment = M('addon_comment')->find($comment_id);
        $this->success($comment['praise']);
    }
}






























