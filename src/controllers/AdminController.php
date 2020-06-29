<?php

namespace App\Controllers;

use App\Models\Eloquent\User;
use App\Models\Eloquent\Message;

class AdminController extends BaseController
{

    public function __construct()
    {
        if ($_SESSION['user_id'] != ADMIN) {
            throw new \Exception();
        }
    }

    public function users()
    {
        $isAdmin = ($_SESSION['user_id'] == ADMIN);

        $users = User::all();

        $displayAllUsers = [];
        foreach ($users as $user) {
            $displayAllUsers[] = [
                'id' => $user->id,
                'time' => $user->time,
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
            $this->render('login');
            exit();
        }

        $model->add($data);

        header('Location: /users');
        exit();

    }

    /**
     * если админ - можем удалять сообщения
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

    public function removeuser()
    {
        $id = (int)$_GET['id'] ?? 0;

        $user = User::find($id);

        $user->delete();
//        var_dump($user);
//        if ($user !== null) {
//            $user->delete();
//        }

        header('Location: /users');
        exit();
    }
}