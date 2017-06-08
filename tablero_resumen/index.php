
<?php
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'config.php';
//require_once($_SERVER["REDIRECT_PATH_CONFIG"].'login/session.php');
require_once $pathProy.'/header2.php';
require_once $pathProy.'/menu.php';


require_once $_SERVER['REDIRECT_PATH_CONFIG'].'tablero_resumen/models/class.Tablero.php';

$instTablero = new Tablero();

//por default la fecha es la del dia de ejecucion
$fecha_inicio = date('d/m/Y');
$fecha_final = date('d/m/Y');

//si se envian las fechas de inicio y final se toman como intervalo para el reporte
if($_POST){
    if(isset($_POST['fecha_inicio'])){
        $fecha_inicio = $_POST['fecha_inicio'];
    }
    if(isset($_POST['fecha_final'])){
        $fecha_final = $_POST['fecha_final'];
    }
}

?>

<style type="text/css">
  .btn-blue{
    color: #fff !important;
    background-color: #337ab7 !important;
    border-color: #2e6da4 !important;
  }

  .btn-green{
    color: #fff !important;
    background-color: #5cb85c !important;
    border-color: #4cae4c !important;
  }

  .btn-yellow{
    color: #fff !important;
    background-color: #C37D0E !important;
    border-color: #4cae4c !important;
  }
  
  .btn-red{
    color: #fff !important;
    background-color: #C64333 !important;
    border-color: #4cae4c !important;
  }

  .th-blue th{
    color: #fff !important;
    background-color: #337ab7 !important;     
  }
  .th-green th{
    color: #fff !important;
    background-color: #5cb85c !important;
  }

  .th-yellow th{
    color: #fff !important;
    background-color: #C37D0E !important;
  }

  .th-red th{
    color: #fff !important;
    background-color: #C64333 !important;    
  }

  .table-bordered{
    border-color: #DDD;
  }

  .label-filtro{
    padding-top: 8px;
    font-weight: bold;

  }

  .dataTables_length{
        dispay: none !important;
  }

  .dataTables_filter {
      width: 24%;
  }
  .dataTables_filter input, .dataTables_paginate{
      color: #999;
  }
</style>
<link href="<?php echo $raizProy?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">

<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Tablero de Resumen</h2>
    <ol class="breadcrumb">
      <li class="active">
        <strong>Tablero de Resumen</strong>
      </li>
    </ol>
  </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

  <div>

    <style scoped>
       @import "../css/AdminLTE.css";
    </style>      
    
    <div class="row" >          
      <section class="col-lg-12 connectedSortable ibox">
          <div class="ibox">
              <div class="ibox-title">
                  <form role="form" class="form-inline" method="POST">
                      <div class="form-group">
                          <label for="fecha_inicio" >Fecha Inicio:</label>
                          <div class="input-group date">
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="fecha_inicio" name="fecha_inicio" class="form-control" value="<?php echo $fecha_inicio;?>">
                          </div>

                      </div>
                      <div class="form-group">
                          <label for="fecha_final">&nbsp;Fecha Final:</label>
                          <div class="input-group date">
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="fecha_final" name="fecha_final" class="form-control" value="<?php echo $fecha_final;?>">
                          </div>

                      </div>
                      <button class="btn btn-primary" type="submit">Filtar </button>
                  </form>
              </div>
          </div>

        <div class="box box-solid bg-light-blue-gradient">

          <div class="box-header">    
            <div class="pull-right box-tools">
              <button type="button" class="btn btn-primary btn-sm pull-right btn-blue" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                    <i class="fa fa-minus"></i></button>
            </div>
            <i class="fa fa fa-th"></i>
            <h3 class="box-title">Ingreso por envios</h3>
          </div>
          <div class="box-body">
            <table class="table table-bordered dataTables-example">
              <thead class="th-blue">
                <tr>
                  <th>ID Venta</th>
                  <th>Fecha</th>
                  <th>Sucursal</th>
                  <th>Monto envio</th>
                  <th>Detalle</th>
                  <th>Fecha entrega</th>
                </tr>
              </thead>
              <tbody>

              <?php
                $ingresosEnvio = $instTablero->ingresosPorEnvio($fecha_inicio, $fecha_final);
                if(count($ingresosEnvio) >0 ){
                    foreach($ingresosEnvio as $ingreso){
                        $detalle_envio = json_decode($ingreso['detalle_envio'], true);
                        $detalle = $detalle_envio['select_zona_envio']."<br />".$detalle_envio['select_planta']."<br />".$detalle_envio['select_planta_extra'];
                        echo "<tr>".
                                "<td>".$ingreso['venta_id']."</td>".
                                "<td>".$ingreso['fecha_creacion']."</td>".
                                "<td>".$ingreso['sucursal_id']."</td>".
                                "<td>".$ingreso['costo_envio']."</td>".
                                "<td>".$detalle."</td>".
                                "<td>".$ingreso['fecha_entrega']."</td>".
                             "</tr>";
                    }
                }

              ?>
              </tbody>
            </table>
          </div>
        </div> 


        <div class="box box-solid bg-green collapsed-box">
          <div class="box-header">    
            <div class="pull-right box-tools">                
              <button type="button" class="btn btn-success btn-sm pull-right btn-green" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                    <i class="fa fa-plus"></i></button>
            </div>
            <i class="fa fa fa-th"></i>
            <h3 class="box-title">SALIDAS/ENTRADAS DE MERCANCIA</h3>
          </div>
          <div class="box-body">
              <table class="table table-bordered dataTables-example">
              <thead class="th-green">
                <tr>
                  <th>#</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Username</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Jacob</td>
                  <td>Thornton</td>
                  <td>@fat</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Larry</td>
                  <td>the Bird</td>
                  <td>@twitter</td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>  

        <div class="box box-solid bg-yellow collapsed-box collapsed-box">
          <div class="box-header">    
            <div class="pull-right box-tools">                
              <button type="button" class="btn btn-primary btn-sm pull-right btn-blue btn-yellow" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                    <i class="fa fa-plus"></i></button>
            </div>
            <i class="fa fa fa-th"></i>
            <h3 class="box-title">PROMEDIO VENTAS</h3>
          </div>
          <div class="box-body">
              <table class="table table-bordered dataTables-example">
              <thead class="th-yellow">
                <tr>
                  <th>#</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Username</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Jacob</td>
                  <td>Thornton</td>
                  <td>@fat</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Larry</td>
                  <td>the Bird</td>
                  <td>@twitter</td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>  


        <div class="box box-solid bg-red collapsed-box collapsed-box">
          <div class="box-header">    
            <div class="pull-right box-tools">                
              <button type="button" class="btn btn-primary btn-sm pull-right btn-red" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                    <i class="fa fa-plus"></i></button>
            </div>
            <i class="fa fa fa-th"></i>
            <h3 class="box-title">CORTE GASTOS/INGRESOS</h3>
          </div>
          <div class="box-body">
              <table class="table table-bordered dataTables-example">
              <thead class="th-red">
                <tr>
                  <th>#</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Username</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Jacob</td>
                  <td>Thornton</td>
                  <td>@fat</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Larry</td>
                  <td>the Bird</td>
                  <td>@twitter</td>
                </tr>
              </tbody>
            </table>
          </div>

        </div> 


        <div class="box box-solid bg-light-blue-gradient collapsed-box">
          <div class="box-header">    
            <div class="pull-right box-tools">                
              <button type="button" class="btn btn-primary btn-sm pull-right btn-blue" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                    <i class="fa fa-plus"></i></button>
            </div>
            <i class="fa fa fa-th"></i>
            <h3 class="box-title">VENTAS POR VENDEDOR</h3>
          </div>
          <div class="box-body">
              <table class="table table-bordered dataTables-example">
              <thead class="th-blue">
                <tr>
                  <th>#</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Username</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Jacob</td>
                  <td>Thornton</td>
                  <td>@fat</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Larry</td>
                  <td>the Bird</td>
                  <td>@twitter</td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>  

        <div class="box box-solid bg-green collapsed-box">
          <div class="box-header">    
            <div class="pull-right box-tools">                
              <button type="button" class="btn btn-primary btn-sm pull-right btn-green" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                    <i class="fa fa-plus"></i></button>
            </div>
            <i class="fa fa fa-th"></i>
            <h3 class="box-title">ARTICULOS + VENDIDOS</h3>
          </div>
          <div class="box-body">
              <table class="table table-bordered dataTables-example">
              <thead class="th-green">
                <tr>
                  <th>#</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Username</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Jacob</td>
                  <td>Thornton</td>
                  <td>@fat</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Larry</td>
                  <td>the Bird</td>
                  <td>@twitter</td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>  

      </section>
    </div>
    
    <div class="footer">
      <div class="pull-right">
            10GB of <strong>250GB</strong> Free.
      </div>
      <div>
        <strong>Copyright</strong> Example Company &copy; 2014-2015
      </div>
    </div>

  </div>

</div>


<!-- jQuery 2.2.3 -->
<script src="<?=$raizProy?>js/jquery-2.1.1.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=$raizProy?>js/jquery-ui-1.10.4.min.js"></script>


<!-- Dashboard App -->
<script src="<?=$raizProy?>js/dashboard.js"></script>

<!-- AdminLTE App -->
<script src="<?=$raizProy?>js/app.js"></script>

<!-- Mainly scripts -->
<script src="<?=$raizProy?>js/bootstrap.min.js"></script>
<script src="<?=$raizProy?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?=$raizProy?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?=$raizProy?>js/inspinia.js"></script>
<script src="<?=$raizProy?>js/plugins/pace/pace.min.js"></script>

<script src="<?=$raizProy?>js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="<?php echo $raizProy?>js/plugins/dataTables/datatables.min.js"></script>
<script>
    $(document).ready(function(){
        $('.input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: 'dd/mm/yyyy'
        });

        $('.dataTables-example').DataTable({
            "language": {
                "url": "../js/plugins/dataTables/Spanish.json"
            },
            "lengthChange": false,
            "dom": 'ftp'
        });

    });


</script>


