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
        <h4>Dane personalne</h4>
        <p>
            Twoje aktualne dane personalne to: wiek - 22, wzrost - 171 cm<br>
            <form method="post" action="?page=user">
                WIEK<br>
                <input type="text" name="age"><br>
                WAGA<br>
                <input type="text" name="weight"><br>
            <button>zaktualizuj</button>
            </form>
        </p>
    </section>
</div>
</body>
</html>