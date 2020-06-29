<?php

namespace App\Models\Eloquent;

use \Illuminate\Database\Eloquent\Model as Model;

/**
 * Class User
 * @package App\Models\Eloquent
 *
 * @property-read $id
 * @property-read $name
 * @property-read $email
 * @property-read $password
 * @property-read $time
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
        return self::where('email', '=', $email)->first();
    }

    /**
     * получаем id пользователя
     *
     * @param int $id
     * @return mixed
     */
    public function getId(int $id)
    {
        return self::find($id);
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * генерация хеша пароля
     *
     * @param $password
     * @return string
     */
    public function getPasswordHash($password)
    {
        return $passwordHash = sha1($password . '.sdfifao38vj,');
    }

    /**
     * добавляем пользователя в базу
     *
     * @param array $data
     */
    public function add(array $data)
    {
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $this->getPasswordHash($data['password']),
            'time' => date('Y-m-d H:i:s')
        ];

        $user = new User($userData);
        $user->save();
    }
}