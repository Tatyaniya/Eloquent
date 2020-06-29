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

    public function create(array $data)
    {
        $errors = $this->valider($data);
        if (sizeof($errors) > 0) {
            header('Location: /?error=1');
            exit();
        }

        $user = new User();
        return $user->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'create_at' => date('Y-m-d H:i:s')
        ]);

        header('Location: /message');
        exit();
    }

    /**
     * если админ - можем удалять сообщения
     */
    public function delete()
    {
        $id = (int)$_GET['id'] ?? 0;

        $model = new Message();

        $message = $model->getOneMes($id);
        echo '<pre>';
        var_dump($message);
        if (!empty($message)) {
            $file = 'images/' . $message['image'];

            if (file_exists($file)) {
                unlink($file);
            }
            $model->remove($id);
        }

        header('Location: /message');
        exit();
    }
}