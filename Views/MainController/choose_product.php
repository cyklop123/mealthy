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
            Wybierz produkt
        </h3>
        <h4>Wyszukaj produkt</h4>
        <div class="user">
            <form id="choose_product" action="?page=summary" method="post">
                <div class="message" style="color:red"></div>
                <input class="search" type="text" id="product" placeholder="Wpisz nazwę produktu" autocomplete="off">
                <div class="results">
                </div>

                <input type="text" name="quantity" placeholder="Wpisz ilość zjedzonego produktu (w gramach)" autocomplete="off" style="padding-left: 4em">
                <input type="hidden" name="meal" value="<?= isset($_GET['meal']) ? trim($_GET['meal']) : '' ?>">
                <input type="hidden" name="date" value="<?= isset($_GET['date']) ? trim($_GET['date']) : '' ?>">
                <button>wybierz</button>
            </form>
            <?php
            if($_SESSION['role'] >= 2) {
                ?>
                <h4>Mojego produktu nie ma na liście</h4>
                <button onclick="$(location).attr('href','?page=add_product')">dodaj nowy produkt</button>
                <?php
            }
            ?>
        </div>
    </section>
</div>
</body>
</html>