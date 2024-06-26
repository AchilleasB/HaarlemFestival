<?php

if (isset($_SESSION['user_firstname'])) {
    $username = $_SESSION['user_firstname'];
}
?>

<!-- navbar -->
<nav class="navbar navbar-expand-lg bg-white">
    <div class="container-fluid">
        <img src="/../icons/haarlem-logo.svg" class="header-logo" alt="Visit Haarlem icon" id="logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="nav-pages ms-auto">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/festival">
                            <img src="/../icons/human.svg" class="human-icon w-10 h-10" alt="Human icon">
                            Festival</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/history">
                            <img src="/../icons/history.svg" class="history-icon w-10 h-10" alt="History icon">
                            History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/yummy">
                            <img src="/../icons/cutlery.svg" class="cutlery-icon w-10 h-10" alt="Cutlery icon">
                            Cuisines</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/dance">
                            <img src="/../icons/music.svg" class="music-icon w-10 h-10" alt="Music icon">
                            Dance</a>
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
                        <?php if ($_SESSION['user_role'] == 'Admin') { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/cms"><i class="fa-solid fa-clipboard"></i> CMS</a>
                            </li>
                        <?php } ?>
                        <?php if ($_SESSION['user_role'] == 'Employee') { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/qrCodeChecker"><i class="fa-solid fa-clipboard"></i> QR code
                                    checker</a>
                            </li>

                        <?php } ?>
                        <li class="nav-item">
                                <a class="nav-link" href="/personalProgram">
                                    <img src="/../icons/favorite.svg" class="sw-10 h-10 px-2"
                                        alt="Favorite icon">Favorite
                        </a>
                        </li>
                        <?php }?>

                        <li class="nav-item">
                                <a class="nav-link" href="/shoppingCart">
                                    <img src="/../icons/shopping-cart.svg" class="shopping-cart-icon w-10 h-10"
                                        alt="Shopping cart icon">
                                    Shopping cart
                                    <?php if (!isset($_SESSION['order_items_data'])) { 
                                        $_SESSION['order_items_data'] = []; } 
                                    ?>
                                </a>
                            </li>
                            
                            <?php if (isset($username)) { ?>

                        <li class="nav-item">
                            <a class="nav-link" href="/login/logout"><i class="fa-solid fa-right-from-bracket"></i> Log
                                out</a>
                        </li>
                        <?php }?>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div class="red-line"></div>
<!-- end of navbar -->