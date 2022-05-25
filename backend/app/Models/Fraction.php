<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fraction extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_fraction';

    public function users(){
        return $this->hasMany(User::class, 'id_fraction', 'id_fraction');
    }
    
}
