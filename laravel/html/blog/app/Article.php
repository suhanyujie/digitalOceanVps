<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Article extends Model
{
	protected $table = 'articles';
	protected $fillable =array('created_at','updated_at','title','class_id','subclass_id','publish_date','publish_status','status');
	protected $dates = ['publish_date'];

	/**
	 * @param $date
	 * setPublishDateAttribute/setTitleAttribute
	 */
	public function setPublishDateAttribute($date){
		#$this->attributes['publish_date'] = Carbon::createFromFormat('Y-m-d H:i:s',$date);
		$this->attributes['publish_date'] = strtotime($date);
	}
	/**
	 * 发布的条件限制
	 * scope+方法名
	 */
	public function scopePublished($query){
		$query->where('publish_date','<=',time());
	}

	public function user(){
		return $this->belongsTo('App\User');
	}
	/**
	 * Get the content record associated with the article.
	 */
	public function hasOneContent()
	{
		return $this->hasOne('App\Content','article_id','id');
	}



}// 类结束符
          