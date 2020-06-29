<?php

namespace App\Controllers;

use App\Models\Config;
use App\Models\Eloquent\User;


class BaseController
{
    /**
     * валидация
     * @param $data
     * @return array
     */
    public function valider($data)
    {
        $errors = [];
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Некорректный email";
        }
        if (mb_strlen($data['password']) < 4) {
            $errors[] = "Длина пароля должна быть не менее 4-х символов";
        }
        if ($data['password'] !== $data['password2']) {
            $errors[] = "Пароли не совпадают";
        }
        return $errors;
    }


    /**
     * выводим имя пользователя над формой
     * @return mixed
     */
    public function displayName()
    {
        $user = new User();
        return $user->getId($_SESSION['user_id'])->name;
    }

    /**
     * отображение шаблона
     * @param $template
     * @param array $data
     */
    protected function render($template, $data = [])
    {
        if ($data != []) {
            extract($data);
        }

        include __DIR__ . '/../views/' . $template . '.php';
    }
}