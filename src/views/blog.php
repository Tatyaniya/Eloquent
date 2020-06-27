<div class="link-out">
    <a href="/logout">Выйти</a>
</div>
<div class="name">
    Вы вошли как: <?php if (!empty($this->displayName())) {
        echo $this->displayName();
    } ?>
</div>

<?php if ($is_admin) { ?>
    <div class="forms__create">
        <form method="post" action="/message/create">
            <input name="name" type="text" placeholder="Введите имя"><br>
            <input name="email" type="text" placeholder="Введите E-mail" required><br>
            <input name="password" type="password" placeholder="Введите пароль" required><br>
            <input name="password2" type="password" placeholder="Повторите пароль" required><br>
            <button type="submit">Создать</button>
        </form>
    </div>
<?php } ?>

<div class="form">
    <form enctype="multipart/form-data" method="post" action="/message/add">
        <input name="image" type="file"><br>
        <textarea rows="12" cols="55" name="text"></textarea><br>
        <button type="submit">Отправить</button>
        <br>
    </form>
</div>
<div class="messages">
    <?php if (!empty($items)) {
        foreach ($items as $message):?>

            <div class="message">

                <div class="message__data">
                    <?php if (!empty($message['name'])) { ?>
                        <span class="message__name">
                            <?php echo htmlspecialchars($message['name']); ?>
                        </span>
                    <?php } ?>
                    <?php if (!empty($message['date'])) { ?>
                        <span class="message__time">
                            <?php echo $message['date']; ?>
                        </span>
                    <?php } ?>
                </div>

                <?php if (!empty($message['image'])) { ?>
                    <div class="message__img">
                        <img src="images/<?php echo $message['image']; ?>">
                    </div>
                <?php } ?>

                <?php if (!empty($message['text'])) { ?>
                    <p class="message__text">
                        <?php echo htmlspecialchars(nl2br($message['text'])); ?>
                    </p>
                <?php } ?>

                <?php if ($is_admin) { ?>
                    <div class="message__admin">
                        <a href="/message/delete?id=<?= $message['id'] ?>">Удалить</a>
                    </div>
                <?php } ?>

            </div>

        <?php endforeach;
    } else { ?>
        Сообщений нет
    <?php } ?>

</div>

<style>
    .forms__create {
        width: 230px;
    }

    .forms__create input {
        width: 100%;
        height: 30px;
        margin-bottom: 10px;
        padding-left: 7px;
    }

    .forms__create button {
        width: 100%;
        height: 35px;
        font-weight: bold;
    }

    .form {
        padding: 40px;
    }

    .form input {
        width: 100%;
        height: 30px;
        margin-bottom: 10px;
        padding-left: 7px;
    }

    .form textarea {
        margin-bottom: 20px;
    }

    .form button {
        width: 200px;
        height: 35px;
        font-weight: bold;
    }

    .link-out {
        padding-top: 10px;
        margin-bottom: 25px;
    }

    .link-out a {
        font-family: Arial, sans-serif;
        font-weight: bold;
        color: #000;
        text-decoration: none;
        border-bottom: 1px solid transparent;
    }

    .link-out a:hover {
        border-bottom: 1px solid #000;
        transition: all 0.3s;
    }

    .name {
        font-family: sans-serif;
    }

    .message {
        width: 600px;
        font-family: sans-serif;
        border-bottom: 1px solid rgba(0, 0, 0, 0.5);
        padding-bottom: 20px;
        margin-bottom: 20px;
    }

    .message__data {
        width: 100%;
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .message__name {
        font-size: 20px;
    }

    .message__img {
        width: 200px;
        height: auto;
        margin-bottom: 20px;
    }

    .message__img img {
        display: block;
        width: 100%;
        height: auto;
    }

    .message__text {
        margin-bottom: 20px;
    }

    .message__admin a {
        font-family: sans-serif;
        text-decoration: none;
        color: #4398D0;
        border-bottom: 1px solid transparent;
    }

    .message__admin a:hover {
        border-bottom: 1px solid #4398D0;
        transition: all 0.3s;
    }
</style>