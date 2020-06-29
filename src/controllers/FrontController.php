<?php

namespace App\Controllers;

use App\Models\Eloquent\User;
use App\Models\Eloquent\Message;

class FrontController extends BaseController
{
    /**
     * отображение форм
     */
    public function index()
    {
        if (isset($_SESSION['user_id'])) {
            header('Location: /message');
            exit;
        }
        $this->render('login');
    }

    /**
     * регистрация
     *
     * @param array $data
     */
    public function register(array $data)
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

        $user = $model->get($data['email']);

        $_SESSION['user_id'] = $user->id;
        header('Location: /message');

        exit;
    }

    /**
     * авторизация пользователя
     *
     * @param array $data
     */
    public function login(array $data)
    {
        $model = new User();

        $password = $model->getPasswordHash($data['password']);
        $user = $model->get($data['email']);

        if ($user->email != $data['email'] || $password != $user->password) {
            echo 'Неверный логин или пароль';
            $this->render('login');
            exit();
        }

        $_SESSION['user_id'] = $user->id;
        header('Location: /message');

        exit();
    }

    /**
     * отображает сообщения
     */
    public function view()
    {
        $isAdmin = ($_SESSION['user_id'] == ADMIN);

        $info = $this->getAllMessages();

        $this->render('blog', [
            'items' => $info,
            'is_admin' => $isAdmin
        ]);
    }

    /**
     * получаем все сообщения из базы вместе с именами пользователей
     *
     * @return array
     */
    public function getAllMessages()
    {
        $messages = Message::with('author')->orderBy('id', 'desc')->get();

        $AllDisplayMessages = [];
        foreach ($messages as $mes) {
            $AllDisplayMessages[] = [
                'id' => $mes->id,
                'name' => $mes->author->getName(),
                'date' => $mes->date,
                'image' => $mes->image,
                'text' => $mes->text
            ];
        }

        return $AllDisplayMessages;
    }

    /**
     * берем картинку из формы
     * @return mixed
     */
    public function addImage()
    {
        if (!empty($_FILES['image']['tmp_name'])) {
            return $_FILES['image']['tmp_name'];
        }
    }

    /**
     * если картинка добавлена, создаем ей имя и кладем ее в папку
     *
     * @return mixed
     */
    public function imageName(){
        if ($this->addImage()) {
            $img = $this->addImage();
            $message = new Message();
            $message->loadImage($img);
            return $message->getImage();
        }
    }

    /**
     * добавляем сообщения
     *
     * @param array $data
     */
    public function add(array $data)
    {
        if (!$data['text']) {
            echo 'Сообщение не может быть пустым';
            $this->view();
            exit();
        }

        $message = new Message([
            'user_id' => $_SESSION['user_id'],
            'text' => $data['text'],
            'image' => $this->imageName(),
            'date' => date('Y-m-d H:i:s')
        ]);
        $message->save();

        header('Location: /message');
        exit();
    }

    /**
     * разлогиниваемся
     */
    public function logout()
    {
        $_SESSION['user_id'] = null;
        header('Location: /');
        exit();
    }

    /**
     * возвращает 20 последних сообщений 1 пользователя в json
     *
     * @return string
     */
    public function api()
    {
        $id = (int)$_GET['id'] ?? 0;

        if (!$id) {
            echo 'такого пользователя нет';
            exit();
        } else {

        }

        $data = User::with('messages')->where('id', '=', $id)->limit(20)->get();
        $messages = $data->toArray();

        $usermes = $messages[0];
        if ($usermes['messages']) {

            $lastMessages = [];

            for ($i=0; $i< sizeof($usermes); $i++) {
                $lastMessages[] = [
                    'date' => $usermes['messages'][$i]['date'],
                    'image' => $usermes['messages'][$i]['image'],
                    'text' => $usermes['messages'][$i]['text']
                ];
            }
        } else {
            echo 'Сообщений нет';
        }

        echo json_encode($lastMessages);
        //echo json_encode($messages[0]['messages']);
    }
}