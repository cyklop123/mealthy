<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/df68b6deb8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../Public/css/style.css">
    <link rel="stylesheet" href="../../Public/css/main.css">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="Public/js/app.js"></script>

    <meta charset="UTF-8">
    <title>Podsumowanie</title>
</head>
<body>
<div class="container">
    <?php include __DIR__.'/../Common/navbar.php' ?>
    <section>
        <h3>
                <span class="mobile left">
                    <a href="?page=logout" style="color:#32400B"><i class="fas fa-sign-out-alt"></i></a>
                </span>
            Dodaj produkt
        </h3>
        <div class="user">
            <form id="add_product" action="?page=add_product" method="post">
                <div class="message" style="color:red"><?= $message ?></div>

                <h4>Nazwa produktu</h4>
                <input type="text" name="poduct_name" placeholder="Podaj nazwę produktu" autocomplete="off">
                <h4>Watości odżywcze w 100 gramach</h4>
                <p style="padding-left:2em">
                    Kaloryczność<br>
                    <input type="text" name="callories" placeholder="Podaj kaloryczność (w kilokaloriach)" autocomplete="off"><br>
                    Białka<br>
                    <input type="text" name="proteins" placeholder="Podaj ilość białka (w gramach)" autocomplete="off"><br>
                    Tłuszcze<br>
                    <input type="text" name="fats" placeholder="Podaj ilość tłuszczy (w gramach)" autocomplete="off"><br>
                    Węglowodany<br>
                    <input type="text" name="carbs" placeholder="Podaj ilość węglowodanów (w gramach)" autocomplete="off">
                </p>
                    <button>wybierz</button>
            </form>
        </div>
    </section>
</div>
</body>
</html>