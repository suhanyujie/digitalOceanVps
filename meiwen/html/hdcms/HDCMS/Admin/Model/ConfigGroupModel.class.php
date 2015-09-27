<?php

/**
 * 配置组管理模型
 * Class ConfigGroupModel
 * @author 后盾向军 <2300071698@qq.com>
 */
class ConfigGroupModel extends Model
{
    //配置组
    public $table = 'config_group';

    //自动验证
    public $validate = array(
        array('cgname', 'nonull', '组名不能为空', 2, 3),
        array('cgname', 'IsCgname', '组名已经存在', 2, 3),
        array('cgtitle', 'nonull', '组标题不能为空', 2, 3),
        array('cgtitle', 'IsCgtitle', '组标题已经存在', 2, 3)
    );

    //验证组名
    public function IsCgname($name, $value, $msg, $arg)
    {
        $cgname = Q('cgname');
        //编辑时排除当前配置组
        if ($cgid = Q('cgid')) {
            $map['cgid'] = array('NEQ', $cgid);
        }
        $map['cgname'] = array('EQ', $cgname);
        if (M('config_group')->where($map)->find()) {
            return $msg;
        } else {
            return true;
        }
    }

    //组标题
    public function IsCgtitle($name, $value, $msg, $arg)
    {
        $cgtitle = Q('cgtitle');
        //编辑时排除当前配置组
        if ($cgid = Q('cgid')) {
            $map['cgid'] = array('NEQ', $cgid);
        }
        $map['cgtitle'] = array('EQ', $cgtitle);
        if (M('config_group')->where($map)->find()) {
            return $msg;
        } else {
            return true;
        }
    }

    /**
     * 获取组列表
     * @return mixed
     */
    public function getGroup()
    {
        return $this->where(array('isshow' => 1))->all();
    }

    /**
     * 添加配置组
     */
    public function addConfigGroup()
    {
        if ($this->create()) {
            if ($this->add()) {
                return true;
            } else {
                $this->error = '添加失败';
            }
        }
    }

    /**
     * 修改配置组
     */
    public function editConfigGroup()
    {
        if ($this->create()) {
            if ($this->save()) {
                return true;
            } else {
                $this->error = '添加失败';
            }
        }
    }

    /**
     * 删除配置组
     * @return bool
     */
    public function delConfigGroup()
    {
        $cgid = Q('cgid', 0, 'intval');
        $map['cgid'] = array('EQ', $cgid);
        if ($this->where($map)->del()) {
            return M('config')->where("cgid=$cgid")->del();
        } else {
            $this->error('删除失败');
        }
    }
}