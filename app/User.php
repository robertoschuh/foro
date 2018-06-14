<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function subscriptions(){

        return $this->belongsToMany(Post::class, 'subscriptions'); // Custom pivot table name
    }

    public function comment(Post $post, $message){

        $comment = new Comment([
            'comment' => $message,
            'post_id'  => $post->id
        ]);

        $this->comments()->save($comment);
    }

    public function isSubscribe(Post $post){

        return $this->subscriptions()->where('post_id', $post->id)->count() > 0;
    }

    public function subscribeTo($post){
        return auth()->user()->subscriptions()->attach($post);
    }
    public function owns($post){
        return $this->id === $post->user->id;
    }


}
