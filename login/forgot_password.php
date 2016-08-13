<?php
    include '../config.php';    
    include $pathProy.'/header.php';
?>
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
