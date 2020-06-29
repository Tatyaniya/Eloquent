<?php

namespace App\Controllers;

use App\Models\Eloquent\User;
use App\Models\Eloquent\Message;

class AdminController extends BaseController
{
    /**
     * AdminController constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        if ($_SESSION['user_id'] != ADMIN) {
            throw new \Exception();
        }
    }

    /**
     * выводим список порльзователей
     */
    public function users()
    {
        $isAdmin = ($_SESSION['user_id'] == ADMIN);

        $users = User::all()->sortBy('time');

        $displayAllUsers = [];
        foreach ($users as $user) {
            $displayAllUsers[] = [
                'id' => $user->id,
                'time' => date('Y-m-d H:i:s'),
                'email' => $user->email,
                'password' => $user->password,
                'name' => $user->name
            ];
        }

        $this->render('users', [
            'items' => $displayAllUsers,
            'is_admin' => $isAdmin
        ]);
    }

    /**
     * создаем пользователя
     *
     * @param array $data
     */
    public function create(array $data)
    {
        $errors = $this->valider($data);
        if (sizeof($errors) > 0) {
            header('Location: /?error=1');
            exit();
        }

        $model = new User();
        if($model->get($data['email'])) {
            echo'Пользователь с таким мылом уже существует';
            $this->users();
            exit();
        }

        $model->add($data);

        header('Location: /users');
        exit();
    }

    /**
     * удаляем сообщения
     */
    public function remove()
    {
        $id = (int)$_GET['id'] ?? 0;

        $message = Message::find($id);
        if ($message !== null) {
            if ($message['image']) {
                $file = 'images/' . $message['image'];

                if (file_exists($file)) {
                    unlink($file);
                }
            }

            $message->delete();
        }

        header('Location: /message');
        exit();
    }

    /**
     * удаление пользователей
     */
    public function removeuser()
    {
        $id = (int)$_GET['id'] ?? 0;

        $user = User::find($id);

        if ($user !== null) {
            $user->delete();
        }

        header('Location: /users');
        exit();
    }
}