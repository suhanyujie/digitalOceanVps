<?php
/**
 * 文章操作类
 * 
 */
namespace Home\Model;
use Think\Model;


class ArticleModel extends Model{
	protected $trueTableName = 'uctoo_article_article';
	
	/**
	 * 获取所有文章，按id倒序排列
	 * 
	 */
	public function getAllArticle(){
		$arti = M('article_article');
		$sql = 'select a.id,a.title,a.source,a.publishTime,b.content from uctoo_article_article as a left join 
		uctoo_article_content_1 as b on a.id=b.docId order by a.id desc limit 10';
		$dataList = $arti->query($sql);
		if($dataList){
			foreach($dataList as $key=>$value){
				$dataList[$key]['desc'] = $this->getDocDescribe(strip_tags($value['content']),150).'...<a href="'.$value['source'].'">[阅读更多]</a>';
			}
		}
		
		return $dataList;
	}
	
	/**
	 * 获取一篇文章的简介部分
	 * @params string $content 	传入文章的文章内容
	 * @params int	  $num 		传入返回制定数量的字串简介
	 * @return string $result  	返回制定字数的简介
	 */
	 public function getDocDescribe($content,$num=45){
	 	return mb_substr($content,0,$num,'utf-8');
	 }
	
	/**
	 * 获取部分推荐的文章标题
	 * @params int	  $num 		需要推荐多少篇文章
	 * @params int	  $type 	按什么类型推荐：1.最新；2.评论最多 。默认按最新推荐
	 * @return array  $result  	返回一组文章标题和url
	 */
	 public function getRecommendDoc($num=9,$type=1){
	 	$arti = M('article_article');
		$dataList = $arti->field('id,title,source')->order('id desc')->limit($num)->select();
		
		return $dataList;
	 }
	
}

