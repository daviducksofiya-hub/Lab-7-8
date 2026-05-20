<?php
session_start();
require __DIR__ . "/auth.php";
require __DIR__ . "/subscriptions-lib.php";

$authorized = isAuthorized();
$subscriptions = $authorized ? allSubscriptions() : [];
$authText = $authorized ? "Вийти" : "Вхід";
$authLink = $authorized ? "logout.php" : "login.php";
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Адміністратор | Котики Софії</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header class="header">
        <div class="container header-container">
            <a href="index.php" class="logo">Котики Софії</a>
            <nav>
                <ul class="desktop-menu admin-menu">
                    <li><a href="index.php">Головна</a></li>
                    <li><a href="<?php echo $authLink; ?>"><?php echo $authText; ?></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="admin-page">
        <div class="container">
            <div class="admin-heading">
                <div>
                    <h1>Панель адміністратора</h1>
                    <p>Тут відображаються повідомлення, які користувачі надсилають через форму.</p>
                </div>
                <?php if ($authorized): ?>
                    <a class="logoutBtn" href="logout.php">Вийти</a>
                <?php endif; ?>
            </div>

            <?php if (!$authorized): ?>
                <div class="notice-card">
                    <h2>Доступ обмежено</h2>
                    <p>Ця сторінка доступна тільки авторизованому адміністратору.</p>
                    <a class="hero-link" href="login.php">Увійти</a>
                </div>
            <?php else: ?>
                <section class="info-container">
                    <div class="table">
                        <div class="table__head">
                            <div>№</div>
                            <div>Ім'я</div>
                            <div>Email</div>
                            <div>Місто</div>
                            <div>Тема</div>
                            <div>Повідомлення</div>
                            <div>Дата</div>
                        </div>

                        <div class="table__body">
                            <?php if (empty($subscriptions)): ?>
                                <div class="empty-row">Поки немає жодного повідомлення.</div>
                            <?php else: ?>
                                <?php foreach ($subscriptions as $index => $subscription): ?>
                                    <div class="row">
                                        <div class="cell"><?php echo $index + 1; ?></div>
                                        <div class="cell"><?php echo htmlspecialchars($subscription["name"] ?? "", ENT_QUOTES, "UTF-8"); ?></div>
                                        <div class="cell"><?php echo htmlspecialchars($subscription["email"] ?? "", ENT_QUOTES, "UTF-8"); ?></div>
                                        <div class="cell"><?php echo htmlspecialchars($subscription["location"] ?? "", ENT_QUOTES, "UTF-8"); ?></div>
                                        <div class="cell"><?php echo htmlspecialchars($subscription["subject"] ?? "", ENT_QUOTES, "UTF-8"); ?></div>
                                        <div class="cell"><?php echo htmlspecialchars($subscription["message"] ?? "", ENT_QUOTES, "UTF-8"); ?></div>
                                        <div class="cell"><?php echo htmlspecialchars($subscription["timestamp"] ?? "", ENT_QUOTES, "UTF-8"); ?></div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
