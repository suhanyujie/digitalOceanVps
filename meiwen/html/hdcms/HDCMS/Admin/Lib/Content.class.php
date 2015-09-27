<?php

/**
 *内容添加/删除/修改操作
 * @author hdxj <houdunwangxj@gmail.com>
 */
class Content
{
    private $mid;
    private $cid;
    private $model;
    private $category;
    public $error;
    private $html;//静态生成对象

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->model = S('model');
        $this->category = S('category');
        $this->mid = Q('mid', 0, 'intval');
        $this->cid = Q('cid', 0, 'intval');
        $this->html = new Html();
    }

    /**
     * 添加文章
     * @return bool
     */
    public function add()
    {
        Hook::listen('CONTENT_ADD_BEGIN');
        //文章多表关联模型
        $ContentModel = ContentModel::getInstance($this->mid);
        //数据前期处理
        $ContentInputModel = new ContentInputModel($this->mid);
        $data = $ContentInputModel->get();
        if ($data == false) {
            $this->error = $ContentInputModel->error;
            return false;
        }

        if ($ContentModel->create($data)) {
            $result = $ContentModel->add($data);
            $aid = $result[$ContentModel->table];
            //修改tag标签数据
            $this->alterTag($aid);
            //生成文章静态
            $this->html->content($this->mid, $aid);
            //生成相关文章
            $this->html->relation_content($this->mid, $aid);
            //生成当前栏目
            $this->html->relation_category($this->cid);
            //生成父级栏目
            $this->html->parent_category($this->cid);
            //生成首页
            $this->html->index();
            Hook::listen('CONTENT_ADD_END');
            return $aid;
        } else {
            $this->error = $ContentModel->error;
            return false;
        }
    }

    //修改文章
    public function edit()
    {
        Hook::listen('CONTENT_EDIT_BEGIN');
        $ContentModel = ContentModel::getInstance($this->mid);
        $ContentInputModel = new ContentInputModel($this->mid);
        $data = $ContentInputModel->get();;
        if ($data == false) {
            $this->error = $ContentInputModel->error;
            return false;
        }
        if ($ContentModel->create($data)) {
            if ($result = $ContentModel->save($data)) {
                //修改tag标签数据
                $this->alterTag($data['aid']);
                //内容静态
                $this->html->content($this->mid, $data['aid']);
                //上下关联文章
                $this->html->relation_content($this->mid, $data['aid']);
                //生成本栏目
                $this->html->relation_category($this->cid);
                //生成父级栏目
                $this->html->parent_category($this->cid);
                //生成首页
                $this->html->index();
                Hook::listen('CONTENT_EDIT_END');
                return true;
            }
        } else {
            $this->error = $ContentModel->error;
            return false;
        }
    }

    /**
     * 删除文章
     * @param $aid 文章aid
     * @return bool
     */
    public function del($aid)
    {
        $ContentModel = ContentModel::getInstance($this->mid);
        $map['aid'] = array('IN', $aid);
        //删除文章静态文件
        $content = $ContentModel->where($map)->find();
        $content = array_merge($content, $this->category[$content['cid']]);
        $htmlFile = Url::content($content);
        $htmlFile = str_replace(__ROOT__, ROOT_PATH, $htmlFile);
        if (is_file($htmlFile)) {
            @unlink($htmlFile);
        }
        //执行删除
        if ($ContentModel->del($aid)) {
            //删除文章tag
            $map['cid'] = $content['cid'];
            $map['aid'] = $content['aid'];
            M('content_tag')->where($map)->del();
            //生成关联文章
            $this->html->relation_content($this->mid, $content['aid']);
            //生成本栏目
            $this->html->relation_category($content['cid']);
            //生成父级栏目
            $this->html->parent_category($this->cid);
            //生成首页
            $this->html->index();
            Hook::listen('CONTENT_DEL');
            return true;
        } else {
            $this->error = '删除文章失败';
        }
    }

    //修改tag标签数据
    public function alterTag($aid)
    {
        $tagModel = M('tag');
        $contentTagModel = M("content_tag");
        //删除文章旧的tag记录
        $contentTagModel->where(array('aid' => $aid, 'mid' => $this->mid))->del();
        //修改tag
        $tag = Q('tag');
        if ($tag) {
            //全角标点转半角标点
            $tag = String::toSemiangle($tag);
            $tagData = explode(',', $tag);
            if (!empty($tagData)) {
                //去除重复tag标签
                $tagData = array_unique($tagData);
                foreach ($tagData as $tag) {
                    $tid = $tagModel->where(array('tag' => $tag))->getField('tid');
                    if ($tid) {
                        //修改tag记数
                        $tagModel->exe("UPDATE " . C('DB_PREFIX') . "tag SET `total`=total+1 WHERE tag='$tag'");
                    } else {
                        //tag表没有记录时，添加tag字符记录
                        $tid = $tagModel->add(array('tag' => $tag, 'total' => 1));
                    }
                    $contentTagModel->add(array('aid' => $aid, 'cid' => $this->cid, 'mid' => $this->mid, 'tid' => $tid));
                }
            }
        }
    }
}
