<?php

namespace App\Models\Eloquent;

use App\Models\Eloquent\DB;
use \Illuminate\Database\Eloquent\Model as Model;

/**
 * Class User
 * @package App\Models\Eloquent
 *
 * @property-read $id
 * @property-read $name
 * @property-read $email
 * @property-read $password
 * @property-read $date
 */
class User extends Model
{
    public $table = 'users';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'password',
        'create_at'
    ];

    /**
     * определяем отношение с постами - 1 ко многим
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany('App\Models', 'user_id', 'id');
    }

    /**
     * получаем пользователя по емейл
     *
     * @param $email
     * @return mixed
     */
    public function get($email)
    {
//        $db = new DB();
//        return $db->connect()->where('email', '=', $email)->first();
        //return self::where('email', '=', $email)->first();

        return self::select('*')->where('email', '=', $email)->first();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getId(int $id)
    {
        return self::find($id);
    }

    /**
     * генерация хеша пароля
     * @param $password
     * @return string
     */
    public function getPasswordHash($password)
    {
        return $passwordHash = sha1($password . '.sdfifao38vj,');
    }

    /**
     * Добавление пользователя в базу
     *
     * @param array $data
     * @param $password
     */
    public function add(array $data)
    {
        $user = new User();
        if($user->get($data['email'])) {
            echo 'Пользователь с таким мылом уже существует';
            exit();
        }

        $this->name = $data['name'];
        $this->password = $this->getPasswordHash($data['password']);
        $this->email = $data['email'];
        $this->date = date('Y-m-d H:i:s');

        $user->save();
    }
}