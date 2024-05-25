<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    // Create a many to many relationship with the customer
    public function customer(){
        return $this->hasMany(Customer::class);
    }
}
