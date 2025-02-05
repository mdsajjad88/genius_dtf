<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = ['name', 'created_by', 'updated_by'];
    public function creator(){
        return $this->belongsTo(User::class, 'created_by');
    }

}
