<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderlist extends Model
{
    use HasFactory;
    const PAGINATION_COUNT = 10;

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function checkWaitingOrderList(){
        return $this->orders()->where('isCompleted', 0)
        ->where('isDealerCompleteOrder', 1)
        ->where('orderlist_id','!=' , null);
    }

    public static function search($dateFrom, $dateTo)
    {
        return  empty($dateFrom) ||  empty($dateTo) ? static::query()
            :  static::query()
            ->whereDate('created_at','<=', $dateTo)
            ->whereDate('created_at','>=', $dateFrom);
    }
}
