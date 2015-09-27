<?php

/**
 * 属性flag
 * Class FlagModel
 * @author hdxj
 */
class FlagModel extends Model
{
    public $table;
    private $mid;
    private $contentTable;
    //缓存
    public $flag;

    //构造函数
    public function __init()
    {
        $this->mid = Q('mid', 0, 'intval');
        $model = S('model');
        if (!isset($model[$this->mid])) {
            $this->error = '模型不存在';
            return false;
        }
        $this->flag = S('flag' . $this->mid);
        $this->contentTable = $model[$this->mid]['table_name'];
    }

    /**
     * 删除属性
     * @param $index
     * @return bool
     */
    public function delFlag($index)
    {
        $flag = $this->flag;
        unset($flag[$index]);
        $sql = "ALTER TABLE " . C('DB_PREFIX') . $this->contentTable . " MODIFY flag set('" . implode("','", $flag) . "')";
        if (!$this->exe($sql)) {
            $this->error = '修改表失败';
            return false;
        }
        return $this->updateCache();
    }

    /**
     * 修改属性
     */
    public function editFlag()
    {
        $data=Q('post.flag');
        if (!empty($data)) {
            $sql = "ALTER TABLE " . C('DB_PREFIX') . $this->contentTable . " MODIFY flag set('" . implode("','", $data) . "')";
            if (!$this->exe($sql)) {
                $this->error = '修改表失败';
                return false;
            }
        }
        return $this->updateCache();
    }

    /**
     * 添加属性
     */
    public function addFlag()
    {
        $value=Q('post.value');
        if (empty($value)) {
            $this->error='属性名不能为空';
            return false;
        }
        $this->flag[] = $value;
        $sql = "ALTER TABLE " . C('DB_PREFIX') . $this->contentTable . " MODIFY flag set('" . implode("','", $this->flag) . "')";
        if (!$this->exe($sql)) {
            $this->error = '修改表失败';
            return false;
        }
        return $this->updateCache();
    }

    /**
     * 更新缓存
     */
    public function updateCache()
    {
        $result = M()->query('DESC ' . C('DB_PREFIX') . $this->contentTable);
        $flag = array();
        foreach ($result as $field) {
            if ($field['Field'] == 'flag') {
                $tmp = substr($field['Type'], 4, -2);
                $flag = explode(',', str_replace("'", '', $tmp));
                break;
            }
        }
        return S('flag' . $this->mid,$flag);
    }
}