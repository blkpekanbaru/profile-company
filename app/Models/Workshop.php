<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;
    protected $fillable = [
        'department_id',
        'name',
        'slug',
        'image',
        'external_link',
        'status',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function getImageUrlAttribute()
    {
        if (str_starts_with($this->image, 'assets/')) {
            return asset($this->image);
        }
        return asset('storage/' . $this->image);
    }
}
