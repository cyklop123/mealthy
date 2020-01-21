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
            <h3>
                <span class="mobile left">
                    <a href="?page=logout" style="color:#32400B"><i class="fas fa-sign-out-alt"></i></a>
                </span>
                Podsumowanie
            </h3>

            <?php
            foreach ($eats as $meal_id=>$meal) {
                ?>

                <div class="meal">

                    <table>
                        <thead>
                        <tr>
                            <th><?= $meal['name'] ?></th>
                            <th>kaloryczność</th>
                            <th>białka</th>
                            <th>tłuszcze</th>
                            <th>węglowodany</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($meal['products'] as $product) {
                            ?>
                            <tr>
                                <td><?= $product->getName() ?></td>
                                <td><?= $product->getCallories() ?> kcal</td>
                                <td><?= $product->getProteins() ?> g</td>
                                <td><?= $product->getFats() ?> g</td>
                                <td><?= $product->getCarbs() ?> g</td>
                            </tr>
                            <?php
                        }
                        if(empty($product))
                            echo "<td>Brak danych</td>";
                        ?>
                        </tbody>
                    </table>
                    <button name="<?= $meal_id ?>">wybierz produkt</button>
                </div>
                <?php
            }
            ?>

        </section>
    </div>
</body>
</html>