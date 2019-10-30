<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';
    protected $fillable = [
        'id', 'name'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function conversations()
    {
        return $this->belongsToMany(Conversation::class);
    }

    public function hasUser($user_id)
    {
        foreach ($this->users as $user) {
            if ($user->id == $user_id) {
                return true;
            }
        }
    }

}
