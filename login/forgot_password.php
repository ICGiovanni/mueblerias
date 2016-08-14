<?php
    include $_SERVER['REDIRECT_PATH_CONFIG'].'config.php';    
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
                            <input type="text" name="email" placeholder="Correo Electrónico" class="form-control">
                        </div>
                        <?php 
                            if (isset($_GET['error'])){                         
                        ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <?php echo base64_decode ($_GET['error']); ?>
                        </div>
                        <?php                            
                            }
                        
                            if (isset($_GET['success'])){                         
                        ?>
                        <div class="alert alert-success">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <?php echo base64_decode ($_GET['success']); ?>
                        </div>
                        <?php                            
                            }
                        ?>
                        
                        <div class="clear">&nbsp;</div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Solicitar contraseña</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
      <!-- Mainly scripts -->
    <script src="<?php echo $raizProy?>js/jquery-2.1.1.js"></script>
    <script src="<?php echo $raizProy?>js/bootstrap.min.js"></script>
</body>

</html>
