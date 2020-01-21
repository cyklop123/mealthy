<?php
if(isset($_SESSION['id'])) {
    ?>
    <nav>
        <a href="?page=summary">MHY</a>

        <div class="navbar">
            <ul>
                <li>
                    <a href="?page=summary">podsumowanie</a>
                </li>
                <li>
                    <a href="?page=add_product">dodawanie produktu</a>
                </li>
                <li>
                    <a href="?page=admin">panel administratora</a>
                </li>
                <li>
                    <a href="?page=contact">kontakt</a>
                </li>
                <li>
                    <a href="?page=logout">wyloguj</a>
                </li>
            </ul>
        </div>

        <div class="navbar-icons">
            <a href="http://facebook.com/"><i class="fab fa-facebook-f"></i></a>
            <a href="?page=user"><i class="fas fa-user"></i></a>
        </div>

    </nav>
    <?php
}
?>