<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Globmint | Login</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center animated fadeInDown">
        <div style="background-color: #FFF; padding: 30px 50px 30px 50px;">
            <img src="../img/logo_globmint2.png" />

            <div class="clear">&nbsp;</div>
            <div class="clear">&nbsp;</div>
            <p>SISTEMA DE INVENTARIOS</p>
            <div class="clear"></div>
            <form class="m-t" method="post" role="form" action="login.php">
                <div class="input-group m-b">
                    <span class="input-group-addon">@</span>
                    <input type="text" name="email" value="" placeholder="Correo Electrónico" class="form-control" required="">
                </div>
                <div class="input-group m-b">
                    <span class="input-group-addon"><i class="fa fa-lock">&nbsp;</i></span>
                    <input type="password" name="password" value="" class="form-control" placeholder="Contraseña" required="">
                </div>                
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a href="forgot_password.php"><small>¿Recordar contraseña?</small></a>                                
            </form>            
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="../js/jquery-2.1.1.js"></script>
    <script src="../js/bootstrap.min.js"></script>

</body>

</html>
