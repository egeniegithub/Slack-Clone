<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

    protected $fillable = ['message','parent_msg_id'];

    /**
     * A message belong to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany('App\Message', 'parent_msg_id');
    }

}
