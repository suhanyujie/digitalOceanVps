<?php

/**
 * 角色
 * Class RoleModel
 * @author 向军 <2300071698@qq.com>
 */
class GroupModel extends Model
{
    //角色表
    public $table = 'role';
    public $auto = array(
        array('creditslower', 'intval', 'function', 2, 3)
    );
    //验证
    public $validate = array(
        array('rname', 'null', '组名不能为空', 2, 3),
        array('rname', 'IsRname', '会员组已经存在', 2, 3),
        array('creditslower', 'nonull', '积分不能为空', 2, 3),
    );

    //验证会员组
    public function IsRname($name, $value, $msg, $arg)
    {
        $rid = Q('rid', 0, 'intval');
        if ($rid) {
            $map['rid'] = array('NEQ', $rid);
        }
        $map['rname'] = $value;
        if (M('role')->where($map)->find()) {
            return $msg;
        } else {
            return true;
        }
    }

    //添加会员组
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

    //添加会员组
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

    //删除组
    public function delRole()
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
