<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    protected $fillable = ['title', 'content'];
    protected $casts = [
        'pending' => 'boolean',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function latestComments(){
        return $this->comments()->orderBy('created_at', 'DESC');
       // return $this->comments()->orderBy('created_at', 'DESC')->paginate();
      //  return DB::table('comments')->orderBy('created_at', 'desc')->where('post_id', $this->id)->paginate(7);


    }

    // Mutators

    public function setTitleAttribute($value){

        $this->attributes['title'] = $value;

        $this->attributes['slug']  = Str::slug($value);
    }

    public function getUrlAttribute(){
        return route('posts.show', [$this->id, $this->slug]);
    }
}
