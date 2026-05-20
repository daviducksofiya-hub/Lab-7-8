<?php
session_start();
require __DIR__ . "/auth.php";

if (isAuthorized()) {
    header("Location: admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вхід адміністратора | Котики Софії</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="auth-page">
    <main class="auth-shell">
        <a class="logo auth-logo" href="index.php">Котики Софії</a>

        <section class="auth-card">
            <h1>Вхід адміністратора</h1>
            <p>Увійдіть, щоб переглянути повідомлення від відвідувачів сайту.</p>

            <form class="signIn-form">
                <label>
                    <span>Логін</span>
                    <input type="text" name="login" placeholder="admin" required>
                </label>

                <label>
                    <span>Пароль</span>
                    <input type="password" name="password" placeholder="admin" required>
                </label>

                <button class="loginBtn" type="submit">Увійти</button>
            </form>
        </section>
    </main>

    <script src="js/login.js"></script>
</body>
</html>
