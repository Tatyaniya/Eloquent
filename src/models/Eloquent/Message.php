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
 * @property-read $create_at
 * @property-read User $author
 */
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

    /**
     * отношение сообщения к пользователю
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * генерируем случайное имя картинке
     * @return string
     */
    public function getImageName()
    {
        return sha1(microtime(1) . mt_rand(1, 100000000)) . '.jpg';
    }

    /**
     * сохраняем картинку в папку
     * @param string $file
     */
    public function loadImage(string $file)
    {
        if (!empty($file)) {
            $this->image = $this->getImageName();
            move_uploaded_file($file, getcwd() . '/images/' . $this->image);
        }
    }

    public function addMes($userId, array $data, $file = 0)
    {
        $pdo = new DB();

        $this->image = $file;

        $this->text = $data['text'];

        $query = ("INSERT INTO messages (user_id, `date`, text, image) VALUES (:user_id, :date, :text, :image)");
        $result = $pdo->connect()->prepare($query);
        $result->execute([
            'user_id' => $userId,
            'date' => date('Y-m-d H:i:s'),
            'text' => $this->text,
            'image' => $this->image
        ]);
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * получаем все сообщения из базы
     *
     * @return Message[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getMessages()
    {
        return Message::all();
    }

    /**
     * удаление сообщений
     *
     * @param $id
     * @return bool|null
     */
    public function remove($id)
    {
        $user = User::find($id);
        if ($user !== null) {
            $user->delete();
        }
        //return User::find($id)->delete();
    }

    /**
     * находим 1 сообщение в базе
     * @param $id
     * @return mixed
     */
    public function getOneMes($id)
    {
        return self::where('id', '=', $id)->first();
    }
}