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
    <title>Register</title>
    <link rel="stylesheet" href="style1.css">
    <style>
        .error {
            color: #ff0000;
            display: block;
        }
    </style>
</head>

<body>
    <div class="content">
        <habbo-header-small>
            <header class="header__wrapper wrapper">
                <a href="/" class="logo">
                    <h1><?= e($HOTEL_NAME); ?></h1>
                </a>
                <div class="header__aside">
                    <a href="login.php" class="header__login__button">
                        <span class="header__login__icon">Login</span>
                    </a>
                </div>
            </header>
            <div class="wrapper"></div>
        </habbo-header-small>
        <main class="wrapper wrapper--content">
            <h1>Register for free!</h1>
            <form action="engine.php" method="post" class="form form--left registration-form ng-pristine ng-invalid ng-invalid-required ng-valid-minlength ng-valid-maxlength ng-valid-password-name ng-valid-password-email ng-valid-password-pattern ng-valid-matches ng-valid-pattern ng-valid-email">
                Username: <input type="text" name="username" id="username" class="form__input " required minlength="3" maxlength="20" pattern="[a-zA-Z0-9_]+" value="<?= e($old["username"] ?? ''); ?>"><br>
                <?php if (isset($errors['username'])): ?>
                    <span class="form__popover form__popover--error form__popover--inline"><?= e($errors['username']) ?></span>
                <?php endif; ?>
                Email: <input type="email" name="email" id="email" class="form__input " value="<?= e($old["email"] ?? '');  ?>" required><br>
                <?php if (isset($errors['email'])): ?>
                    <span class="error"><?= e($errors['email']) ?></span>
                <?php endif; ?>
                Password: <input type="password" name="password" id="password" class="form__input " required minlength="8"><br>
                <?php if (isset($errors['password'])): ?>
                    <span class="error"><?= e($errors['password']) ?></span>
                <?php endif; ?>
                Confirm Password: <input type="password" name="confirm_password" id="confirm_password" class="form__input " required minlength="8"><br>
                <?php if (isset($errors['confirm_password'])): ?>
                    <span class="error"><?= e($errors['confirm_password']) ?></span>
                <?php endif; ?>
                <button type="submit" class="form__submit registration-form__button habbo-registration-button" name="register">Register</button>
            </form>
        </main>

    </div>

    <?php
    if (isset($_SESSION["user"])) {
        header("location: home.php");
    }
    ?>
</body>

</html>