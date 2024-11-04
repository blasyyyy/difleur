<?
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
    <title>DiFleur | Администратор</title>
</head>
<style>
    .status1{
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: flex-start;
    }
    #errorcard1{
        padding-left: 2%;
        color: red;
    }

    #successcard{
        padding-left: 2%;
        color: #00cc00;
    }

    #newcard{
        padding-left: 2%;
        color: blue;
    }
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
    <header id="top">

        <div class="panel">
            <h1>DiFleur</h1>
        </div>
    
        <div class="kor2">
        <div> <h2><a class=glav1 href="logout.php">Выйти</a></h2> </div>
        </div>

    </header>

    <div class="container">

        <div class="zag">
            <h3><u>Все товары:</u></h3>
            <button type="submit" class="knop1"><a href="" class="update">Добавить товар</a></button>
        </div>
        
        <div class="tovar-container">
            <div class="tovar">
                <img class="photo-admin" src="../photo/eros1.png">
                <h4 class="h4">VERSACE - Eros</h4>
                <button type="submit" class="knop"><a href="" class="update">Изменить</a></button>

            </div>

            <div class="tovar">
                <img class="photo-admin" src="../photo/killian1.png">
                <h4 class="h4">KILIAN - Don't Be Shy </h4>
                <button type="submit" class="knop"><a href="" class="update">Изменить</a></button>
            </div>

            <div class="tovar">
                <img class="photo-admin" src="../photo/tomford1.png">
                <h4 class="h4">TOM FORD - White Suede</h4>
                <button type="submit" class="knop"><a href="" class="update">Изменить</a></button>
            </div>
        </div>

        <?php
        $count_result = mysqli_query($link, "SELECT COUNT(*) as total_orders FROM orders");

        if (!$count_result) {
            echo "Ошибка выполнения запроса: " . mysqli_error($link);
        } else {
        $count_row = mysqli_fetch_assoc($count_result);
        $total_orders = $count_row['total_orders'];}
        ?>
        
        <div class="zag">
            <h3><u>Все заказы:</u> <?echo $total_orders;?></h3>
            <div class="message-er"><?echo $mess7;?></div>
            <button type="submit" class="knop1"><a href="update.php" class="update">Изменить статус</a></button>
        </div>
        <div class="tovar-container">
            <?
            include_once("db.php");
            $result = mysqli_query($link, "SELECT orders.id AS order_id, product.product_name, orders.fio, orders.adress, orders.payment, orders.status FROM orders
                                    LEFT JOIN product ON orders.product_id = product.id");

            while($row = mysqli_fetch_assoc($result)){
                if ($row['status'] === 'Новое'){
                    echo "<div class='tovar'>
                        <div id='bukvi'>
                            <div class='opis'>
                                <p><b>Номер заказа:</b> $row[order_id]</p>
                                <p><b>Название:</b> $row[product_name]</p>
                                <p><b>ФИО:</b> $row[fio]</p>
                                <p><b>Адрес:</b> $row[adress]</p>
                                <p><b>Оплата:</b> $row[payment]</p>
                                <p class='status1'><b>Статус:</b> <u id='newcard'>$row[status]</u></p>
                            </div>
                        </div>
                    </div>";
                } else if ($row["status"] === "Подтверждено"){
                    echo "<div class='tovar'>
                        <div id='bukvi'>
                            <div class='opis'>
                                <p><b>Номер заказа:</b> $row[order_id]</p>
                                <p><b>Название:</b> $row[product_name]</p>
                                <p><b>ФИО:</b> $row[fio]</p>
                                <p><b>Адрес:</b> $row[adress]</p>
                                <p><b>Оплата:</b> $row[payment]</p>
                                <p class='status1'><b>Статус:</b> <u id='successcard'>$row[status]</u></p>
                            </div>
                        </div>
                    </div>";
            } else {
                echo "<div class='tovar'>
                        <div id='bukvi'>
                            <div class='opis'>
                                <p><b>Номер заказа:</b> $row[order_id]</p>
                                <p><b>Название:</b> $row[product_name]</p>
                                <p><b>ФИО:</b> $row[fio]</p>
                                <p><b>Адрес:</b> $row[adress]</p>
                                <p><b>Оплата:</b> $row[payment]</p>
                                <p class='status1'><b>Статус:</b> <u id='errorcard1'>$row[status]</u></p>
                            </div>
                        </div>
                    </div>";
                } 
            }
            ?>
        </div>
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