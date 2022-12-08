<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    const PAGINATION_COUNT = 10;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function dealer()
    {
        return $this->belongsTo(Dealer::class);
    }

    public static function search($search)
    {
        return empty($search) ? static::query()
            :  static::query()->where('id', 'like', '%' . $search . '%')
            ->orWhereHas('product', function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function totalCountForOneProduct($dealer_id)
    {
        return  Order::where('product_id', $this->product_id)
            ->where('isCompleted', 0)
            ->where('dealer_id', $dealer_id)
            ->where('orderlist_id', '!=', null)
            ->where('isDealerCompleteOrder', 1)->get();
    }

    public function orderlist()
    {
        return $this->belongsTo(Orderlist::class);
    }
}
