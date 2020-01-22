<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/df68b6deb8.js" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="../../Public/css/style.css">
    <link rel="stylesheet" href="../../Public/css/main.css">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="Public/js/app.js"></script>
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>

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
            <input type="date" id="datepick" value="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d') ?>">
            <div class=".message" style="padding:0.5em; font-weight: bold"><?= $message ?></div>
            <div id="summary">
            <?php
            $cal=0;
            $prot=0;
            $fat=0;
            $carb=0;
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
                            $cal += $product->getCallories();
                            $prot += $product->getProteins();
                            $fat += $product->getFats();
                            $carb += $product->getCarbs();
                            ?>
                            <tr>
                                <td>
                                    <i class="fas fa-trash" title="Usuń" value="<?= $product->getId() ?>"></i>
                                    <?= $product->getName() ?>
                                </td>
                                <td><?= $product->getCallories() ?> kcal</td>
                                <td><?= $product->getProteins() ?> g</td>
                                <td><?= $product->getFats() ?> g</td>
                                <td><?= $product->getCarbs() ?> g</td>
                            </tr>
                            <?php
                        }
                        if(empty($meal['products']))
                            echo "<td>Brak danych</td>";
                        ?>
                        </tbody>
                    </table>
                    <button name="choose_product" value="<?= $meal_id ?>">wybierz produkt</button>
                </div>
                <hr>
                <?php
            }
            ?>
            <div class="meal">
                <table>
                    <thead>
                    <tr>
                        <th>Podsumowanie</th>
                        <th>kalorie</th>
                        <th>białka</th>
                        <th>tłuszcze</th>
                        <th>węglowodany</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td></td>
                        <td><?= $cal ?> kcal</td>
                        <td><?= $prot ?> g</td>
                        <td><?= $fat ?> g</td>
                        <td><?= $carb ?> g</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            </div>
        </section>
    </div>
</body>
</html>