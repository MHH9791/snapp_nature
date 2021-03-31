<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="HandheldFriendly" content="true">

    <link type="text/css" href="/public/layoutit/src/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="/public/css/navbar.css">
    <link rel="stylesheet" href="/public/css/add_obs_picture.css">
    <link rel="stylesheet" href="/public/css/nearby_map_page.css">

    <?php if (isset($stylesheets_to_load)) foreach ($stylesheets_to_load as $stylesheet): ?>
        <link rel="stylesheet" href="/public/css/<?=$stylesheet?>">
    <?php endforeach; ?>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <?php if (isset($scripts_to_load)) foreach ($scripts_to_load as $script): ?>
        <script src="/public/js/<?=$script?>" defer></script>
    <?php endforeach; ?>
    <title>Snapp Nature</title>
</head>
<body>

<div id="toast"></div>

<nav class="topbar">
    <?= $topbar ?>
</nav>

<?php if (isset($page_title)) : ?>
    <div class="page-title">
        <div class="page-title"><?= $page_title ?></div>
    </div>
<?php endif; ?>

<?php if (isset($navbar)) : ?>
    <nav class="navbar">
        <?= $navbar ?>
    </nav>
<?php endif; ?>

<div class="page-content"
    <?php if(isset($page_non_scrollable)): ?>
        <?php if($page_non_scrollable == True): ?>
        style = "position:fixed;"
        <?php else: ?>
        style = "position:relative;"
        <?php endif; ?>
    <?php endif; ?>
>

    <?php if (isset($page_content)) : ?>
        <?= $page_content ?>
    <?php endif; ?>

</div>

</body>

</html>