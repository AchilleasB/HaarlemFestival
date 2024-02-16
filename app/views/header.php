<?php

if (isset($_SESSION['user_firstname'])) {
    $username = $_SESSION['user_firstname'];
}

?>

<!-- navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <img src="/../icons/haarlem-logo.svg" class="header-logo" alt="Visit Haarlem icon" id="logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="nav-pages ms-auto">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">
                            <img src="/../icons/home.svg" class="home-icon w-10 h-10" alt="Home icon">
                            Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">
                            <img src="/../icons/history.svg" class="history-icon w-10 h-10" alt="History icon">
                            History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">
                            <img src="/../icons/cutlery.svg" class="cutlery-icon w-10 h-10" alt="Cutlery icon">
                            Cuisines</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">
                            <img src="/../icons/music.svg" class="music-icon w-10 h-10" alt="Music icon">
                            Music</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/festival">
                            <img src="/../icons/human.svg" class="human-icon w-10 h-10" alt="Human icon">
                            Festival</a>
                    </li>
                </ul>
            </div>
            <div class="nav-user ms-auto">
                <ul class="navbar-nav">
                    <?php if (!isset($username)) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/login"><i class="fa-solid fa-right-to-bracket"></i> Log in</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/registration"><i class="fa-solid fa-user-plus"></i> Register</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item ">
                            <a class="nav-link" href="/profile"><i class="fa-solid fa-user"></i>
                                <?= $username ?>
                            </a>
                        </li>
                        <?php if ($_SESSION['user_role'] == 'admin') { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/cms"><i class="fa-solid fa-clipboard"></i> CMS</a>
                            </li>
                        <?php } ?>
                        <?php if ($_SESSION['user_role'] == 'employee') { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/qrCodeChecker"><i class="fa-solid fa-clipboard"></i> QR code
                                    checker</a>
                            </li>
                        <?php } ?>
                        <?php if ($_SESSION['user_role'] == 'customer') { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/shoppingCart">
                                    <img src="/../icons/shopping-cart.svg" class="shopping-cart-icon w-10 h-10"
                                        alt="Shopping cart icon">
                                    Shopping cart</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/login/logout"><i class="fa-solid fa-right-from-bracket"></i> Log
                                out</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</nav>