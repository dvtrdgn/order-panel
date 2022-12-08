<?php

namespace App\Services;
use App\Models\Category;

class OrderService
{
    // find main category by category_id on order table
    public static function getProductMainCategoryName(int $categoryId = null)
    {
        $findCategory = Category::where('id', $categoryId)->first();
        return $findCategory->title;
    }
}
