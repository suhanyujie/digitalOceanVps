<?php

/**
 *
 * Class FavoriteMenuController
 */
class FavoriteMenuController extends AuthController
{
    //设置常用菜单
    public function set()
    {
        if (IS_POST) {
            $favoriteModel = M('menu_favorite');
            //删除旧的收藏
            $map['uid']=$_SESSION['user']['uid'];
            $favoriteModel->where($map)->del();
            if (!empty($_POST['nid'])) {
                foreach ($_POST['nid'] as $nid) {
                    $data=array(
                        'uid' => $_SESSION['user']['uid'],
                        'nid' => $nid
                    );
                    $favoriteModel->add($data);
                }
            }
            $this->success('设置成功，请刷新后台');
        } else {
            $nodeModel = M('node');
            $pre = C('DB_PREFIX');
            if (IS_SUPER_ADMIN || IS_WEBMASTER) {
                $sql = "SELECT n.nid,n.pid,m.uid,n.title FROM {$pre}node AS n  LEFT JOIN
							 (SELECT * FROM {$pre}menu_favorite WHERE uid={$_SESSION['user']['uid']}) AS m
							 ON n.nid = m.nid WHERE n.is_show=1";
            } else {
                $sql = "SELECT n.nid,n.pid,m.uid,n.title FROM {$pre}node AS n  LEFT JOIN  {$pre}access AS a ON n.nid=a.nid LEFT JOIN
							 (SELECT * FROM {$pre}menu_favorite WHERE uid={$_SESSION['user']['uid']}) AS m ON n.nid = m.nid
							 WHERE n.type=2 OR (n.show=1 AND m.nid is not null)";
            }
            $nodeData = $nodeModel->query($sql);
            $nodeData = Data::channelLevel($nodeData, 0, "", "nid");
            $this->assign('data', $nodeData);
            $this->display();
        }
    }

}