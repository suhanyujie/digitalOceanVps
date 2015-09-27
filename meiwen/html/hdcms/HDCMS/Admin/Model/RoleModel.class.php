<?php

/**
 * 角色
 * Class RoleModel
 * @author 向军 <2300071698@qq.com>
 */
class RoleModel extends Model
{
    //角色表
    public $table = 'role';
    //验证
    public $validate = array(
        array('rname', 'null', '角色名不能为空', 2, 3),
        array('rname', 'IsRname', '角色已经存在', 2, 3),
    );

    //角色名验证
    public function IsRname($name, $value, $msg, $arg)
    {
        if ($rid = Q('rid', 0, 'intval')) {
            $map['rid'] = array('NEQ', $rid);
        }
        $map['rname'] = $value;
        if (M('role')->where($map)->find()) {
            return $msg;
        } else {
            return true;
        }
    }

    //添加角色
    public function addRole()
    {
        if ($this->create()) {
            if ($this->add()) {
                return true;
            } else {
                $this->error = '添加失败';
            }
        }
    }

    //添加角色
    public function editRole()
    {
        if ($this->create()) {
            if ($this->save()) {
                return true;
            } else {
                $this->error = '修改失败';
            }
        }
    }

    //删除角色
    public function delRole($rid)
    {
        $rid = Q('rid', 0, 'intval');
        if ($this->del($rid)) {
            M("user")->where(array('rid' => $rid))->save(array('rid' => 4));
            return true;
        } else {
            $this->error = '删除失败';
        }
    }


}
