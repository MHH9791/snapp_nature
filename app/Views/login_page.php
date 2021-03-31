<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="HandheldFriendly" content="true">

    <link type="text/css" href="//a20ux5.studev.groept.be/public/layoutit/src/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//a20ux5.studev.groept.be/public/css/style.css">
    <link rel="stylesheet" href="//a20ux5.studev.groept.be/public/css/navbar.css">
    <link rel="stylesheet" href="//a20ux5.studev.groept.be/public/css/login_register_change.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <title>Login</title>
</head>
<body>

<div class="page-content" style="position: fixed">
    <div class="login_page">
        <?php if (session()->get('success')): ?>
            <div class="toast" id ='success_toast' >
                <div class="toast-header">
                    <strong class="mr-auto text-primary">Toast Header</strong>
                    <small class="text-muted">5 mins ago</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
                </div>
                <div class="toast-body">
                    <?= session()->get('success') ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if (session()->get('logout')): ?>
            <div class="toast" id ='logout_toast'>
                <div class="toast-header">
                    <strong class="mr-auto text-primary">Toast Header</strong>
                    <small class="text-muted">5 mins ago</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
                </div>
                <div class="toast-body">
                    <?= session()->get('logout') ?>
                </div>
            </div>
        <?php endif; ?>
        <script src="/public/js/login_toast.js"></script>

        <form method="post" name="Login">
            <div>
                <p>
                    <input type = "text" name="email" id = "email" placeholder="<?php echo lang('text.email_address')?>" class="inputStyle" value = "<?=set_value('email')?>"/>
                </p >
                <p>
                    <input type = "password" name="password" id = "password" placeholder=<?php echo lang('text.password')?> class="inputStyle"/>
                </p>

                <?php if (isset($validation)): ?>
                    <div class="register_alert" role="alert">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>
                <p>
                    <input type="submit" value=<?php echo lang('text.login')?> class="buttonStyle"/>
                </p >
                <p class="loginText">
                    <a><?php echo lang('text.no_account')?></a><a href="register"> <?php echo lang('text.register')?></a>
                </p>
            </div>
        </form>
    </div>
</div>

<div class="topbar">
    <a href="#" class="nav__link" style="min-width: 51.25vw; margin: 9px">
        <img class="nav__icon"
             style="max-width: 100%; max-height: 100%"
             src="//a20ux5.studev.groept.be/Assets/logo.svg" alt="snapp_logo">
    </a>
</div>

</body>

</html>