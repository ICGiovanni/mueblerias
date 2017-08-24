<?php session_start();
if (isset($_SESSION['login_session']['sucursal_id'])) {
    header('location: profile.php');
}
include $_SERVER['REDIRECT_PATH_CONFIG'] . 'config.php';
include $pathProy . 'login/models/class.Login.php';

include $pathProy . 'header2.php';


$insLogin = new Login();
$sucursales = $insLogin->getSucursales();
?>
<style type="text/css">
    .m-b {
        width: 97%;
    }
</style>
<div class="middle-box text-center animated fadeInDown">
    <div style="background-color: #FFF; padding: 30px 50px 30px 50px;">
        <img src="<?php echo $raizProy ?>img/logo_globmint2.png" class="img-responsive"
             style='margin-left: auto; margin-right: auto; max-height: 270px'/>

        <div class="clear">&nbsp;</div>
        <div class="clear">&nbsp;</div>
        <p>SISTEMA DE INVENTARIOS</p>
        <div class="clear"></div>
        <form class="m-t" method="post" role="form" action="guarda-sucursal.php">           
            <div class="input-group m-b">
                <select name="sucursal_id" id="sucursal_id" class="form-control">
                    <?php
                    if (is_array($sucursales) && count($sucursales) > 0) {
                        echo "<option value='0'>Selecciona una sucursal</option>";
                        foreach ($sucursales as $sucursal) {
                            echo "<option value='" . $sucursal['sucursal_id'] . "'>" . $sucursal['sucursal_name'] . "</option>";
                        }
                    } else {
                        echo "<option value='0'>Aún no se registran sucursales, contacte al administrador</option>";
                    }
                    ?>
                </select>
            </div>

            <div>
                <?php
                if (isset($_GET['error'])) {
                    ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
                        <?php echo base64_decode($_GET['error']); ?>
                    </div>
                    <?php
                }
                ?></div>
            <button type="submit" class="btn btn-primary block full-width m-b">Elegir Sucursal</button>            
        </form>
    </div>
</div>

<!-- Mainly scripts -->
<script src="<?php echo $raizProy ?>js/jquery-2.1.1.js"></script>
<script src="<?php echo $raizProy ?>js/bootstrap.min.js"></script>

</body>

</html>
