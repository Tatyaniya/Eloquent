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
 <?php echo '<pre>';
// use App\Models\Eloquent\User as User;
//use Illuminate\Database\Capsule\Manager as Capsule;
//
//$capsule = new Capsule;
//
//$capsule->addConnection([
//'driver'    => 'mysql',
//'host'      => DB_HOST,
//'database'  => DB_NAME,
//'username'  => DB_USER,
//'password'  => DB_PASSWORD,
//'charset'   => 'utf8',
//'collation' => 'utf8_unicode_ci',
//'prefix'    => '',
//]);
//
//$capsule->setAsGlobal();
//
//$capsule->bootEloquent();
//
//// $users = User::all();
//// foreach($users as $user) {
////     echo $user->name . '<br>';
//// }
//
// $user = new User();
// $us = $user->get('tatyana@gmail.com');
// $id = $user->get('tatyana@gmail.com');
// var_dump($id->password);
//
// function getPasswordHash($password)
// {
//     return $passwordHash = sha1($password . '.sdfifao38vj,');
// }
//
// $ps = getPasswordHash(55555);
// //var_dump($ps);
//
//
//
// $password = $user->getPasswordHash(55555);
// $email = $user->get('tatyana@gmail.com')->id;
//
//         //var_dump($password);
//         var_dump($email);
//
// function get($email)
// {
//     return User::where('email', '=', $email)->first();
// }
//
// ;















