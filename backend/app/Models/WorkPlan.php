<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class WorkPlan extends Model
{
    use HasFactory;

    protected $primaryKey = "id_work_plan";

    public function author(){
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    private function createSlug($title){
        if (static::whereSlug($slug = Str::slug($title))->exists()) {
            $max = static::whereTitle($title)->latest($this->primaryKey)->skip(1)->value('slug');
            if($max != null) {
                if (is_numeric($max[-1])) {
                    return preg_replace_callback('/(\d+)$/', function ($mathces) {
                        return $mathces[1] + 1;
                    }, $max);
                }
      
                return "{$slug}-2";
            }
            return $slug;
        }
  
        return $slug;
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = $this->createSlug($value);
    }
}
