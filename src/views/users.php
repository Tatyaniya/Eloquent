
<div class="forms__create">
    <form method="post" action="/create/user">
        <input name="name" type="text" placeholder="Введите имя"><br>
        <input name="email" type="text" placeholder="Введите E-mail" required><br>
        <input name="password" type="password" placeholder="Введите пароль" required><br>
        <input name="password2" type="password" placeholder="Повторите пароль" required><br>
        <button type="submit">Создать</button>
    </form>
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

</style>
