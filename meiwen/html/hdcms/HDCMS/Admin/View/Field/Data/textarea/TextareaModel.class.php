<?php

/**
 * Textarea字段
 * Class InputModel
 */
class TextareaModel extends FieldModel
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
            $sql
                = "ALTER TABLE {$table} ADD {$fieldName} TEXT ";
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

        if (!is_numeric($_POST['set']['width'])) {
            $this->error = '宽度错误';

            return false;
        }
        if (!is_numeric($_POST['set']['height'])) {
            $this->error = '高度错误';

            return false;
        }
        return true;
    }
}