<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'store_id', 'name', 'created_by', 'updated_by', 'created_at', 'updated_at'
    ];
    public function creator(){
        return $this->belongsTo(User::class, 'created_by');
    }
    public function store(){
        return $this->belongsTo(Store::class, 'store_id');
    }

}
