<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    public function articles()
    {
        return $this->hasMany('App\Models\Article', 'article_category_id')->where('status',1);
    }
}
