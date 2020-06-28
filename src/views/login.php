<div class="forms">
    <div class="forms__enter">
        <form method="post" action="/login">
            <input name="email" type="text" placeholder="Введите E-mail" required><br>
            <input name="password" type="password" placeholder="Введите пароль" required><br>
            <button type="submit">Войти</button>
        </form>
    </div>

    <div class="forms__register">
        <form method="post" action="/register">
            <input name="name" type="text" placeholder="Введите имя"><br>
            <input name="email" type="text" placeholder="Введите E-mail" required><br>
            <input name="password" type="password" placeholder="Введите пароль" required><br>
            <input name="password2" type="password" placeholder="Повторите пароль" required><br>
            <button type="submit">Зарегистрироваться</button>
        </form>
    </div>
</div>


<style>
    .forms {
        display: flex;
        padding: 40px;
    }

    .forms__enter,
    .forms__register {
        width: 230px;
    }

    .forms__enter {
        margin-right: 100px;
    }

    .forms input {
        width: 100%;
        height: 30px;
        margin-bottom: 10px;
        padding-left: 7px;
    }

    .forms button {
        width: 100%;
        height: 35px;
        font-weight: bold;
    }
</style>
















