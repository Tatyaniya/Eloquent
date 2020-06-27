<?php

namespace App\Models;

use \IIlluminate\Database\Eloquent\Model;

class User extends \IIlluminate\Database\Eloquent\Model
{
    public $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'create_at'
    ];

    // определяем отношение с постами - 1 ко многим
    public function messages()
    {
        return $this->hasMany('App\Models', 'user_id', 'id');
    }







    /**
     * получаем имя текущего пользователя
     * @param $userId
     * @return mixed
     */
    public function getUserName($userId)
    {
        $pdo = new DB();

        $query = "SELECT * FROM users WHERE id = :id";
        $result = $pdo->connect()->prepare($query);
        $result->execute([
            'id' => $userId
        ]);
        $user = $result->fetch(PDO::FETCH_ASSOC);

        return $user['name'];
    }

    /**
     * добавить пользователя в базу
     * @param array $data
     */
    public function add(array $data)
    {
        $pdo = new DB();

        $this->name = $data['name'];
        $this->password = $this->getPasswordHash($data['password']);
        $this->email = $data['email'];
        $this->date = date('Y-m-d H:i:s');

        $query = ("INSERT INTO users (`name`, email, password, `time`) VALUES (:name, :email, :password, :time)");
        $result = $pdo->connect()->prepare($query);
        $result->execute([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'time' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * получить пользоввтеля из базы
     * @param $email
     * @param $passwordInput
     * @return mixed
     */
    public function get($email, $passwordInput)
    {
        $pdo = new DB();

        $query = "SELECT * FROM users WHERE email = :email AND password = :password";
        $result = $pdo->connect()->prepare($query);
        $result->execute([
            'email' => $email,
            'password' => $passwordInput
        ]);
        return $result->fetch(PDO::FETCH_ASSOC);
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
}