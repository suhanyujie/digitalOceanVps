<?php
require_cache(APP_PATH . 'Addons/Comment/Lib/function.php');
/**
 * Comment 插件
 * @author 后盾向军 <houdunwangxj@gmail.com>
 */
class AdminController extends AddonController
{

    public function index()
    {
        $db = K('Comment');
        $page = new Page($db->count(), 10);
        $data = $db->limit($page->limit())->all();
        $this->assign('data', $data);
        $this->assign('page', $page->show());
        $this->display();
    }

    public function del()
    {
        $comment_id = Q('comment_id');
        $db = K('Comment');
        $db->del($comment_id);
        M('addon_comment_praise')->where("comment_id=$comment_id")->del();
        M('addon_comment_reply')->where("comment_id=$comment_id")->del();
        $this->success('删除成功');
    }

    //批量删除
    public function BulkDel()
    {
        $map['comment_id'] = array('IN', $_POST['comment_id']);
        $db = K('Comment');
        $db->where($map)->del();
        M('addon_comment_praise')->where($map)->del();
        M('addon_comment_reply')->where($map)->del();
        $this->success('删除成功');
    }

    //预览评论
    public function preview()
    {
        $map['cid'] = array('EQ', $_GET['cid']);
        $map['aid'] = array('EQ', $_GET['aid']);
        $map['c.comment_id']=array('EQ',$_GET['comment_id']);
        $data = M('addon_comment')->field('c.comment_id,c.user_id,icon,username,comment_content,comment_time,praise,cid,aid,status,count(r.reply_id) AS reply_count')
            ->join('__user__ u JOIN __addon_comment__ c ON u.uid=c.user_id LEFT JOIN __addon_comment_reply__ r ON c.comment_id=r.comment_id')->group('c.comment_id')
            ->where($map)->all();
        //回复数据
        foreach($data as $id=>$d){
            $data[$id]['reply']= M('addon_comment_reply')->join("__addon_comment_reply__ a JOIN __user__ u ON a.user_id=u.uid")
                ->where("comment_id={$d['comment_id']}")->all();
        }
        $this->assign('data', $data);
        $this->display();
    }
}