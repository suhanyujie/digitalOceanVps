<?php

/**
 * 模型管理
 *
 * @author 向军 <2300071698@qq.com>
 */
class ModelModel extends Model
{
    //表名
    public $table = 'model';
    //模型mid
    private $mid;
    //模型缓存
    private $model;
    //自动完成
    public $auto
        = array(
            array('model_name', 'trim', 'function', 1, 3),
            array('table_name', 'trim', 'function', 1, 3),
            array('table_name', 'strtolower', 'function', 1, 3),
        );
    //字段验证
    public $validate
        = array(
            array('model_name', 'nonull', '模型名不能为空', 2, 3),
            array('model_name', 'isModelName', '模型已经存在', 2, 3),
            array('table_name', 'nonull', '表名不能为空', 1, 3),
            array('table_name', 'isTableName', '表已经存在', 1, 3),
        );

    //检测表名
    public function isTableName($name, $value, $msg, $age)
    {
        if (M()->tableExists($value)) {
            return $msg;
        } else {
            return true;
        }
    }

    //检测模型名
    public function isModelName($name, $value, $msg, $arg)
    {
        if ($this->mid) {
            $map['mid'] = array('NEQ', $this->mid);
        }
        $map['model_name'] = $value;
        $status = M('model')->where($map)->find();
        if ($status) {
            return $msg;
        } else {
            return true;
        }
    }

    /**
     * 构造函数
     */
    public function __init()
    {
        $this->mid = Q('mid', 0, 'intval');
        $this->model = S('model');
    }

    /**
     * 添加模型
     */
    public function addModel()
    {
        if ($this->create()) {
            $table_name = $this->data['table_name'];
            if ($this->createModelSql($table_name)) {
                //添加模型记录
                if ($mid = $this->add()) {
                    //创建Field表信息(初始模型字段)
                    $db = M();
                    $db_prefix = C("DB_PREFIX");
                    $table = $table_name;
                    require MODULE_PATH . '/Data/ModelSql/FieldInit.php';
                    return $this->updateCache();
                } else {
                    $this->error = '添加失败';

                    return false;
                }
            } else {
                $this->error = '创建表失败';

                return false;
            }
        }
    }


    //修改模型
    public function editModel()
    {
        //验证mid
        if (!$this->mid || !isset($this->model[$this->mid])) {
            $this->error = '模型不存在';

            return false;
        }
        if ($this->create()) {
            if (!$this->save()) {
                $this->error = '更新模型失败';
            } else {
                return $this->updateCache();
            }
        }
    }
    /**
     * 删除模型
     */
    public function delModel()
    {
        if (!$this->mid || !isset($this->model[$this->mid])) {
            $this->error = '模型不存在';

            return false;
        }
        //验证栏目信息
        if (M('category')->find(array('mid' => $this->mid))) {
            $this->error = '请先删除模型栏目';

            return false;
        }
        //删除主表
        $table = $this->model[$this->mid]['table_name'];
        $this->dropTable($table);
        //删除副表
        $this->dropTable($table . '_data');
        //删除表记录
        if ($this->del($this->mid)) {
            //删除模型字段信息并更新字段缓存
            $this->table("field")->where("mid={$this->mid}")->del();
            //更新模型缓存
            return $this->updateCache();
        }
    }
    /**
     * 创建模型表
     */
    public function createModelSql($tableName)
    {
        $zhubiaoSql = file_get_contents(
            MODULE_PATH . 'Data/ModelSql/zhubiao.sql'
        );
        $fuBiaoSql = file_get_contents(
            MODULE_PATH . 'Data/ModelSql/zhubiao_data.sql'
        );
        $zhubiaoSql = preg_replace(
            array('/@pre@/', '/@table@/'), array(C("DB_PREFIX"), $tableName),
            $zhubiaoSql
        );
        $Model = M();
        if ($Model->exe($zhubiaoSql) === false) {
            $this->error = '创建主表失败';

            return false;
        }
        $fuBiaoSql = preg_replace(
            array('/@pre@/', '/@table@/'), array(C("DB_PREFIX"), $tableName),
            $fuBiaoSql
        );
        if ($Model->exe($fuBiaoSql) === false) {
            $this->error = '创建副表失败';

            return false;
        }

        return true;
    }



    //更新模型缓存
    public function updateCache()
    {
        /**
         * 更新模型缓存
         */
        $model = M('model')->order('mid ASC')->all();
        $cache = array();
        foreach ($model as $m) {
            $cache[$m['mid']] = $m;
        }
        $stat = S('model', $cache);
        if ($stat) {
            //更新字段缓存
            $this->fieldCache();
            //更新flag属性缓存
            $this->FlagCache();
            return true;
        } else {
            $this->error = '缓存更新失败';

            return false;
        }
    }

    /**
     * 字段缓存
     * @return bool
     */
    private function fieldCache()
    {
        $model = M('model')->all();
        foreach ($model as $m) {
            $fieldData = M("field")->where("mid={$m['mid']}")->order('fieldsort ASC')->all();
            $cacheData = array();
            foreach ($fieldData as $field) {
                $field['set'] = unserialize($field['set']);
                $cacheData[$field['field_name']] = $field;
            }
            if (S('field' . $m['mid'], $cacheData)) {
                //删除表结构缓存
                $table = C('DB_PREFIX') . $this->model[$m['mid']]['table_name'];
                $cache = array(
                    APP_TABLE_PATH . C('DB_DATABASE') . '.' . $table,
                    APP_TABLE_PATH . C('DB_DATABASE') . '.' . $table . '_data'
                );
                foreach ($cache as $c) {
                    if (is_file($c) && is_writeable(dirname($c))) {
                        @unlink($c);
                    }
                }
            }
        }
        return true;
    }

    /**
     * 文章属性缓存
     */
    private function FlagCache()
    {
        $model = M('model')->all();
        foreach ($model as $m) {
            $result = M()->query('DESC ' . C('DB_PREFIX') . $m['table_name']);
            $flag = array();
            foreach ($result as $field) {
                if ($field['Field'] == 'flag') {
                    $tmp = substr($field['Type'], 4, -2);
                    $flag = explode(',', str_replace("'", '', $tmp));
                    break;
                }
            }
            S('flag' . $m['mid'], $flag);
        }
        return true;
    }
}