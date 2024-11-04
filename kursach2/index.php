<?
session_start();
include_once ("db.php");

if(!empty($_POST['login']) && !empty($_POST['password'])){
    $login = $_POST['login'];
    $password = md5($_POST['password']);

    $result = mysqli_query($link, "SELECT * FROM users WHERE login = '$login' AND password = '$password'");
    $user = mysqli_fetch_assoc($result);

    if (!empty($user)) {
        $_SESSION['auth'] = true;
        $id = mysqli_insert_id($link);

        $_SESSION['id'] = $id;
        header("Location: regist.php");

        $_SESSION['login'] = $user['login'];
        header("Location: korzina.php");
        $_SESSION['id'] = $user['id'];
       
        $_SESSION['role_id'] = $user['role_id'];
        if($_SESSION['role_id'] == '1'){
            header("Location: admin.php");
        }
        elseif($_SESSION['role_id'] == '2'){
            header("Location: main.php");
        }
    }
         else {
       $message = "<u class='error'>Неверный логин или пароль</u>";
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
    <title>DiFleur | Вход</title>

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
                <p class="registr3">Вход</p>
                <div class="message-er"><?echo $message;?></div>
                <input type="text" name="login" placeholder="Логин">
                <input type="password" name="password" placeholder="Пароль">
                <div class="submit">
                    <button class="knoppka">Войти</button>
                </div>
                <p class="registr1">Нет аккаунта? &nbsp; <a class="registr2" href="regist.php"> Зарегистрироваться</a></p>
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