<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table = 'departments';

    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'total_workshops',
        'status'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function workshops()
    {
        return $this->hasMany(Workshop::class);
    }

    public function getImageUrlAttribute()
    {
        if (str_starts_with($this->image, 'assets/')) {
            return asset($this->image);
        }
        return asset('storage/' . $this->image);
    }
}
