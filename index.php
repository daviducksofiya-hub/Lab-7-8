<?php
session_start();
require __DIR__ . "/auth.php";

$authText = isAuthorized() ? "Вийти" : "Вхід";
$authLink = isAuthorized() ? "logout.php" : "login.php";
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Котики Софії | Lab 7-8</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

<header class="header">
    <div class="container header-container">
        <a href="index.php" class="logo">Котики Софії</a>

        <nav>
            <ul class="desktop-menu">
                <li><a href="#home">Головна</a></li>
                <li><a href="#about">Про котика</a></li>
                <li><a href="#portfolio">Котики</a></li>
                <li><a href="#slider">Слайдер</a></li>
                <li><a href="#contact">Контакти</a></li>
                <li><a href="admin.php">Адмін</a></li>
                <li><a href="<?php echo $authLink; ?>"><?php echo $authText; ?></a></li>
            </ul>

            <ul class="mobile-menu">
                <li><a href="#home">Головна</a></li>
                <li><a href="#about">Про котика</a></li>
                <li><a href="#portfolio">Котики</a></li>
                <li><a href="#slider">Слайдер</a></li>
                <li><a href="#contact">Контакти</a></li>
                <li><a href="admin.php">Адмін</a></li>
                <li><a href="<?php echo $authLink; ?>"><?php echo $authText; ?></a></li>
            </ul>
        </nav>

        <button class="burger" type="button" aria-label="Відкрити меню">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>

<main>
    <section class="hero" id="home">
        <div class="container hero-container">
            <div class="hero-text">
                <h1>Привіт, я Софія</h1>
                <p>Я хочу розповісти про котиків із притулку, які шукають турботу, спокійний дім і своїх людей.</p>
                <a class="hero-link" href="#contact">Написати мені</a>
            </div>

            <div class="hero-image">
                <img src="images/cat5.jpg" alt="Котик із притулку">
            </div>
        </div>
    </section>

    <section class="about" id="about">
        <div class="container about-container">
            <div class="about-image">
                <img src="images/cat4.jpg" alt="Котик на фото">
            </div>

            <div class="about-text">
                <h2>Котик на фото</h2>
                <p>
                    Це лагідний котик, який дуже любить увагу й швидко звикає до добрих людей.
                    Він спокійний, охайний і мріє про теплий куточок удома.
                </p>
            </div>
        </div>
    </section>

    <section class="portfolio" id="portfolio">
        <div class="container">
            <h2 class="title">Котики з притулку</h2>
            <div class="card-wrap" id="cats-container"></div>
        </div>
    </section>

    <section class="testimonial" id="slider">
        <div class="container">
            <h2 class="title">Історії котиків</h2>
            <p class="section-lead">Кожен котик має свій характер і маленьку мрію про дім.</p>

            <div class="slider" data-slider>
                <div class="slider-track">
                    <article class="slide active">
                        <img src="images/cat1.jpg" alt="Пухнастик">
                        <div>
                            <h3>Пухнастик</h3>
                            <p>Любить тишу, теплі пледи й людей, які не поспішають. Дуже ніжний, коли довіриться.</p>
                        </div>
                    </article>

                    <article class="slide">
                        <img src="images/cat2.jpg" alt="Мурчик">
                        <div>
                            <h3>Мурчик</h3>
                            <p>Активний і веселий, завжди першим приходить знайомитися та просить погратися.</p>
                        </div>
                    </article>

                    <article class="slide">
                        <img src="images/cat3.jpg" alt="Сонечко">
                        <div>
                            <h3>Сонечко</h3>
                            <p>Спокійна кішечка, яка любить сидіти біля вікна й дуже чекає свою родину.</p>
                        </div>
                    </article>
                </div>

                <div class="slider-controls">
                    <button class="slider-btn" type="button" data-prev aria-label="Попередній слайд">‹</button>
                    <div class="slider-dots" data-dots></div>
                    <button class="slider-btn" type="button" data-next aria-label="Наступний слайд">›</button>
                </div>
            </div>
        </div>
    </section>

    <section class="form-section" id="contact">
        <div class="container">
            <h2 class="title">Зв'язатися зі мною</h2>

            <div class="form-container">
                <form class="main-form" novalidate>
                    <label for="name">Ім'я*</label>
                    <input type="text" id="name" name="name">

                    <label for="email">Email*</label>
                    <input type="email" id="email" name="email">

                    <label for="location">Місто</label>
                    <input type="text" id="location" name="location">

                    <div class="double-input">
                        <div>
                            <label for="budget">Допомога*</label>
                            <input type="text" id="budget" name="budget">
                        </div>
                        <div>
                            <label for="subject">Тема*</label>
                            <input type="text" id="subject" name="subject">
                        </div>
                    </div>

                    <label for="message">Повідомлення*</label>
                    <textarea id="message" name="message"></textarea>

                    <button class="submit-btn" type="submit">
                        <span>Надіслати</span>
                    </button>
                </form>
            </div>
        </div>
    </section>
</main>

<footer class="footer">
    <div class="footer__logo">
        <span>Котики Софії</span>
    </div>

    <ul class="footer__menu">
        <li><a href="#home">Головна</a></li>
        <li><a href="#about">Про котика</a></li>
        <li><a href="#portfolio">Котики</a></li>
        <li><a href="#slider">Слайдер</a></li>
        <li><a href="#contact">Контакти</a></li>
    </ul>

    <p class="footer__copyright">&copy; 2026 Котики Софії.</p>
</footer>

<script src="js/content.js"></script>
<script src="js/script.js"></script>

</body>
</html>
