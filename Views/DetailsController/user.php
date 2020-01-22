<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/df68b6deb8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../Public/css/style.css">
    <link rel="stylesheet" href="../../Public/css/main.css">

    <meta charset="UTF-8">
    <title>Podsumowanie</title>
</head>
<body>
<div class="container">
    <?php include __DIR__.'/../Common/navbar.php' ?>
    <section>
        <h3>Panel użytkownika</h3>
        <h4>Dane użytkownika</h4>
        <p>
            Typ użytkownika: <?= $role?>
        </p>
        <h4>Dane personalne</h4>
        <p>
            Twoje aktualne dane personalne to: wiek - <?= $age ?>, wzrost - <?= $size ?> cm,  waga - <?= $weight ?> kg, a twoje bmi wynosi <?= $bmi ?>.
        </p>
        <div class="message"><?= $message ?></div>
        <div class="user" action="?page=user">
            <form method="post" action="?page=user">
                WIEK<br>
                <input type="text" name="age" value="<?= $age ?>"><br>
                WZROST<br>
                <input type="text" name="size" value="<?= $size ?>"><br>
                WAGA<br>
                <input type="text" name="weight" value="<?= $weight ?>"><br>
                PŁEĆ
                <div>
                <input <?= !$male ? 'checked': '' ?> type="radio" name="male" value="0" id="kobieta" style="width: unset; height: unset"> <label for="kobieta" style="display: inline">Kobieta</label><br>
                <input <?= $male ? 'checked': '' ?> type="radio" name="male" value="1" id="mezczyzna" style="width: unset; height: unset"> <label for="mezczyzna">Mężczyzna</label>
                </div>
            <button>zaktualizuj</button>
            </form>
        </div>
    </section>
</div>
</body>
</html>