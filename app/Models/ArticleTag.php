<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleTag extends Model
{
    use HasFactory;

    protected $table = 'article_tag';

    protected $fillable = [
        'article_id',
        'tag_id',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
