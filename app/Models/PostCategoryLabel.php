<?php

namespace App\Models;

use App\Enums\PostCategoryEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategoryLabel extends Model
{
    use HasFactory;
    protected $fillable = ['post_id', 'category'];

    protected $casts = [
        'category' => PostCategoryEnum::class,
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
