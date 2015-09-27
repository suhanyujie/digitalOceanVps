<?php

/**
 * 内容页列表
 * Class ContentController
 */
class ContentController extends CommonController
{
    protected $model;
    protected $category;
    private $cid;
    private $aid;
    private $mid;

    public function __init()
    {
        //网站关闭检测
        $this->CheckWebClose();
        $this->model = S('model');
        $this->category = S('category');
        $this->cid = Q('cid', 0, 'intval');
        $this->aid = Q('aid', 0, 'intval');
        if (!isset($this->category[$this->cid])) {
            $this->_404();
        }
        if (empty($this->aid)) {
            $this->_404();
        }
        $_REQUEST['mid'] = $_GET['mid'] = $this->mid = $this->category[$this->cid]['mid'];
        $this->cacheDir = TEMP_PATH . 'Content/Category/' . $this->cid . '/';
    }

    //内容页
    public function index()
    {
        if (!$this->checkAccess()) {
            $this->error('没有访问权限');
        }
        //读取文章
        $model = S('model');
        $table = $model[$this->category[$this->cid]['mid']]['table_name'];
        $db = V($table);
        $db->stable = $table . '_data'; //副表名
        $db->mid = $_REQUEST['mid'];
        $db->view[$table] = array('_type' => "INNER");
        $db->view['category'] = array('_type' => 'INNER', '_on' => "category.cid={$table}.cid");
        $db->view['user'] = array('_type' => 'INNER', '_on' => "user.uid={$table}.uid");
        $db->view['model'] = array('_type' => 'INNER', '_on' => 'model.mid=category.mid');
        $db->view[$table . '_data'] = array('_on' => $table . ".aid={$table}_data.aid");
        $map[] = "{$table}.aid = " . $this->aid;
        $field = $db->where($map)->find();
        if (!$field) {
            $this->_404();
        }
        //获得文章tag
        $map = array();
        $map[] = 'ct.mid = ' . $this->mid;
        $map[] = 'ct.aid = ' . $this->aid;
        $tag = M()->join('__content_tag__ ct JOIN __tag__ t ON ct.tid=t.tid')->where($map)->all();
        $field['tag'] = '';
        foreach ($tag as $t) {
            $url = U('Search/Index/index', array('g' => 'Addons', 'type' => 'tag', 'wd' => $t['tag'], 'mid' => $this->mid));
            $field['tag'] .= "<a href='{$url}'>{$t['tag']}</a> ";
        }
        //扣除阅读金币
        $this->deductPoints($field);
        //文章没审核时超管不限
        if (!IS_ADMIN && $field['content_status'] == 0) {
            $this->error('文章正在审核中');
        }
        //0与-1为不缓存
        if (C('CACHE_CONTENT') == 0) C('CACHE_CONTENT', -1);
        if (C('CACHE_CONTENT') == -1 || !$this->isCache()) {
            $field = content_field($field);
            $this->assign('hdcms', $field);
            $tplFile = empty($field['template']) ? $this->category[$this->cid]['arc_tpl'] : $field['template'];
            $this->display('Template/' . C('WEB_STYLE') . '/' . $tplFile, C('CACHE_CONTENT'));
        } else {
            $this->display(null, C('CACHE_CONTENT'));
        }
    }

    //验证阅读权限
    private function checkAccess()
    {
        if (IS_SUPER_ADMIN || IS_WEBMASTER) {
            return true;
        }
        //栏目没有权限
        $map['cid'] = array('EQ', $this->cid);
        $access = M('category_access')->where($map)->all();
        if (empty($access)) {
            return true;
        }
        if (!IS_LOGIN) {
            return false;
        }
        //检测栏目权限
        $map = array();
        $map['rid'] = array('EQ', $_SESSION['user']['rid']);
        $map['cid'] = array('EQ', $this->cid);
        //验证阅读权限
        $access = M('category_access')->where($map)->find();
        if (empty($access)) {
            return true;
        } else {
            return $access['content'];
        }
    }

    /**
     * 扣除阅读积分
     * @param $field 文章数据
     */
    private function deductPoints($field)
    {
        if (empty($field['readpoint'])) {
            //文章设置的
            $readPoint = intval($field['show_credits']);
        } else {
            //栏目设置的
            $readPoint = intval($field['readpoint']);
        }
        //扣除积分
        if ($readPoint > 0) {
            //验证会员登录状态
            if (!IS_LOGIN) {
                $this->error('请登录后查看', 'Member/Login/login');
            } else if ($_SESSION['user']['credits'] < $readPoint) {
                //积分不足
                $this->error('积分不足');
            } else {
                //没到扣除时间，不扣除
                $map['cid'] = array('EQ', $this->cid);
                $map['aid'] = array('EQ', $this->aid);
                $map['rectime'] = array('GT', time() - $field['repeat_charge_day'] * 3600 * 24);
                if (!M('user_credits')->where($map)->find()) {
                    //扣除阅读积分
                    $_SESSION['user']['credits'] -= $readPoint;
                    $data = array(
                        "uid=" => $_SESSION['user']['uid'],
                        'credits' => $_SESSION['user']['credits']
                    );
                    //更改会员积分
                    M('user')->save($data);
                    //积分表记录
                    $data = array(
                        'uid' => $_SESSION['user']['uid'],
                        'mid' => $this->mid,
                        'cid' => $this->cid,
                        'aid' => $this->aid,
                        'title' => $field['title'],
                        'rectime' => time()
                    );
                    M('user_credits')->add($data);
                }
            }
        }

    }

    /**
     * 获得点击数
     */
    public function getClick()
    {
        $cache = S('model');
        $table = $cache[$this->mid]['table_name'];
        $model = M($table);
        $model->inc('click', 'aid=' . $this->aid, 1);
        $click = $model->where("aid={$this->aid}")->getField('click');
        echo "document.write({$click});";
        exit;
    }

    /**
     * 加入收藏夹
     */
    public function favorite()
    {
        if (!IS_LOGIN) {
            cookie('HISTORY', $_SERVER['HTTP_REFERER']);
            $this->error('请登录后操作', U('Member/Login/login'));
        } else {
            $model = S('model');
            $table = $model[$this->category[$this->cid]['mid']]['table_name'];
            $mid = Q('mid', 0, 'intval');
            $cid = Q('cid', 0, 'intval');
            $aid = Q('aid', 0, 'intval');
            $status = M('favorite')->where("mid=$mid and aid=$aid")->find();
            if (!$status) {
                $map['aid'] = array('EQ', Q('aid', 0, 'intval'));
                $title = M($table)->where($map)->getField('title');
                $data['user_id'] = $_SESSION['user']['uid'];
                $data['mid'] = $mid;
                $data['cid'] = $cid;
                $data['aid'] = $aid;
                $data['title'] = $title;
                M('favorite')->add($data);
            }
            $this->success('收藏成功');
        }
    }
}