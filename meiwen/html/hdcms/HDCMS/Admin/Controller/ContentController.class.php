<?php

/**
 * 内容管理
 * Class ContentController
 * @author 向军 <houdunwangxj@gmail.com>
 */
class ContentController extends AuthController
{
    private $category, $model, $cid, $mid;
    //权限验证的动作
    private $authAction = array('add', 'edit', 'del');

    /**
     * 构造函数
     */
    public function __init()
    {
        $this->category = S('category');
        $this->model = S('model');
        $this->cid = Q('cid', 0, 'intval');
        $this->mid = Q('mid', 0, 'intval');
        //验证模型mid
        if ($this->mid && !isset($this->model[$this->mid])) {
            $this->error('模型不存在');
        }
        //验证栏目cid
        if ($this->cid && !isset($this->category[$this->cid])) {
            $this->error('栏目不存在');
        }
        //验证权限
        if (!$this->checkAccess()) {
            $this->error('没有操作权限');
        }
    }

    //验证操作权限
    public function checkAccess()
    {
        //管理员不验证
        if (IS_SUPER_ADMIN || IS_WEBMASTER) {
            return true;
        }
        if (in_array(ACTION, $this->authAction)) {
            $db = M('category_access');
            $access = $db->find($this->cid);
            //栏目没有权限
            if (empty($access)) {
                return true;
            }
            //获得角色权限
            $map['cid'] = $this->cid;
            $map['rid'] = $_SESSION['user']['rid'];
            $RoleAccess = $db->where($map)->find();
            if (empty($RoleAccess)) {
                return false;
            }
            return $RoleAccess[ACTION];
        }
    }

    //内容栏目选择页
    public function index()
    {
        $this->display();
    }

    /**
     * 异步获得目录树，内容左侧目录列表
     */
    public function ajaxCategoryZtree()
    {
        $category = array();
        if ($this->category) {
            foreach ($this->category as $n => $cat) {
                $data = array();
                //过滤掉外部链接栏目
                if ($cat['cattype'] != 3) {
                    //单文章栏目
                    if ($cat['cattype'] == 4) {
                        $link = U('single', array('mid' => $cat['mid'], 'cid' => $cat['cid']));
                        $url = $link;
                    } else if ($cat['cattype'] == 1) {
                        $url = U('show', array('cid' => $cat['cid'], 'mid' => $cat['mid']));
                    } else {
                        $url = 'javascript:';
                    }
                    $data['id'] = $cat['cid'];
                    $data['pId'] = $cat['pid'];
                    $data['url'] = $url;
                    $data['target'] = 'content';
                    $data['open'] = true;
                    if ($cat['cattype'] == 2) {
                        $data['name'] = $cat['catname'] . '(封)';
                    } else {
                        $data['name'] = $cat['catname'];
                    }
                    $category[] = $data;
                }
            }
        }
        $this->ajax($category);
    }

    //单页面处理
    public function single()
    {
        $ContentModel = ContentModel::getInstance($this->mid);
        $content = $ContentModel->where(array('cid' => $this->cid))->limit(1)->find();
        if ($content) {
            $link = U('edit', array('mid' => $this->mid, 'cid' => $this->cid, 'aid' => $content['aid']));
        } else {
            $link = U('add', array('mid' => $this->mid, 'cid' => $this->cid));
        }
        go($link);
    }

    //内容列表
    public function show()
    {
        $modelCache = S('model');
        $table = $modelCache[$this->mid]['table_name'];
        $ContentModel = V($table);
        $ContentModel->view[$table] = array('_type' => "INNER");
        $ContentModel->view['category'] = array('_type' => 'INNER', '_on' => "category.cid={$table}.cid");
        $ContentModel->view['model'] = array('_type' => 'INNER', '_on' => 'model.mid=category.mid');
        $where = array();
        //文章状态
        $content_status = Q('get.content_status', 1, 'intval');
        $where['content_status'] = array('EQ', $content_status);
        //按时间搜索
        $search_begin_time = Q('search_begin_time', 0, 'strtotime');
        if ($search_begin_time) {
            $where['addtime'] = array('EGT', $search_begin_time);
        }
        $search_end_time = Q('search_end_time', null, 'strtotime');
        if ($search_end_time) {
            $where['addtime'] = array('ELT', $search_end_time);
        }
        //按flag搜索
        if ($flag = Q('flag')) {
            $where[] = "find_in_set('$flag',flag) AND ";
        }
        //按字段类型
        if (!empty($_REQUEST['search_type']) && !empty($_REQUEST['search_keyword'])) {
            $search_keyword = $_REQUEST['search_keyword'];
            switch (strtolower($_REQUEST['search_type'])) {
                case 1 :
                    //标题
                    $where['title'] = array('like', "%$search_keyword%");
                    break;
                case 2 :
                    //简介
                    $where['description'] = array('like', "%$search_keyword%");
                    break;
                case 3 :
                    //用户名
                    $where['username'] = array('EQ', $search_keyword);
                    break;
                case 4 :
                    //用户uid
                    $where[] = "user.uid =$search_keyword";
                    break;
            }
        }
        $where[] = "category.cid=" . $this->cid;
        $page = new Page($ContentModel->where($where)->count(), 15);
        //查询结果添加会员名
        $ContentModel->view['user'] = array('_type' => 'INNER', '_on' => "user.uid={$table}.uid");
        $data = $ContentModel->where($where)->limit($page->limit())->
        order('arc_sort ASC,' . $ContentModel->table . '.aid DESC')->group("aid")->all();
        $this->assign('flag', S('flag' . $this->mid));
        $this->assign('data', $data);
        $this->assign('page', $page->show());
        $this->display();
    }

    //添加文章
    public function add()
    {
        if (IS_POST) {
            $ContentModel = new Content();
            if ($ContentModel->add()) {
                $this->success('发表成功！');
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

    /**
     * 修改文章
     */
    public function edit()
    {
        if (IS_POST) {
            $ContentModel = new Content();
            if ($ContentModel->edit()) {
                $this->success('修改成功');
            } else {
                $this->error($ContentModel->error);
            }
        } else {
            $aid = Q('aid', 0, 'intval');
            if (!$aid) $this->error('文章不存在');
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

    /**
     * 删除文章
     */
    public function del()
    {
        $aid = Q('aid');
        if (empty($aid)) {
            $this->error('参数错误');
        }
        $ContentModel = new Content();
        if ($ContentModel->del($aid)) {
            $this->success('删除成功');
        } else {
            $this->error($ContentModel->error);
        }
    }

    /**
     * 批量删除
     */
    public function batchDel()
    {
        $aid = Q('aid', '', '');
        if (empty($aid)) {
            $this->error('请选择文章');
        }
        $ContentModel = new Content();
        foreach ($aid as $id) {
            if (!$ContentModel->del($id)) {
                $this->error($ContentModel->error);
            }
        }
        $this->success('删除成功');
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
            if($data['image'] && C('WATER_ON')){
                $imageObj = new Image();
                $imageObj->water($data['path'],$data['path']);
            }
            $data['uid'] = $_SESSION['user']['uid'];
            $data['mid'] = $this->mid;
            M('upload')->add($data);
            $this->ajax($data);
        }
    }

    /**
     * 选择模板
     */
    public function selectTemplate()
    {
        if (!$dir = Q('dir')) {
            $dir = 'Template/' . C('WEB_STYLE');
        }
        $file = Dir::tree($dir, 'html');
        $this->assign('id', Q('id'));
        $this->assign('file', $file);
        $this->display();
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
                $set['filetype'] = '';
                foreach ($filetype as $t) {
                    $set['filetype'] .= '*.' . $t . ';';
                }
                $set['filetype'] = substr($set['filetype'], 0, -1);
                break;
        }
        $this->assign('set', $set);
        $this->display();
    }

    /**
     * 排序
     */
    public function order()
    {
        $arc_order = Q('arc_order');
        if (!empty($arc_order) && is_array($arc_order)) {
            $ContentModel = ContentModel::getInstance($this->mid);
            foreach ($arc_order as $aid => $order) {
                $ContentModel->save(array('aid' => $aid, 'arc_sort' => $order));
            }
        }
        $this->success('排序成功');
    }

    /**
     * 审核文章
     */
    public function audit()
    {
        if ($aids = Q('aid')) {
            $status = Q('status', 0, 'intval');
            $ContentModel = ContentModel::getInstance($this->mid);
            foreach ($aids as $aid) {
                $data = array('aid' => $aid, 'content_status' => $status);
                $ContentModel->save($data);
            }
            $this->success('操作成功');
        } else {
            $this->error('参数错误');
        }
    }

    /**
     * 移动文章
     */
    public function move()
    {
        if (IS_POST) {
            $ContentModel = ContentModel::getInstance($this->mid);
            //移动方式  1 从指定ID  2 从指定栏目
            $from_type = Q("post.from_type", 0, "intval");
            //目标栏目cid
            $to_cid = Q("post.to_cid", 0, 'intval');
            if ($to_cid) {
                switch ($from_type) {
                    case 1 :
                        //移动aid
                        $aid = Q("post.aid", 0, "trim");
                        $aid = explode("|", $aid);
                        if ($aid && is_array($aid)) {
                            foreach ($aid as $id) {
                                if (is_numeric($id)) {
                                    $ContentModel->save(array("aid" => $id, "cid" => $to_cid));
                                }
                            }
                        }
                        break;
                    case 2 :
                        //来源栏目cid
                        $from_cid = Q("post.from_cid", 0);
                        if ($from_cid) {
                            foreach ($from_cid as $d) {
                                if (is_numeric($d)) {
                                    $table = $this->model[$this->category[$d]['mid']]['table_name'];
                                    M($table)->where("cid=$d")->save(array("cid" => $to_cid));
                                }
                            }
                        }
                        break;
                }
                $this->success('移动成功！');
            } else {
                $this->error('请选择目录栏目');
            }

        } else {
            $category = array();
            foreach ($this->category as $n => $v) {
                //排除非本模型或外部链接类型栏目或单文章栏目
                if ($v['mid'] != $this->mid || $v['cattype'] == 3 || $v['cattype'] == 4) {
                    continue;
                }
                if ($this->cid == $v['cid']) {
                    $v['selected'] = "selected";
                }
                //封面栏目
                if ($v['cattype'] == 2) {
                    $v['disabled'] = 'disabled';
                }
                $category[$n] = $v;
            }
            $this->assign('category', $category);
            $this->display();
        }
    }
}