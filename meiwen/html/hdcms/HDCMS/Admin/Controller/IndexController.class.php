<?php

/**
 * 后台首页
 * Class IndexControl
 *
 * @category Admin
 * @author   向军 <2300071698@qq.com>
 */
class IndexController extends AuthController
{

    /**
     * 后台首页
     */
    public function index()
    {
        /**
         * 站长或超级管理员返回所有菜单
         */
        if (IS_SUPER_ADMIN || IS_WEBMASTER) {
            $node = M('node')->where("is_show=1")->order('list_order ASC')->all();
        } else {
            /**
             * 管理员权限节点
             */
            $node = M()
                ->join(" __access__ a RIGHT __node__ n JOIN ON n.nid=a.nid")
                ->where("n.is_show=1 AND (n.type=2 OR a.rid={$_SESSION['user']['rid']})")
                ->order('list_order ASC')
                ->all();
        }
        $node = Data::channelLevel($this->addNodeUrl($node), 0, '&nbsp;',
            'nid');
        //分配菜单节点
        $this->assign('node', $node);
        //-----------------------------------------------------------------------------------
        /**
         * 快捷菜单节点
         */
        $quickMenu = M()
            ->join("__menu_favorite__ m JOIN __node__ n ON m.nid=n.nid")
            ->where("uid={$_SESSION['user']['uid']}")->all();
        $this->assign('quickMenu', $this->addNodeUrl($quickMenu));
        $this->display();
    }

    /**
     * 获得节点菜单
     *
     * @param $node
     *
     * @return mixed
     */
    private function addNodeUrl($node)
    {
        if (empty($node)) {
            return array();
        }
        /**
         * 设置链接
         */
        foreach ($node as $n => $v) {
            if (empty($v['group'])) {
                $group = '';
            } else {
                $group = "g={$v['group']}&";
            }
            $param = empty($v['param']) ? '' : '&' . $v['param'];
            $node[$n]['url'] = __ROOT__
                . "/index.php?{$group}m={$v['module']}&c={$v['controller']}&a={$v['action']}" . $param;
        }

        return $node;
    }


    //欢迎页
    public function welcome()
    {
        //客户端版本验证(本地不验证)
        if (mt_rand(1, 10) == 1 && function_exists('curl_init') && !preg_match('@localhost|127.0.0.1|192.168.@', __ROOT__)) {
            $curl = curl_init();
            $version = C('HDCMS_VERSION');
            // 设置URL和相应的选项
            curl_setopt(
                $curl, CURLOPT_URL,
                'http://www.hdphp.com/version.php?version=' . $version . '&web='. __ROOT__
            );
            curl_setopt($curl, CURLOPT_HEADER, 0);
            //超时时间
            curl_setopt($curl, CURLOPT_TIMEOUT, 10);
            //结果保存在字符串中
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $data = curl_exec($curl);
            curl_close($curl);
            $json = unserialize($data);
            if ($json && $json['status'] == 'haveUpdate') {
                $this->assign('updateMessage', $json['message']);
            } else {
                $this->assign('updateMessage', 0);
            }
        }
        //首次登录时更新缓存
        $this->display();
        if (!S('model')) {
            $_POST['action'] = 'all';
            go(U('Cache/index', array('action' => 'Config')));
        }
    }
}
