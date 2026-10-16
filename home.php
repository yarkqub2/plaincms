<?php require_once('include.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style1.css">
    <style>
        .logo {
            width: 197px;
            height: 73px;
            display: block;
            margin-bottom: -12px;
        }

        .logo_text {
            color: yellow;
            font-size: 73px;
            font-weight: bolder;
        }
    </style>
</head>

<body>
    <div class="content">
        <habbo-header-small>
            <header class="header__wrapper wrapper">
                <a href="/" class="logo">
                    <h1 class="logo_text"><?= $HOTEL_NAME ?></h1>
                </a>
                <habbo-user-menu class="header__aside header__aside--user-menu">
                    <div class="user-menu">
                        <div class="user-menu__header">
                            <a class="user-menu__toggle" onclick="toggleClass('#target1', 'ng-hide')">
                                <div class="user-menu__name__wrapper">
                                    <div class="user-menu__name"><?= $_SESSION["user"]["username"] ?></div>
                                </div>
                                <habbo-imager class="user-menu__avatar">
                                    <img src="https://www.portalhabbo.com/imager/render-figure?direction=2&head_direction=2&gesture=nrm&size=m&figure=<?= $_SESSION["user"]["look"] ?>&gender=M&head_only=1" style="min-width: 54px;">
                                </habbo-imager>
                            </a>
                        </div>
                        <ul id="target1" class="user-menu__list ng-hide">
                            <li class="user-menu__item">Profile</li>
                            <li class="user-menu__item"><a href="logout.php" class="user-menu__link user-menu__link--logout">Logout</a></li>
                        </ul>
                    </div>
                </habbo-user-menu>
            </header>
            <habbo-navigation>
                <nav class="navigation">
                    <ul class="navigation__menu">
                        <li class="navigation__item">
                            <a class="navigation__link navigation__link--home navigation__link--active">Home</a>
                        </li>
                        <li class="navigation__item">
                            <a class="navigation__link navigation__link--community">Community</a>
                        </li>
                        <li class="navigation__item">
                            <a class="navigation__link navigation__link--shop">Shop</a>
                        </li>
                        <li class="navigation__item navigation__item--hotel">
                            <habbo-hotel-native-button>
                                <a href="client.php" class="hotel-button-native">
                                    <span class="hotel-button-native__text hotel-button-native__text--play">Play</span>
                                </a>
                            </habbo-hotel-native-button>
                        </li>
                    </ul>
                </nav>
            </habbo-navigation>

        </habbo-header-small>
    </div>


    <?php
    if (!isset($_SESSION["user"])) {
        header("location: login.php");
    }
    ?>

    <script>
        function toggleClass(target, className) {
            const el = typeof target === 'string' ? document.querySelector(target) : target;
            if (!el) return;

            el.classList.toggle(className);
        }
    </script>
</body>

</html>