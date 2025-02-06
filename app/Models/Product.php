<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
         'store_id', 'category_id', 'name', 'price', 'created_by', 'updated_by', 'created_at', 'updated_at'
    ];
    public function creator(){
        return $this->belongsTo(User::class, 'created_by');
    }
    public function store(){
        return $this->belongsTo(Store::class, 'store_id');
    }
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');

    }
}
