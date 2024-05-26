<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    //what columns do we want to be used for this model
    protected $fillable = [
        'name',
        'type',
        'email',
        'address',
        'city',
        'state',
        'postal_code'
    ];

    // Create a many to many relationship with the invoices
    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
}
