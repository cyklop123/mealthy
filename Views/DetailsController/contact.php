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
    <?php include __DIR__.'/../Common/navbar.php'  ?>
    <section>
        <h3>
                <span class="mobile left">
                    <a href="?page=logout" style="color:#32400B"><i class="fas fa-sign-out-alt"></i></a>
                </span>
            Kontakt
        </h3>
        <div style="float:left; width: 60%">
            <h4>EMAIL</h4>
            <p>
                <h5>Administrator:</h5>
                admin@localhost
                <h5>Moderatorzy:</h5>
                janusz@tracz.pl
            </p>
            <h4>ADRES</h4>
            <p>
                MEALTHY.IO Sp. Z. O. O.<br>
                ul. Warszawska 24<br>
                00-100 Kraków<br>
                tel./fax. 12 123 45 67
            </p>
            <img alt="MAP" src="Public/img/map.png " />
        </div>
        <div class="logo" style="float:right; width:40%">
            <img src="../../Public/img/logo.svg" title="mealthy-logo"/>
            <div class="logo-name">MEALTHY</div>
        </div>
        <div style="clear: both"></div>
    </section>
</div>
</body>
</html>