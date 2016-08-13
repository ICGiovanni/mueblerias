<?php
    include '../config.php';    
    include $pathProy.'/header.php';
?>

    <div class="middle-box text-center animated fadeInDown">
        <div style="background-color: #FFF; padding: 30px 50px 30px 50px;">
            <img src="<?php echo $raizProy?>img/logo_globmint2.png" />

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
    <script src="<?php echo $raizProy?>js/jquery-2.1.1.js"></script>
    <script src="<?php echo $raizProy?>js/bootstrap.min.js"></script>

</body>

</html>
