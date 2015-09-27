<?php

/**
 * 缩略图字段
 * Class InputModel
 */
class ThumbModel extends FieldModel
{


    /**
     * 修改表单
     */
    public function editField()
    {
        /**
         * 添加field表记录
         */
        if ($this->save()) {
            return $this->updateCache();
        } else {
            $this->error = '添加字段失败';
        }
    }


}