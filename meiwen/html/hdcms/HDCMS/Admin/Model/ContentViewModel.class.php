<?php

/**
 * 内容视图模型
 * Class ContentModel
 */
class ContentViewModel extends ViewModel
{
    //模型对象
    static private $instance = array();
    //副表
    protected $stable;
    //模型mid
    protected $mid;

    //实例化模型对象
    static public function getInstance($mid)
    {
        if (!isset(self::$instance[$mid])) {
            $modelCache = S('model');
            $table = $modelCache[$mid]['table_name'];
            $model = new self($table);
            $model->stable = $table . '_data';//副表名
            $model->mid = $mid;
            $model->view[$table] = array('_type' => "INNER");
            $model->view['category'] = array('_type' => 'INNER', '_on' => "category.cid={$table}.cid");
            $model->view['user'] = array('_type' => 'INNER', '_on' => "user.uid={$table}.uid");
            $model->view['model'] = array('_type' => 'INNER', '_on' => 'model.mid=category.mid');
            $model->view[$table . '_data'] = array('_on' => $table . ".aid={$table}_data.aid");
            self::$instance[$mid] = $model;
            return $model;
        } else {
            return self::$instance[$mid];
        }
    }

    /**
     * 获取一条
     * @param $aid 文章id
     */
    public function one($aid)
    {
        $map[] = $this->table . '.aid=' . $aid;
        $field = $this->where($map)->find();
        //获得文章tag
        $map = array();
        $map[] = 'ct.mid = ' . $this->mid;
        $map[] = 'ct.aid = ' . $aid;
        $tag = M()->join('__content_tag__ ct JOIN __tag__ t ON ct.tid=t.tid')->where($map)->all();
        $field['tag'] = '';
        foreach ($tag as $t) {
            $url = U('Search/Index/index', array('g' => 'Addons', 'type' => 'tag', 'wd' => $t['tag'], 'mid' => $this->mid));
            $field['tag'] .= "<a href='{$url}'>{$t['tag']}</a> ";
        }
        return $field;
    }
}
