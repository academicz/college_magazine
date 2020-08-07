<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int user_id
 * @property mixed article_category_id
 * @property mixed title
 * @property mixed story
 * @property string cover_image
 * @property int status
 */
class Article extends Model
{
    public function article_category()
    {
        return $this->belongsTo('App\Models\ArticleCategory');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function article_comment()
    {
        return $this->hasMany('App\Models\ArticleComment', 'article_id');
    }
    public function user_like()
    {
        return $this->hasOne('App\Models\Like', 'article_id')->where('user_id',user()->id);
    }

    public function like()
    {
        return $this->hasMany('App\Models\Like', 'article_id');
    }

}
