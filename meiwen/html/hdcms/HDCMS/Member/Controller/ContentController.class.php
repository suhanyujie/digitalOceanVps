<?php

/**
 * 会员中心内容管理
 * Class ContentController
 * @author 向军 <houdunwangxj@gmail.com>
 */
class ContentController extends AuthController
{
    private $category, $model, $cid, $mid;

    public function __init()
    {
        $this->category = S('category');
        $this->model = S('model');
        $this->cid = Q('cid', 0, 'intval');
        $this->mid = Q('mid', 0, 'intval');
        //验证模型mid
        if (!$this->mid || !isset($this->model[$this->mid])) {
            $this->error('模型不存在', U('content', array('mid' => 1)));
        }
        //验证栏目cid
        if ($this->cid && !isset($this->category[$this->cid])) {
            $this->error('栏目不存在');
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
        //检测栏目权限
        $map = array();
        $map['rid'] = array('EQ', $_SESSION['user']['rid']);
        $map['cid'] = array('EQ', $this->cid);
        //验证阅读权限
        $access = M('category_access')->where($map)->find();
        if (empty($access)) {
            return true;
        } else {
            return $access[ACTION];
        }
    }

    //内容列表
    public function content()
    {
        $table = $this->model[$this->mid]['table_name'];
        $model = V($table);
        $model->view[$table] = array('_type' => "INNER");
        $model->view['category'] = array('_type' => 'INNER', '_on' => "category.cid={$table}.cid");
        $where[] = "category.mid=" . $this->mid;
        $where[] = 'uid=' . $_SESSION['user']['uid'];
        $page = new Page($model->where($where)->count(), 10);
        $data = $model->where($where)->limit($page->limit())->order('arc_sort ASC,addtime DESC')->all();
        $this->assign('data', $data);
        $this->assign('model', $this->model[$this->mid]);
        $this->assign('page', $page->show());
        $this->display();
    }

    //添加文章
    public function add()
    {
        if (IS_POST) {
            //验证权限
            $this->checkAccess();
            $ContentModel = new Content();
            if ($ContentModel->add($_POST)) {
                $this->success('发表成功！', U('content', array('mid' => $this->mid)));
            } else {
                $this->error($ContentModel->error);
            }
        } else {
            //获取分配字段
            $model = K('ContentForm');
            $this->assign('form', $model->get());
            //分配验证规则
            $this->assign('formValidate', $model->formValidate);
            $this->display();
        }
    }

    //修改文章
    public function edit()
    {
        if (IS_POST) {
            //验证权限
            $this->checkAccess();
            $ContentModel = new Content();
            if ($ContentModel->edit()) {
                $this->success('发表成功！');
            } else {
                $this->error($ContentModel->error);
            }
        } else {
            $aid = Q('aid', 0, 'intval');
            if (!$aid) {
                $this->error('参数错误');
            }
            $ContentModel = ContentModel::getInstance($this->mid);
            $editData = $ContentModel->find($aid);
            //获取分配字段
            $form = K('ContentForm');
            $this->assign('form', $form->get($editData));
            //分配验证规则
            $this->assign('formValidate', $form->formValidate);
            $this->assign('editData', $editData);
            $this->display();
        }
    }

    //删除文章
    public function del()
    {
        //验证权限
        $this->checkAccess();
        if ($aid = Q('aid', 0)) {
            $ContentModel = new Content();
            if ($ContentModel->del($aid)) {
                $this->success('删除成功');
            } else {
                $this->error($ContentModel->error);
            }
        } else {
            $this->error('参数错误');
        }
    }

    /**
     * 站内文件
     */
    public function webFile()
    {
        $type = Q('type');
        switch ($type) {
            case 'file':
                $map['status'] = array('EQ', 1);
                break;
            case 'thumb':
            case 'image':
            case 'images':
                $map['status'] = array('EQ', 1);
                $map['image'] = array('EQ', 1);
                break;
            case 'files':
                $map = '';
                break;
        }
        $db = M('upload');
        $map['uid'] = $_SESSION['user']['uid'];
        $count = $db->where($map)->count();
        $page = new Page($count, 18);
        $data = $db->where($map)->limit($page->limit())->all();
        $this->assign('data', $data);
        $this->assign('page', $page->show());
        $this->display();
    }

    /**
     * 站内文件
     */
    public function noUse()
    {
        $type = Q('type');
        switch ($type) {
            case 'file':
                $map['status'] = array('EQ', 0);
                break;
            case 'thumb':
            case 'image':
            case 'images':
                $map['status'] = array('EQ', 0);
                $map['image'] = array('EQ', 1);
                break;
            case 'files':
                $map = '';
                break;
        }
        $db = M('upload');
        $map['uid'] = $_SESSION['user']['uid'];
        $count = $db->where($map)->count();
        $page = new Page($count, 18);
        $data = $db->where($map)->limit($page->limit())->all();
        $this->assign('data', $data);
        $this->assign('page', $page->show());
        $this->display();
    }

    /**
     * 上传文件
     */
    public function uploadFile()
    {
        $cache = S('field' . $_GET['mid']);
        $set = $cache[$_GET['name']]['set'];
        switch ($_GET['type']) {
            case 'thumb':
                //缩略图字段
                $set['type'] = 'thumb';
                $set['name'] = 'thumb';
                $set['allow_size'] = 2000;
                $set['num'] = 1;
                $set['filetype'] = '*.gif; *.jpg; *.png';
                break;
            case 'image':
                $set['type'] = 'image';
                $set['name'] = $_GET['name'];
                $set['allow_size'] *= 1000;
                $set['num'] = 1;
                $set['filetype'] = '*.gif; *.jpg; *.png';
                break;
            case 'images':
                $set['type'] = 'images';
                $set['name'] = $_GET['name'];
                $set['allow_size'] *= 1000;
                $set['filetype'] = '*.gif; *.jpg; *.png';
                break;
            case 'files':
                $set['type'] = 'files';
                $set['name'] = $_GET['name'];
                $set['allow_size'] *= 1000;
                $filetype = explode(',', $set['filetype']);
                $set['filetype']='';
                foreach ($filetype as $t) {
                    $set['filetype'] .='*.'.$t.';';
                }
                $set['filetype']=substr( $set['filetype'],0,-1);
                break;
        }
        $this->assign('set', $set);
        $this->display();
    }

    /**
     * 上传文件
     */
    public function upload()
    {
        $upload = new Upload('Upload/Content/' . date('y/m'));
        $file = $upload->upload();
        if (empty($file)) {
            $this->ajax('上传失败');
        } else {
            $data = $file[0];
            $data['uid'] = $_SESSION['user']['uid'];
            $data['mid'] = $this->mid;
            M('upload')->add($data);
            $this->ajax($data);
        }
    }
}