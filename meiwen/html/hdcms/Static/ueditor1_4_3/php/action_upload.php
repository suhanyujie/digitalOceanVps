<?php
/**
 * 上传附件和上传视频
 * User: Jinqn
 * Date: 14-04-09
 * Time: 上午10:17
 */
define( 'HDPHP_PATH', 'HDCMS/HDPHP/' );
include "Uploader.class.php";
require "../../../HDCMS/HDPHP/Lib/Function/Functions.php";
include "../../../HDCMS/HDPHP/Extend/Tool/Image.class.php";
C( require "../../../HDCMS/Common/Config/config.inc.php" );

//echo $root;exit;
/* 上传配置 */
$base64 = "upload";
switch ( htmlspecialchars( $_GET['action'] ) ) {
	case 'uploadimage':
		$config    = array(
			"pathFormat" => WEB_PATH . $CONFIG['imagePathFormat'],
			"maxSize"    => $CONFIG['imageMaxSize'],
			"allowFiles" => $CONFIG['imageAllowFiles']
		);
		$fieldName = $CONFIG['imageFieldName'];
		break;
	case 'uploadscrawl':
		$config    = array(
			"pathFormat" => WEB_PATH . $CONFIG['scrawlPathFormat'],
			"maxSize"    => $CONFIG['scrawlMaxSize'],
			"allowFiles" => $CONFIG['scrawlAllowFiles'],
			"oriName"    => "scrawl.png"
		);
		$fieldName = $CONFIG['scrawlFieldName'];
		$base64    = "base64";
		break;
	case 'uploadvideo':
		$config    = array(
			"pathFormat" => WEB_PATH . $CONFIG['videoPathFormat'],
			"maxSize"    => $CONFIG['videoMaxSize'],
			"allowFiles" => $CONFIG['videoAllowFiles']
		);
		$fieldName = $CONFIG['videoFieldName'];
		break;
	case 'uploadfile':
	default:
		$config    = array(
			"pathFormat" => WEB_PATH . $CONFIG['filePathFormat'],
			"maxSize"    => $CONFIG['fileMaxSize'],
			"allowFiles" => $CONFIG['fileAllowFiles']
		);
		$fieldName = $CONFIG['fileFieldName'];
		break;
}

/* 生成上传实例对象并完成上传 */
$up = new Uploader( $fieldName, $config, $base64 );
//加水印
$info = $up->getFileInfo();
if ( $info['state'] == 'SUCCESS' ) {
	$ImageObj                = new Image();
	$ImageObj->waterImg      = "../../../" . C( 'WATER_IMG' );
	$ImageObj->waterTextFont = "../../../HDCMS/HDPHP/Data/Font/font.ttf";
	$file
	                         =
		'../../../' . substr( $info['url'], strpos( $info['url'], 'Upload' ) );
	if ( preg_match( '/\.(jpeg|jpg|gif|png)/i', $info['type'] )
	     && C( 'WATER_ON' )
	) {
		$s = $ImageObj->water( $file, $file );
	}
}
/**
 * 得到上传文件所对应的各个参数,数组结构
 * array(
 *     "state" => "",          //上传状态，上传成功时必须返回"SUCCESS"
 *     "url" => "",            //返回的地址
 *     "title" => "",          //新文件名
 *     "original" => "",       //原始文件名
 *     "type" => ""            //文件类型
 *     "size" => "",           //文件大小
 * )
 */

/* 返回数据 */
return json_encode( $up->getFileInfo() );