<?php
require_cache('HDCMS/Index/Lib/Url.class.php');
/**
 * Sitemap 插件
 * @author 后盾向军 <houdunwangxj@gmail.com>
 */

class IndexController extends AddonController {

    public function index() {
        $cache = S('category');
        $topCacegory = M('category')->where('pid=0')->all();
        $data=array();
        foreach($topCacegory as $cat){
            $cat['_data']=Data::channelList($cache,$cat['cid']);
            $data[$cat['cid']]=$cat;
        }
        $this->assign('data',$data);
        $this->display();
    }
}