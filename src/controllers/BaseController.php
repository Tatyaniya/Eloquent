<?php

namespace App\Controllers;

use App\Models\Config;


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