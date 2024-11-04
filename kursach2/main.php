<?
include_once ("db.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="mainstyle.css">
    <link rel="stylesheet" media="(max-width:768px)" href="mobile.css">
    <link rel="icon" type="image" href="../photo/fivic.png">
    <title>DiFleur | Главная</title>
</head>
<body>
    
    <header id="top">
        <div class="panel">
            <h1>DiFleur</h1>
        </div>
        <div class="kor">
            <div><h2><a class="glav1" href="zakaz_user.php">Мои заказы</a></h2></div>
            <div> <h2><a class=glav1 href="logout.php">Выйти</a></h2> </div>
        </div>
    </header>

    <div class="rklm">
        <?php
            $result = mysqli_query($link, "SELECT banner FROM photo"); 
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $imagePath = "../photo/" . $row['banner']; 
                    echo "<img class='rek' src='$imagePath'>"; 
                    echo "<div class='overlay'></div>";
                    echo "<div class='button'><a href='#tovar'>К ПОКУПКАМ</a></div>";
                }
            } else {
                echo "<p>Изображения не найдены</p>"; 
            }
        ?>
    </div>

    <div class="tovar-container" id="tovar">
        <?php
        $result4 = mysqli_query($link, "SELECT * FROM product"); 

        if (mysqli_num_rows($result4) > 0) {
            while ($row = mysqli_fetch_assoc($result4)) {
                echo "<div class='tovar'>";

                echo "<div class='photo'>";
                $imagePath = "../photo/" . $row['product_img'];
                echo "<img class='tov' src='$imagePath'>";
                echo "</div>";
                
                echo "<div id='bukvi'>";
                echo "<div class='nazv'>";
                echo "<h1>$row[product_name]</h1>"; 
                echo "</div>";
                echo "<div class='opis'>";
                echo "<h3> Ноты:   </h3>";
                echo "<p>$row[upper]<br> $row[medium]<br>$row[bottom]</p>"; 
                echo "</div>";
                echo "<div class='ob'>";
                echo "<h3> Объём:  </h3>";
                echo "<p class='noti'> $row[product_volume] мл</p>"; 
                echo "</div>";
                echo "<div class='ob'>";
                echo "<h3> Цена:  </h3>";
                echo "<p class='noti'> $row[price] руб.</p>";
                echo "</div>";
                echo "</div>";
                echo "<div class='pokup'>";
                echo "<a href='korzina.php?id={$row['id']}' class='knop'>Купить</a>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>Товаров не найдено</p>"; 
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