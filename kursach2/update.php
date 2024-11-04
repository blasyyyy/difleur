<?
ob_start();
include_once("db.php");
session_start();
if(empty($_SESSION['auth'])){
    header("Location: login.php");
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
    <title>DiFleur | Смена статуса</title>
</head>
<style>
    .error{
    color: red;
    font-family: 'Bookman old style';
    font-size: 1.2em;
    font-style: italic;
    transition: opacity 0.5s ease;
    opacity: 1; 
    }
    .fade-out {
    opacity: 0;
    }
</style>
<body>
    
    <header>
        <div class="panel">
            <h1>DiFleur</h1>
        </div>
        <div class="kor1">
            <div> <h2><a class=glav1 href="admin.php">Кабинет</a></h2></div>
            <div> <h2><a class=glav1 href="logout.php">Выйти</a></h2> </div>
        </div>
    </header>

    <main class="main-regist-vxod"> 
        <div class="forma">
            <form action="" method="POST" class="avtor">
                <p class="registr">Сменить статус заказа</p>
                <input type="text" name="id" placeholder="Номер заказа">
                <select name="status">
                    <option value="подтверждено">Подтверждено</option>
                    <option value="отклонено">Отклонено</option>
                </select>
                <div class="submit">
                    <button class="knoppka">Изменить</button>
                </div>
            </form>
        </div>
    </main>

    <?php
    if(!empty($_POST["id"]) && !empty($_POST["status"])){
        $status = $_POST["status"];
        $id= $_POST["id"];
        $result = mysqli_query($link, "UPDATE orders SET status = '$status'
        WHERE id = '$id'");
        if($result == 'true'){
            header("Location: admin.php");
        } else{
            $mess7 = "<p class='error'>Статус не изменен :(</p>";;
        }
    }
    ob_end_flush();
    ?>

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