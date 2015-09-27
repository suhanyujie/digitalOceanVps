<?php

/**
 * 下载
 * Class DownloadController
 */
class DownloadController extends CommonController
{
    public function download()
    {
        $filename = Q('filename');
        $cid = Q('cid', 0, 'intval');
        if (empty($filename) || !$cid) {
            $this->error('参数错误');
        }
        $db = M('upload');
        $map['filename'] = array('EQ', $filename);
        $file = $db->where($map)->find();
        if (empty($file)) {
            $this->error('文件不存在');
        }
        $category = M('category')->find($cid);
        //不扣分
        if ($category['show_credits'] == 0) {
            header("Content-type:application/octet-stream");//二进制文件
            $fileName = $file['name'].'.'.$file['ext'];//获得文件名
            header("Content-Disposition:attachment;filename={$fileName}");//下载窗口中显示的文件名
            header("Accept-ranges:bytes");//文件尺寸单位
            header("Accept-length:" . filesize($file['size']));//文件大小
            readfile($file['path']);//读出文件内容
        }
    }

    protected function _404()
    {
        _404();
    }
}