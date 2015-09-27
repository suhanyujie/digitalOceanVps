<?php

/**
 * 栏目管理模块
 * Class CategoryController
 * @author 向军 <2300071698@qq.com>
 */
class CategoryController extends AuthController
{
    private $category, $model, $db, $cid, $mid;

    /**
     * 构造函数
     */
    public function __init()
    {
        $this->category = S("category");
        $this->model = S("model");
        $this->db = K('Category');
        $this->cid = Q('cid', 0, 'intval');
        $this->mid = Q('mid', 0, 'intval');
    }

    /**
     * 显示栏目列表
     */
    public function index()
    {
        $this->assign("category", $this->category);
        //添加模型名称
        $this->display();
    }

    /**
     * 栏目名称转拼音静态目录
     */
    public function dir_to_pinyin()
    {
        $dir = String::pinyin(Q("catname"));
        $pid = Q('pid', 0, 'intval');
        if ($pid) {
            echo $this->category[$pid]['catdir'] . '/' . $dir;
        } else {
            echo $dir;
        }
        exit;
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
     * 上传栏目图片
     */
    public function categoryImage()
    {
        $upload = new Upload('Upload/Category');
        $file = $upload->upload();
        if (empty($file)) {
            $this->ajax('上传失败');
        } else {
            $data = $file[0];
            $data['uid'] = $_SESSION['user']['uid'];
            M('upload')->add($data);
            $this->ajax($data);
        }
    }

    //添加栏目到表
    public function add()
    {
        //添加栏目
        if (IS_POST) {
            if ($this->db->addCategory()) {
                $this->success('添加栏目成功');
            } else {
                $this->error($this->db->error);
            }
        } else {
            //获取角色数据，以后台和前台用户区分
            $roles = M('role')->all();
            $roleData = array('admin' => array(), 'user' => array());
            foreach ($roles as $role) {
                if ($role['admin'] == 1) {
                    $roleData['admin'][] = $role;
                } else {
                    $roleData['user'][] = $role;
                }
            }
            $this->assign('model', $this->model);
            $this->assign('category', $this->category);
            $this->assign('roleData', $roleData);
            $this->display();
        }
    }

    //修改栏目到表
    public function edit()
    {
        if (IS_POST) {
            if ($this->db->editCategory()) {
                $this->success('修改栏目成功');
            } else {
                $this->error($this->db->error);
            }
        } else {
            if (!$this->cid || !isset($this->category[$this->cid])) {
                $this->error('栏目不存在');
            }
            $cache = $this->category;
            $category = $cache[$this->cid];
            foreach ($cache as $n => $cat) {
                //父栏目select状态
                $selected = $category['pid'] == $cat['cid'] ? 'selected=""' : '';
                //子栏目disabled
                $disabled = Data::isChild($this->category, $cat['cid'], $this->cid) || $this->cid == $cat['cid'] ? 'disabled=""' : '';
                $cache[$n]['selected'] = $selected;
                $cache[$n]['disabled'] = $disabled;
            }
            /**
             * 获得栏目权限
             */
            $categoryAccess = $this->db->getCategoryAccess($this->cid);
            /**
             * 如果当前栏目有文章时不允许更改模型
             */
            $map['cid'] = $this->cid;
            $contentTable = $this->model[$this->category[$this->cid]['mid']]['table_name'];
            if (M($contentTable)->where($map)->count()) {
                $disabledChangeModel = true;
            } else {
                $disabledChangeModel = false;
            }
            $this->assign('disabledChangeModel', $disabledChangeModel);
            $this->assign('access', $categoryAccess);
            $this->assign('field', $category);
            $this->assign('model', $this->model);
            $this->assign('category', $cache);
            $this->display();
        }
    }

    /**
     * 栏目排序
     */
    public function updateOrder()
    {
        if ($this->db->updateOrder()) {
            $this->success('排序成功');
        }
    }

    /**
     * 更新栏目缓存
     */
    public function updateCache()
    {
        if ($this->db->updateCache()) {
            $this->success('更新缓存成功');
        } else {
            $this->error($this->db->error);
        }
    }

    /**
     * 删除栏目
     */
    public function del()
    {
        if ($this->db->delCategory($this->cid)) {
            $this->success('删除栏目成功');
        } else {
            $this->error($this->db->error);
        }
    }

    //批量编辑栏目
    public function BulkEdit()
    {
        if (Q('post.BulkEdit')) {
            foreach ($_POST['cat'] as $data) {
                $this->db->save($data);
            }
            $this->db->updateCache();
            $this->success('修改成功');
        } else {
            $cid = explode('|', Q('cids'));
            $data = $this->db->where(array('cid' => array('IN', $cid)))->all();
            $this->assign('data', $data);
            $this->display();
        }
    }

}
