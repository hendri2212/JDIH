<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkPlan extends Model
{
    use HasFactory;

    protected $primaryKey = "id_work_plan";

    public function author(){
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
