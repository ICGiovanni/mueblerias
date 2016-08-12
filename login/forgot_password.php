<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Globmint | Forgot password</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

     <div class="middle-box text-center animated fadeInDown">
        <div class="ibox-content" style="background-color: #FFF; padding: 30px 50px 30px 50px;">
            <a href="index.php"><img src="../img/logo_globmint2.png" /></a>
            <div class="clear">&nbsp;</div>
            <div class="clear">&nbsp;</div>           
            <p class="text-left">
                Escribe el correo electrónico con el que te registraste para poder restablecer tu contraseña.
            </p>

            <div class="row">

                <div class="col-lg-12">
                    <form class="m-t" method="post" role="form" action="send_password.php">
                        <div class="input-group m-b">
                            <span class="input-group-addon">@</span>
                            <input type="text" placeholder="Correo Electrónico" class="form-control">
                        </div>
                         <div class="clear">&nbsp;</div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Solicitar contraseña</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>
