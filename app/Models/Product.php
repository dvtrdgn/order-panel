<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    const PAGINATION_COUNT = 10;
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }   

    public function orders()
    {
        return $this->hasMany(Order::class);
    }   

    public static function search($search)
    {
        return empty($search) ? static::query()
            :  static::query()->where('title', 'like', '%' . $search . '%')
            ->orWhereHas('category', function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            });
    }
}
