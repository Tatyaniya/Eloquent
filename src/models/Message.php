<?php

namespace App\Models;

use PDO;

class Message
{
    protected $id;
    protected $image;
    protected $text;
    protected $date;

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * добавляем сообщение в базу
     * @param $userId
     * @param array $data
     */
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
     * получаем все сообщения из базы
     * @return array
     */
    public function getMessages()
    {
        $pdo = new DB();

        $messages = "SELECT * FROM messages";

        $result = $pdo->connect()->prepare($messages);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * получаем всех пользователей из базы
     * @return array
     */
    public function getUsers()
    {
        $pdo = new DB();

        $users = "SELECT * FROM users";

        $result = $pdo->connect()->prepare($users);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * выводим 20 последних сообщений 1 пользователя
     * @param $userId
     * @param int $limit
     * @return mixed
     */
    public function getUserMes($userId, $limit = 20)
    {
        $pdo = new DB();

        $sql = "SELECT * FROM messages LEFT JOIN users ON messages.user_id = users.id WHERE user_id = :user_id ORDER BY messages.id DESC LIMIT $limit";

        $result = $pdo->connect()->prepare($sql);
        $result->execute([
            'user_id' => $userId
        ]);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * проверяем, есть ли сообщение в базе
     * @param $id
     * @return mixed
     */
    public function getOneMes($id)
    {
        $pdo = new DB();

        $sql = "SELECT * FROM messages WHERE id = :id";

        $result = $pdo->connect()->prepare($sql);
        $result->execute([
            'id' => $id
        ]);

        return $result->fetch(PDO::FETCH_ASSOC);
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

    /**
     * генерируем случайное имя картинке
     * @return string
     */
    public function getImageName()
    {
        return sha1(microtime(1) . mt_rand(1, 100000000)) . '.jpg';
    }

    /**
     * удалить сообщение из базы
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $pdo = new DB();
        $sql = "DELETE FROM messages WHERE id = :id";

        $result = $pdo->connect()->prepare($sql);
        $result->execute([
            'id' => $id
        ]);

        return $result->fetch(PDO::FETCH_ASSOC);
    }
}