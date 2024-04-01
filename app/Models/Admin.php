<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'email', 'position'];

    public function events()
    {
        return $this->hasMany(Event::class, 'adminId');
    }
}
