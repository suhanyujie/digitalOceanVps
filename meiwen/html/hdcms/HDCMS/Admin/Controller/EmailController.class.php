<?php

/**
 * 邮箱模块
 * Class EmailController
 * @author 向军 <2300071698@qq.com>
 */
class EmailController extends AuthController
{
    public $db;

    public function __init()
    {
        $this->db = K('Email');
    }

    /**
     * 修改邮箱
     */
    public function email()
    {
        if (IS_POST) {
            $_POST = array_filter($_POST);
            foreach ($_POST as $name => $value) {
                $this->db->where("name='{$name}'")->save(array('value' => $value));
            }
            //更新缓存
            $this->db->updateCache();
            $this->success('设置成功');
        } else {
            $config = M('config')->where(array('cgid' => array('EQ', 4)))->getField('name,value,message,show_type,title');
            $this->assign('config', $config);
            $this->display();
        }
    }

    //验证EMAIL发送
    public function checkEmail()
    {
        import('@.Common.Org.Mail.Mail');
        $Config = array(
            'EMAIL_USERNAME' => $_POST['EMAIL_USERNAME'],
            'EMAIL_PASSWORD' => $_POST['EMAIL_PASSWORD'],
            'EMAIL_HOST' => $_POST['EMAIL_HOST'],
            'EMAIL_PORT' => $_POST['EMAIL_PORT'],
            'EMAIL_SSL' => false,
            'EMAIL_CHARSET' => 'utf-8',
            'EMAIL_FORMMAIL' => $_POST['EMAIL_USERNAME'],
            'EMAIL_FROMNAME' => $_POST['EMAIL_FROMNAME'],
        );
        C($Config);
        $status = Mail::send("houdunwangxj@gmail.com", "houdunwangxj@gmail.com", "HDCMS测试邮件", "使用者网站:" . __HOST__);
        if ($status) {
            $this->success('发送正常!');
        } else {
            $this->error('配置错误');
        }
    }
}