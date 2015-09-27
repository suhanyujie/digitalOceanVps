<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;


/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class IndexController extends HomeController
{

    //系统首页
    public function index()
    {
        hook('homeIndex');
        $default_url = C('DEFUALT_HOME_URL');//获得配置，如果为空则显示聚合，否则跳转
        if ($default_url != '') {
            redirect(get_nav_url($default_url));
        }
		
		$arti = M('article_article');
		$arti2 = new \Home\Model\ArticleModel();
		# 首页文章列表
		$data1 = $arti2->getAllArticle();
		# 右侧推荐最新文章  获取5条
		$data2 = $arti2->getRecommendDoc(5);
		
		$this->assign('list',$data1);
		$this->assign('recList',$data2);
		
        $this->display();
    }

    function help() {
        if (empty ( $_GET ['id'] )) {
            $this->error ( '公众号参数非法' );
        }
        $this->display ( );
    }

}