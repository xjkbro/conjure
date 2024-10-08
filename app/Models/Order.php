<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

}
