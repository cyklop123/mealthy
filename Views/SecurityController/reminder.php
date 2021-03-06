<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/df68b6deb8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../Public/css/style.css">

    <meta charset="UTF-8">
    <title>Przypomnienie hasła</title>
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="../../Public/img/logo.svg" title="mealthy-logo" />
        <div class="logo-name">MEALTHY</div>
    </div>
    <form method="post" action="?page=reminder">
        <h2>Przypomnienie hasła</h2>
        <span class="message"><?= $message ?></span>
        <input type="text" name="login" placeholder="user@example.com" autocomplete="off" />

        <div class="divider"> </div>

        <button type="submit">przypomnij</button>
        <button type="button" onclick="document.location.href='?page=login'">powrót</button>
    </form>
</div>
</body>
</html>