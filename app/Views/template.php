<!DOCTYPE html>
<html>
<head>
    <title>UXWD Potluck</title>
    <meta charset="UTF-8" />
    <meta name="keywords" content="UXWD course demo" />
    <meta name="description"
          content="This a demo for the UXWD course. But still... the question is... who will cook tonight?" />
    <link href="https://fonts.googleapis.com/css?family=Dosis:400,500,600,700" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url()?>/public/css/main.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="<?= base_url()?>/public/css/media_query.css">
</head>

<body>
<header>
    <div id="logo">
        <h1><?= $title?></h1>
        <h2>UXWD demo site</h2>
    </div>
    <nav>
        <ul>
            <li><a href="main.html">Home</a></li>
            <li><a href="#">Tips</a></li>
            <li><a href="#">Create</a></li>
            <li><a href="#">About</a></li>
        </ul>
    </nav>
</header>
<main>
    <section>
        <h2><?= $content_title_1?></h2>
        <h3><?= $content_title_2?> ?</h3>
        <p>
            <?= $content?>
        </p>
    </section>
    <aside>
        <article>
            <h3>Latest PotLuck...</h3>
            <ul>
                <li><a href="#">Happy Hour @ Koen</a></li>
                <li><a href="#">Vero goes Culinar</a></li>
                <li><a href="#">Jeroen's (Pot)Lucky-evening</a></li>
            </ul>
        </article>
        <article>
            <h3>Feedback</h3>
            <p>This concept is awesome! Also the site looks nice and stylish <em>(Jeroen)</em></p>
            <p>Is there also a mobile app for this site? <em>(Patrick)</em></p>
            <p>Student cooking with <a href="https://dagelijksekost.een.be/">Dagelijkse Kost</a>
        </article>
    </aside>
</main>
<footer>
    <p>Copyright &copy; 2020 UXWD. KUL&nbsp;All Rights Reserved.&nbsp;&nbsp;
        <a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a>
    </p>
</footer>
</body>
</html>

