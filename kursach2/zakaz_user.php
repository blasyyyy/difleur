<?
include_once("db.php");
session_start();
if(empty($_SESSION['auth'])){
    header("Location: index.php");
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
    <title>DiFleur | Мои заказы</title>
</head>
<style>
    .error{
        margin: 15%;
        font-family: 'Bookman old style';
        color:#697644;
        font-size: 2em;
    }
</style>
<body>
    <header id="top">
        <div class="panel">
            <h1>DiFleur</h1>
        </div>
        <div class="kor1">
            <div><h2><a class="glav1" href="main.php">Главная</a></h2></div>
            <div> <h2><a class=glav1 href="logout.php">Выйти</a></h2> </div>
        </div>
    </header>

    <?php
        $count_result = mysqli_query($link, "SELECT COUNT(*) as total_orders FROM orders WHERE user_id = '$_SESSION[id]'");

        if (!$count_result) {
            echo "Ошибка выполнения запроса: " . mysqli_error($link);
        } else {
        $count_row = mysqli_fetch_assoc($count_result);
        $total_orders = $count_row['total_orders'];}
    ?>

    <div class="zak">
       <h5>Мои заказы: <?echo $total_orders;?>  </h5> 
       <p class="p">Ваш логин: <? echo $_SESSION['login']; ?></p>
    </div>
    
    <div class="tovar-container">
        <?php
            $result = mysqli_query($link, "SELECT product.product_name, orders.fio, orders.adress, orders.payment, orders.status FROM orders 
                                                        LEFT JOIN product ON orders.product_id = product.id WHERE user_id = '$_SESSION[id]'");

            if (!$result) {
                echo "Ошибка выполнения запроса: " . mysqli_error($link);
            }elseif (mysqli_num_rows($result) === 0) {
                echo "<p class='error'>У вас еще нет заказов! Закажите :)</p>";
            } else {

            while($row = mysqli_fetch_assoc($result)){
                echo "<div class='tovar'>
                    <div id='bukvi'>
                        <div class='opis1'>
                            <p><b>Название:</b> $row[product_name]</p>
                            <p><b>ФИО:</b> $row[fio]</p>
                            <p><b>Адрес:</b> $row[adress]</p>
                            <p><b>Оплата:</b> $row[payment]</p>
                            <p class='status1'><b>Статус: </b>$row[status]</p>
                        </div>
                    </div>
                </div>";
            }
        }
        ?>
    </div>
    
    <footer>
        <div class="infa">
            <h2>8 (000) 000 - 00 - 00</h2>
            <a href="#top" class="top">	&uarr; Наверх</a>
            <h2>difleur@mail.ru</h2>
        </div>
    </footer>
</body>
</html>