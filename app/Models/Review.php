<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;


    protected $table = 'reviews';


    protected $fillable = [
        'product_id',
        'user_id',
        'parent_id',
        'rating',
        'komentar',
        'foto',
        'likes',
        'dislikes',
    ];


     public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

 
    public function user()
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }

   
    public function parent()
    {
        return $this->belongsTo(Review::class, 'parent_id');
    }

   
    public function replies()
    {
        return $this->hasMany(Review::class, 'parent_id')->latest();
    }
}
