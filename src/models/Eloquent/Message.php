<?php

namespace App\Models\Eloquent;

use \Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Message
 * @package App\Models\Eloquent
 *
 * @property-read $id
 * @property-read $user_id
 * @property-read $text
 * @property-read $image
 * @property-read $date
 * @property-read User $author
 */
class Message extends Model
{
    public $table = 'messages';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'text',
        'image',
        'date'
    ];

    /**
     * отношение сообщения к пользователю
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault([
            'name' => 'удаленный пользователь'
        ]);
    }

    /**
     * генерируем случайное имя картинке
     *
     * @return string
     */
    public function getImageName()
    {
        return sha1(microtime(1) . mt_rand(1, 100000000)) . '.jpg';
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * сохраняем картинку в папку
     *
     * @param string $file
     */
    public function loadImage(string $file)
    {
        if (!empty($file)) {
            $this->image = $this->getImageName();
            move_uploaded_file($file, getcwd() . '/images/' . $this->image);
        }
    }

    /**
     * находим 1 сообщение в базе
     *
     * @param $id
     * @return mixed
     */
    public function getOneMes($id)
    {
        return self::where('id', '=', $id)->first();
    }
}