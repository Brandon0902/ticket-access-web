<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'date', 'location', 'adminName', 'description', 'image', 'ticket_quantity', 'ticket_price'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }


    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
