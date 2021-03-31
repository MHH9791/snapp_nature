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

    <title>Register</title>
</head>
<body>

<div class="page-content" style="position: fixed">
    <div class="login_page">
        <form method="post" name="Register" >
            <article>
                <p>
                    <input type = "text" name="username" id = "username" placeholder= "Username" class="inputStyle" value = "<?=set_value('username')?>"/>
<!--                    <span class="text-danger">--><?//echo form_error('username');?>
                </p >
                <p>
                    <input type = "text" name="email" id = "email" placeholder= "Email address" class="inputStyle" value = "<?=set_value('email')?>"/>
                </p >
                <p>
                    <input type = "password" name="password" id = "password" placeholder= "Password" class="inputStyle"/>
                </p>
                <p>
                    <input type = "password" name="password_confirm" id = "password_confirm" placeholder= "Confirm password" class="inputStyle"/>
                </p>
                <div>
                <?php if (isset($validation)): ?>

                        <div class="register_alert" role="alert">
                            <?= $validation->listErrors() ?>
                        </div>
                <?php endif; ?>
                </div>
                <p>
                    <input type="submit" value="Register" class="buttonStyle">
                </p >
                <p class="loginText">
                    <a>Already have an account?</a><a href="login">login</a>
                </p>
            </article>
        </form>

    </div>
</div>


</body>

<nav class="topbar" style>
    <a href="./activity" class="nav__link" style="min-width: 51.25vw; margin: 9px">
        <img class="nav__icon"
             style="max-width: 100%; max-height: 100%"
             src="//a20ux5.studev.groept.be/Assets/logo.svg" alt="snapp_logo">
    </a>
</nav>

</html>