<?php
    include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
    //include $pathProy.'login/session.php';
    include $pathProy.'/header.php';
    include $pathProy.'/menu.php';
    require_once($_SERVER["REDIRECT_PATH_CONFIG"].'punto_venta/models/class.Caja.php');
    require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/general/class.General.php');
    $caja=new Caja();
    $general=new General();
    
?>
<link href="<?php echo $raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<link href="<?=$raizProy?>css/plugins/chosen/chosen.css" rel="stylesheet">


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Corte de Caja</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">Punto de Venta</a>
                </li>
                <li class="active">
                    <strong>Corte de Caja</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="./index.php" class="btn btn-warning btn-xs"><i class="fa fa-arrow-left"></i> Regresar a Punto de Venta</a>
            </div>
        </div>
    </div>

    
	<div class="col-lg-11">
			<div class="panel panel-default">
            <div class="panel-heading">
            <label class="control-label">Corte de Caja Parcial</label>
			</div>
            <div class="panel-body">
            	
            <div class="form-group">

            <div class="col-sm-2"><button class="btn btn-primary btn-xs" id="guardar_corte_parcial" type="button">Realizar Corte Parcial</button></div>
            <div class="col-sm-2"><button class="btn btn-primary btn-xs" id="guardar_monto_inicial" type="button" id="monto_inicial" data-toggle="modal" data-target="#montoInicial">Agregar Monto Inicial</button></div>
            </div>
			
            </div>
            
            <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tabla_clientes">
                    <thead>
                    <tr>
                    	<th align="center">ID</th>
                        <th align="center">Usuario</th>
                        <th align="center">Fecha</th>
                        <th align="center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody id="caja_parcial">
                    <?php
                    $parcial=$caja->getCashRegisterData();
                    
                    foreach($parcial as $p)
                    {
                    	$caja_id=$p['corte_parcial_id'];
                    	$usuario=$p['firstName']." ".$p["lastName"];
                    	$fecha=$general->getDateSimple($p['date']);
                    	
                    	$tr="";
                    	$tr.='<tr class="gradeX">';
                    	$tr.='<td align="center">'.$caja_id.'</td>';
                    	$tr.='<td>'.$usuario.'</td>';
                    	$tr.='<td>'.$fecha.'</td>';
                    	$tr.='<td align="center">';
                    	$tr.='<div class="infont col-md-1 col-sm-1"><a href="get_cash_register.php?cp='.$caja_id.'" title="Imprimir" target="_blank"><i class="fa fa-print"></i></a></div><div class="infont col-md-1 col-sm-1"><a href="#" title="Borrar" class="deleteBoxCutPartial" data-id="'.$caja_id.'"><i class="fa fa-trash-o"></i></a></div>';
    					$tr.='</td>';
                    	$tr.='</tr>';
                    	echo $tr;
                    }
                    
                    ?>
                    
                    </tbody>
                    </table>

            
            </div>
			</div>
            </div>
	
	
	
	<div class="col-lg-11">
			<div class="panel panel-default">
            <div class="panel-heading">
            <label class="control-label">Corte de Caja Final</label>
			</div>
            <div class="panel-body">
            	
            <div class="form-group">

            <div class="col-sm-2"><button class="btn btn-primary btn-xs" id="guardar_corte_final" type="button">Realizar Corte Final</button></div>
            
            </div>
			
            </div>
            
            <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tabla_corte_final">
                    <thead>
                    <tr>
                    	<th align="center">ID</th>
                        <th align="center">Usuario</th>
                        <th align="center">Fecha</th>
                        <th align="center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody id="caja_final">
                    <?php
                    $parcial=$caja->getCashRegisterDataFinal();
                    
                    foreach($parcial as $p)
                    {
                    	$caja_id=$p['corte_final_id'];
                    	$usuario=$p['firstName']." ".$p["lastName"];
                    	$fecha=$general->getDateSimple($p['date']);
                    	
                    	$tr="";
                    	$tr.='<tr class="gradeX">';
                    	$tr.='<td align="center">'.$caja_id.'</td>';
                    	$tr.='<td>'.$usuario.'</td>';
                    	$tr.='<td>'.$fecha.'</td>';
                    	$tr.='<td align="center">';
                    	$tr.='<div class="infont col-md-1 col-sm-1"><a href="get_cash_register_final.php?cf='.$caja_id.'" title="Imprimir" target="_blank"><i class="fa fa-print"></i></a></div><div class="infont col-md-1 col-sm-1"><a href="#" class="deleteBoxCutFinal" data-id="'.$caja_id.'" title="Borrar"><i class="fa fa-trash-o"></i></a></div>';
    					$tr.='</td>';
                    	$tr.='</tr>';
                    	echo $tr;
                    }
                    
                    ?>
                    
                    </tbody>
                    </table>

            
            </div>
			</div>
            </div>
	
	
	
	<div class="modal fade" id="montoInicial" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Monto Inicial</h4>
        </div>
        <div class="modal-body">
        <div class="wrapper wrapper-content animated fadeInRight">
          <label class="col-sm-2 control-label">Monto</label>
			<div class="col-sm-4" ><input type="text" class="form-control" id="monto" name="monto" onkeypress="return validateCantidad(event)" onkeyup="run(this)"></div>            
           </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary btn-xs" data-dismiss="modal" id="guardarMonto">Guardar</button>
        </div>
      </div>
      
    </div>
  </div>
	
	
	
	
	
	
	
<script src="<?php echo $raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo $raizProy?>js/plugins/toastr/toastr.min.js"></script>
<script src="<?php echo $raizProy?>punto_venta/js/caja.js"></script>
<script src="<?=$raizProy?>js/plugins/chosen/chosen.jquery.js"></script>

<?php
    include $pathProy.'footer.php';
?>