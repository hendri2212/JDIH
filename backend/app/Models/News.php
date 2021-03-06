<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_news';

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function author(){
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class, 'news_tag', 'news_id', 'tag_id');
    }

    private function createSlug($title){
        if (static::whereSlug($slug = Str::slug($title))->exists()) {
            $max = static::whereTitle($title)->latest('id_news')->skip(1)->value('slug');
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
