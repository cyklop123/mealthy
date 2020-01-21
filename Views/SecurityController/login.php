<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/df68b6deb8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../Public/css/style.css">

    <meta charset="UTF-8">
    <title>Logowanie</title>
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="../../Public/img/logo.svg" title="mealthy-logo"/>
        <div class="logo-name">MEALTHY</div>
    </div>
    <form method="post" action="?page=login">
        <h2>Logowanie</h2>
        <span class="message"><?=$message ?></span>
        <input type="text" name="login" placeholder="user@example.com" autocomplete="off"/>
        <input type="password" name="password" placeholder="password"/>
        <div class="links">
            <a href="?page=reminder">Przypomnienie hasła</a>
            <a href="?page=register">Rejestracja</a>
        </div>

        <div class="divider"></div>

        <button type="submit">kontynuuj</button>
        <button type="button"><i class="fab fa-facebook-f fb"></i>zaloguj przez FACEBOOKa</button>
    </form>
</div>
</body>
</html>