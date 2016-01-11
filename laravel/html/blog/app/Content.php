<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'content';
    protected $fillable =array('id','article_id','content','created_at','updated_at');
    protected $dates = ['publish_date'];


    /**
     * Get the article that owns the Content.
     */
    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
