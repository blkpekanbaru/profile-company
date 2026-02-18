<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    use HasFactory;
    protected $fillable = ['post_id', 'path'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function getUrlAttribute()
    {
        // Jika path diawali dengan 'assets/', maka ambil langsung dari folder public
        if (str_starts_with($this->path, 'assets/')) {
            return asset($this->path);
        }

        // Jika tidak (hasil upload), ambil dari folder storage/public
        return asset('storage/' . $this->path);
    }
}
