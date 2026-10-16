<?php require_once("include.php");
$errors = $_SESSION['errors'] ?? [];
$old    = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .error {
            color: #ff0000;
            display: block;
        }

        .logo {
            padding-top: 10px;
            color: #eaff00;
            font-weight: 900;
            font-size: 73px;
            margin: 0 auto;
            min-width: 203px;
        }
    </style>
    <link rel="stylesheet" href="style1.css">
</head>

<body>
    <div class="header__top sticky-header sticky-header--top">
        <div class="wrapper">
            <div class="header__top__content">
                <h1 class="logo"><?= e($HOTEL_NAME); ?></h1>
                <h2 class="register-banner__title">some text here</h2>
                <a href="register.php" class="register-banner__button">Register</a>
            </div>
        </div>
    </div>
    <div class="header__content">
        <habbo-register-banner class="habbo-register-banner">
            <div class="register-banner__hotel"></div>
            <div class="register-banner__wrapper">
                <div class="register-banner__register">
                    <button class="header__top__toggle login-button" onclick="toggleClass('#tag1', 'ng-hide');">Login</button>
                    <habbo-login-form id="tag1" class="header__login-form ng-hide">
                        <div class="login-form__email-login">
                            <div class="login-form__login-text" style="margin-top: 10px">
                                Use your username & password:
                                <form action="engine.php" method="post">
                                    Username: <input type="text" name="username" class="form__input" id="username_input" value="<?= e($old["username"] ?? '') ?>" required><br>
                                    <?php if (isset($errors['username'])): ?>
                                        <span class="error"><?= e($errors['username']) ?></span>
                                    <?php endif; ?>
                                    Password: <input type="password" name="password" class="form__input" id="password_input" required><br>
                                    <?php if (isset($errors['password'])): ?>
                                        <span class="error"><?= e($errors['password']) ?></span>
                                    <?php endif; ?>
                                    <button type="submit" class="login-form__button habbo-login-button" name="login">Login</button>
                                </form>
                            </div>
                        </div>
                    </habbo-login-form>
                </div>
            </div>
        </habbo-register-banner>
    </div>

    <script>
        function toggleDisplay(target, displayValue = 'block') {
            const el = typeof target === 'string' ? document.querySelector(target) : target;
            if (!el) return;

            const currentDisplay = window.getComputedStyle(el).display;
            el.style.display = currentDisplay === 'none' ? displayValue : 'none';
        }

        function toggleClass(target, className) {
            const el = typeof target === 'string' ? document.querySelector(target) : target;
            if (!el) return;

            el.classList.toggle(className);
        }
    </script>


    <?php
    if (isset($_SESSION["user"])) {
        header("location: home.php");
    }
    ?>
</body>

</html>