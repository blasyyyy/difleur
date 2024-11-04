<?php
ob_start();
session_start();
if (empty($_SESSION['auth'])) {
    header("Location: login.php");
    exit;
}

include_once("db.php");

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id > 0) {
    $result4 = mysqli_query($link, "SELECT * FROM product WHERE id = $product_id");
    
    if (!$result4) {
        die('Ошибка выполнения запроса: ' . mysqli_error($link));
    }

    if ($product = mysqli_fetch_assoc($result4)) { // Исправленная проверка результата
        // Здесь можно выводить информацию о товаре
    } else {
        echo "Товар не найден.";
        exit;
    }
} else {
    echo "Неверный идентификатор товара.";
    exit;
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
    <title>DiFleur | Покупка товара</title>
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
            <div> <h2><a class=glav1 href="main.php">Главная</a></h2> </div>
            <div> <h2><a class=glav1 href="logout.php">Выйти</a></h2> </div>
        </div>
    </header>
    
    <div class="tovar-container-zakaz">
    <div class="message-er"><?echo $mess2;?></div>
        <?php if ($product): ?>

        <div class='tovar'>
            <div class='photo'>
                <img class='tov' src="../photo/<?php echo $product['product_img']; ?>" alt="<?php echo $product['product_name']; ?>">
            </div>
            <div id='bukvi'>
                <div class='nazv'>
                    <h1><?php echo $product['product_name']; ?></h1>
                </div>
                <div class='opis'>
                    <h3>Ноты:</h3>
                    <p><? echo $product['upper'] . "<br>" . $product['medium']."<br>".$product['bottom']?></p>
                </div>
                <div class='ob'>
                    <h3>Объём:</h3>
                    <p class='noti'><?php echo $product['product_volume']; ?> мл</p>
                </div>
                <div class='ob'>
                    <h3>Цена:</h3>
                    <p class='noti'><?php echo $product['price']; ?> руб.</p>
                </div>
            </div>
        </div>

        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (!empty($_POST['adress']) && !empty($_POST['fio']) && !empty($_POST['payment']) && !empty($_POST['product_id'])) {
                    $adress = mysqli_real_escape_string($link, $_POST['adress']);
                    $fio = mysqli_real_escape_string($link, $_POST['fio']);
                    $payment = mysqli_real_escape_string($link, $_POST['payment']);
                    $product_id = intval($_POST['product_id']);
                    $user_id = $_SESSION['id'];

                    $result = mysqli_query($link, "INSERT INTO orders (user_id, adress, fio, payment, product_id)
                                            VALUES ('$user_id', '$adress', '$fio', '$payment', '$product_id')");
                    if ($result) {
                        header("Location: main.php");
                        exit(); 
                    } else {
                        $mess2= "Информация не добавлена! Ошибка: " . mysqli_error($link);
                    }} else {
                        $mess1 = "<p class='error'>Заполните все поля, пожалуйста :( </p>";
                    }
                } ob_end_flush();
        ?>

        <?php else: ?>
            <p>Товар не найден.</p>
        <?php endif; ?>

        <form action="" method="POST" class="form-zakaz">
            <div class="message-er"><?echo $mess1;?></div>
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <input type="text" name="adress" placeholder="Адрес доставки">
            <input type="text" name="fio" placeholder="ФИО">

            <div class="radio-1">
                <input type="radio" id="cash" name="payment" value="Наличные" checked />
                <label for="cash">Наличные</label>

                <input type="radio" id="transfer" name="payment" value="Перевод"/>
                <label for="transfer">Перевод</label>
            </div>
            <button type="submit" class="knoppka-zakaz">Заказать</button>
        </form>
    </div>
    
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
<?php
// Закрытие соединения с базой данных
mysqli_close($link);
?>