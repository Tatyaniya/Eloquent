<?php

namespace App\Models\Eloquent;

use App\Models\User;
use \Illuminate\Database\Eloquent\Model as Model;

class Message extends Model
{
    public $table = 'messages';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'text',
        'image',
        'create_at'
    ];

    public function userdata()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}