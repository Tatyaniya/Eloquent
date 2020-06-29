
<div class="link-out">
    <a href="/logout">Выйти</a>
</div>
<div class="link-out">
    <a href="/message">Перейти к сообщениям</a>
</div>
<div class="name">
    Вы вошли как: <?php if (!empty($this->displayName())) {
        echo $this->displayName();
    } ?>
</div>

<div class="forms__create">
    <form method="post" action="/create/user">
        <input name="name" type="text" placeholder="Введите имя"><br>
        <input name="email" type="text" placeholder="Введите E-mail" required><br>
        <input name="password" type="password" placeholder="Введите пароль" required><br>
        <input name="password2" type="password" placeholder="Повторите пароль" required><br>
        <button type="submit">Создать</button>
    </form>
</div>

<div class="users">
    <?php if (!empty($items)) {
        foreach ($items as $user): ?>

            <div class="user">

                <div class="user__data">
                    <?php if (!empty($user['name'])) { ?>
                        <span class="user__name">
                            <?php echo htmlspecialchars($user['name']); ?>
                        </span>
                    <?php } ?>
                    <?php if (!empty($user['time'])) { ?>
                        <span class="user__time">
                            <?php echo $user['time']; ?>
                        </span>
                    <?php } ?>
                </div>

                <?php if (!empty($user['email'])) { ?>
                    <div class="user__email">
                        <?php echo $user['email']; ?>
                    </div>
                <?php } ?>

                <?php if (!empty($user['password'])) { ?>
                    <p class="user__pass">
                        <?php echo $user['password']; ?>
                    </p>
                <?php } ?>

                <?php if ($is_admin) { ?>
                    <div class="user__admin">
                        <a href="/user/delete?id=<?= $user['id']; ?>">Удалить</a>
                    </div>
                <?php } ?>

            </div>

        <?php endforeach;
    } else { ?>
        Пользователей нет
    <?php } ?>

</div>

<style>
    .name {
        font-family: sans-serif;
        margin-bottom: 30px;
    }
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

    .user {
        width: 600px;
        font-family: sans-serif;
        border-bottom: 1px solid rgba(0, 0, 0, 0.5);
        padding-bottom: 20px;
        margin-bottom: 20px;
    }

    .user {
        margin-bottom: 40px;
    }

    .user__data {
        width: 100%;
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .user__name {
        font-size: 20px;
    }

    .user__email {
        margin-bottom: 20px;
    }

    .user__pass {
        margin-bottom: 20px;
    }

    .user__admin a {
        font-family: sans-serif;
        text-decoration: none;
        color: #4398D0;
        border-bottom: 1px solid transparent;
    }

    .user__admin a:hover {
        border-bottom: 1px solid #4398D0;
        transition: all 0.3s;
    }

</style>
