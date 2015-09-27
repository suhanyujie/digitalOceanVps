<?php

/**
 * Number字段
 * Class InputModel
 */
class NumberModel extends FieldModel
{
    /**
     * 添加字段
     */
    public function addField()
    {
        if ($this->DataValidate()) {
            /**
             * 修改表结构
             */
            $table = C('DB_PREFIX') . $this->data['table_name'];
            $fieldName = $this->data['field_name'];
            /**
             * 字段规格
             */
            $set = $this->data['set'];
            if ($set['field_type'] == 'decimal') {
                $e = isset($set['num_decimal']) ? $set['num_decimal'] : 0;
                $fieldSet = " DECIMAL({$set['num_integer']},{$e}) NOT NULL DEFAULT 0";
            } else {
                $fieldSet = " {$set['field_type']}({$set['num_integer']}) NOT NULL DEFAULT 0";
            }
            $sql = "ALTER TABLE {$table} ADD {$fieldName} {$fieldSet} ";
            if (M()->exe($sql)) {
                /**
                 * 添加field表记录
                 */
                $this->data['set'] = serialize($_POST['set']);
                if ($this->add()) {
                    return $this->updateCache();
                } else {
                    $this->error = '添加字段失败';
                }
            }
        }
    }

    /**
     * 修改表单
     */
    public function editField()
    {
        if ($this->DataValidate()) {
            /**
             * 添加field表记录
             */
            $this->data['set'] = serialize($_POST['set']);
            if ($this->save()) {
                return $this->updateCache();
            } else {
                $this->error = '添加字段失败';
            }
        }
    }

    /**
     * 验证set值
     */
    private function DataValidate()
    {
        /**
         * 父类自动验证
         */
        if (!$this->create()) {
            return false;
        }
        if (!empty($_POST['set']['num_decimal']) && !is_numeric($_POST['set']['num_decimal'])) {
            $this->error = '小数位数错误';

            return false;
        }
        if (isset($_POST['set']['num_integer']) &&!is_numeric($_POST['set']['num_integer'])) {
            $this->error = '整数位置错误';

            return false;
        }
        if (!is_numeric($_POST['set']['size'])) {
            $this->error = '显示长度错误';

            return false;
        }
        return true;
    }
}