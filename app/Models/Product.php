<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\orderItems;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
public function orderItems()
{
    return $this->hasMany(OrderItem::class, 'product_id', 'id');
}

public function category() {
    return $this->belongsTo(Category::class, 'category_id');
}


}