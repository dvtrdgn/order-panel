<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dealer extends Model
{
    use HasFactory, SoftDeletes;

    const PAGINATION_COUNT = 10;

    protected $fillable = [
        'name',
        'email',
        'status',
        'description',
        'phone',
        'order',
        'image',
    ];


    public function users()
    {
        return $this->hasMany(User::class);
    }
  
    // public function orders()
    // {
    //     return $this->hasMany('App\Models\Order');
    // }

    public static function search($search)
    {
        return empty($search) ? static::query()
            :  static::query()->where('name', 'like', '%' . $search . '%');
    }
}
