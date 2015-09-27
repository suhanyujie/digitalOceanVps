<?php
require_cache(MODULE_PATH . 'Lib/function.php');

/**
 * 个人空间
 * Class SpaceController
 */
class SpaceController extends Controller
{
    private $uid;

    public function __init()
    {
        //用户名
        if ($username = Q('username')) {
            $uid = M('user')->where("username='$username'")->getField('uid');
            go(U("index", array('uid' => $uid)));
        }
        $this->uid = Q('uid', 0, 'intval');
        if (!M('user')->find($this->uid)) {
            $this->error('会员不存在');
        }
    }

    //空间首页
    public function index()
    {
        $user = M('user')->find($this->uid);
        $this->assign('user', $user);
        //记录访客信息
        $this->assign('guest', $this->RecordGuest());
        //文章
        $mid = Q('mid', 1, 'intval');
        $modelCache = S('model');
        $table = $modelCache[$mid]['table_name'];
        $ContentModel = V($table);
        $ContentModel->view[$table] = array('_type' => "INNER");
        $ContentModel->view['category'] = array('_type' => 'INNER', '_on' => "category.cid={$table}.cid");
        $where['_string'] = "uid={$this->uid}";
        $page = new Page($ContentModel->where($where)->count(), 9);
        $data = $ContentModel->where($where)->limit($page->limit())->order('arc_sort ASC,addtime DESC')->all();
        $this->assign('data', $data);
        $this->assign('page', $page->show());
        $this->assign('model', $modelCache);
        $this->assign('model_name', $modelCache[$mid]['model_name']);
        $this->display();
    }

    //记录访客信息
    private function RecordGuest()
    {
        //增加空间访问数
        M('user')->inc('spec_num', 'uid=' . $this->uid, 1);
        $db = M('user_guest');
        //记录
        if (isset($_SESSION['user'])) {
            $guest = array(
                'space_uid' => $this->uid,
                'guest_uid' => $_SESSION['user']['uid'],
                'entertime' => time()
            );
            $db->add($guest);
        }
        $user = $db->field('uid,nickname,username,icon')->join('__user__ u JOIN __user_guest__ g ON u.uid=g.guest_uid')->group('u.uid')
            ->where("space_uid=".$this->uid)
            ->limit(24)->all();
        return $user;
    }
}