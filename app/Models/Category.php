<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    const PAGINATION_COUNT = 10;

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }


    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }


    public static function search($search)
    {
        return empty($search) ? static::query()
            :  static::query()->where('title', 'like', '%' . $search . '%');
    }
}
