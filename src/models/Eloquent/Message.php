<?php

namespace App\Models\Eloquent;

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

    public function getMessages()
    {
        $pdo = new DB();

        $messages = "SELECT * FROM messages";

        $result = $pdo->connect()->prepare($messages);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        return User::find($id)->delete();
    }
}