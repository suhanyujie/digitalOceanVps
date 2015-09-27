<?php

/**
 * 内容模型工厂类
 * Class ContentModel
 */
class ContentModel extends RelationModel
{
    //模型对象
    static private $_instance = array();

    //实例化模型对象
    static public function getInstance($mid)
    {
        if (empty(self::$_instance[$mid])) {
            $modelCache = S('model');
            $table = $modelCache[$mid]['table_name'];
            $model = new self($table);
            //副表
            $model->relation[$table . '_data'] = array('type' => HAS_ONE, 'foreign_key' => 'aid', 'parent_key' => 'aid');
            self::$_instance[$mid] = $model;
            return $model;
        } else {
            return self::$_instance[$mid];
        }
    }

    //添加验证规则
    public function addValidate($validate)
    {
        $this->validate[] = $validate;
    }
}