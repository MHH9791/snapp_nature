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
    <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <title>Change password</title>
</head>
<body>

<div class="page-content">
    <div class="login_page">
        <form method="post" name="ChangePassword">
            <article>
                <p>
                    <input type = "password" name="new_password" id = "new_password" placeholder= "New password" class="inputStyle"/>
                </p>
                <p>
                    <input type = "password" name="confirm_new_password" id = "confirm_new_password" placeholder= "Confirm password" class="inputStyle"/>
                </p>
                <?php if (isset($validation)): ?>
                    <div class="register_alert" role="alert">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>
                <p>
                    <input type="submit" value="Change" class="buttonStyle"/>
                </p>
            </article>
        </form>

    </div>
</div>


</body>

<nav class="topbar" style>
    <a href="#" class="nav__link" style="min-width: 51.25vw; margin: 9px">
        <img class="nav__icon"
             style="max-width: 100%; max-height: 100%"
             src="//a20ux5.studev.groept.be/Assets/logo.png" alt="snapp_logo">
    </a>
</nav>

</html>