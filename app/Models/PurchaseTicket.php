<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseTicket extends Model
{
    use HasFactory;

    protected $fillable = ['purchase_id', 'ticket_id'];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
