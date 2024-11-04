<?
    session_start();
    include_once("db.php");

    if(empty($_POST['login']) ||  empty ($_POST['password']) || empty($_POST['phone'])){
        $mess = "<p class='error1'>Заполните все поля!</p>";
    }
     else {
        $login = trim($_POST['login']);
        $password = trim(md5($_POST['password']));
        $phone = trim($_POST['phone']);


        $result1 = mysqli_query($link, "SELECT * FROM users WHERE login = '$login'");
        $user = mysqli_fetch_assoc($result1);
        

        if(empty($user)){

            $result = mysqli_query($link, "INSERT INTO users SET login = '$login', password = '$password', phone = '$phone'");

            $_SESSION['auth'] = true;

            $id = mysqli_insert_id($link);
            $_SESSION['id'] = $id;
            header("Location: main.php");

        } else {
            $mess1 = "<p class='error'>Логин уже занят!</p>";
        }

    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="mainstyle.css">
    <link rel="stylesheet" media="(max-width:768px)" href="mobile.css">
    <link rel="icon" type="image" href="../photo/fivic.png">
    <title>DiFleur | Регистрация</title>

</head>
<body>
    <header>
        <div class="panel">
            <h1>DiFleur</h1>
        </div>
    </header>

    <main class="main-regist-vxod"> 
        <div class="forma">
            <form action="" method="POST" class="avtor">
                <p class="registr3">Регистрация</p>
                <div class="message-er"><?echo $mess1;?></div>
                <div class="message-er"><?echo $mess;?></div>
                <input type="text" name="phone" placeholder="Номер телефона">
                <input type="text" name="login" placeholder="Логин">
                <input type="password" name="password" placeholder="Пароль" size="30" minlength="6">
                <div class="submit">
                <button class="knoppka">Зарегистрироваться</button>
                </div>
                <p class="registr1">Уже зарегистрированы? &nbsp; <a class="registr2" href="index.php"> Войти</a></p>
            </form>
        </div>
    </main>

    <footer>
        <div class="infa">
            <h2>8 (000) 000 - 00 - 00</h2>
            <h2>difleur@mail.ru</h2>
        </div>
    </footer>
    
    <script>
    const errorElement = document.querySelector('.error');
    if (errorElement) {
        setTimeout(function() {
            errorElement.classList.add('fade-out');
            setTimeout(function() {
                errorElement.remove();
            }, 500);
        }, 2000);
    }
    </script>
</body>
</html>