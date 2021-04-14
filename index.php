<?php

$errors = [];
$messages = [];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // имитация базы данных
    $users = [
        [
            'id' => 1,
            'email' => 'admin@site.com',
            'password' => 'cGFzc3dvcmQ=', // base64_encode('password')
        ],
        [
            'id' => 2,
            'email' => 'user@site.com',
            'password' => 'c2VjcmV0', // base64_encode('secret')
        ],
    ];

    // имитация проверки наличия пользователя в базе данных
    function attempt($email, $password, $users) {
        $hashedPassword = base64_encode($password);
        $result = false;
        foreach($users as $user) {
            if(($user['email'] === $email) && ($user['password'] === $hashedPassword)) {
                $result = true;
            }
        }
        return $result;
    }

    // получили значения полей, удалили пробелы
    $email = $_POST['email'] ? trim($_POST['email']) : '';
    $password = $_POST['password'] ? trim($_POST['password']) : '';

    if(empty($email) || empty($password)) {
        $errors[] = 'Поля Email и Пароль обязательны для заполнения!';
    }

    if(!attempt($email, $password, $users)) {
        $errors[] = 'Вы ввели неверный email или пароль!';
    }

    if(empty($errors)) {
        $messages[] = 'Вы успешно зашли в систему!';
    }

}

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Форма аутентификации</title>
</head>
<body>

<div class="container pt-5">

    <h1 class="mb-4 text-center">Форма аутентификации</h1>

        <div class="row mt-5">

            <div class="col-4 offset-4">

                <!-- Вывод сообщений об успехе/ошибке -->
                <?php foreach ($errors as $error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endforeach; ?>

                <?php foreach ($messages as $message): ?>
                    <div class="alert alert-success"><?php echo $message; ?></div>
                <?php endforeach; ?>

                <form action="/" method="post" class="mb-3">

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Войти</button>
                    <a href="/" class="ml-3">Сброс</a>

                </form>


                <div class="alert alert-warning mt-4">
                    Демо доступ:
                    <ul>
                        <li>Логин: <strong>admin@site.com</strong></li>
                        <li>Пароль: <strong>password</strong></li>
                    </ul>
                    <ul>
                    <li>Логин: <strong>user@site.com</strong></li>
                    <li>Пароль: <strong>secret</strong></li>
                    </ul>
                </div>
            </div>
        </div><!-- /.row -->

    </div><!-- /.container -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>
</html>
