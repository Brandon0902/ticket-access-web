<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'email'];

    public function events()
    {
        return $this->hasMany(Event::class, 'customerId');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'customerId');
    }
}