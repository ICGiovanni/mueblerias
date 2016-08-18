<?php
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once $pathProy.'/header.php';
require_once $pathProy.'/menu.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'gastos/models/class.Gastos.php');

$objGasto = new Gasto();
$rows = $objGasto->getGastos();

print_r($rows);
$html_rows = '';
while(list(,$dataGasto) = each($rows)){
	$dataGasto["gasto_saldo"]="0";
	$html_rows.= '<tr>
		<td>'.$dataGasto["gasto_no_documento"].'</td>
		<td>'.$dataGasto["gasto_fecha_vencimiento"].'</td>
		<td>'.$dataGasto["gasto_categoria_id"].'</td>
		<td class="center">'.$dataGasto["gasto_concepto"].'</td>
		<td class="center">'.$dataGasto["gasto_monto"].'</td>
		<td class="center">'.$dataGasto["gasto_saldo"].'</td>
		<td class="center">'.$dataGasto["gasto_status_id"].'</td>
	</tr>';
}
?>
<style>
.glyphicon-refresh-animate {
    -animation: spin .9s infinite linear;
    -webkit-animation: spin2 .9s infinite linear;
}

@-webkit-keyframes spin2 {
    from { -webkit-transform: rotate(0deg);}
    to { -webkit-transform: rotate(360deg);}
}

@keyframes spin {
    from { transform: scale(1) rotate(0deg);}
    to { transform: scale(1) rotate(360deg);}
}
.table-form td, th{
	padding: 5px;
}
</style>
		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Gastos</h5>
                        <div class="ibox-tools">
							
                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">+ Nuevo Gasto</button>
                            <!--<a class="collapse-link">
                                <i class="fa fa-plus-square-o"></i>
                            </a>-->
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
							
                        </div>
                    </div>
                    <div class="ibox-content">
						<div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Numero de Documento</th>
                        <th>Fecha Vencimiento</th>
						<th>Categoria</th>
                        <th>Concepto</th>
                        <th>Monto</th>
						<th>Saldo</th>
                        <th>Status</th>
						
                    </tr>
                    </thead>
                    <tbody>
						<?=$html_rows?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Numero de Documento</th>
                        <th>Fecha Vencimiento</th>
						<th>Categoria</th>
                        <th>Concepto</th>
                        <th>Monto</th>
						<th>Saldo</th>
                        <th>Status</th>
                    </tr>
                    </tfoot>
                    </table>
                        </div>

                    </div>
                </div>
            </div>
            </div>
            
        </div>
        <div class="footer">
            <div>
                <strong>Copyright</strong> 
            </div>
        </div>

        </div>
        </div>
		
    <!-- Mainly scripts -->
    <script src="<?=$raizProy?>js/jquery-2.1.1.js"></script>
    <script src="<?=$raizProy?>js/bootstrap.min.js"></script>
    <script src="<?=$raizProy?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?=$raizProy?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?=$raizProy?>js/plugins/jeditable/jquery.jeditable.js"></script>

    <script src="<?=$raizProy?>js/plugins/dataTables/datatables.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?=$raizProy?>js/inspinia.js"></script>
    <script src="<?=$raizProy?>js/plugins/pace/pace.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
				searching: false,
				ordering:  false,
				paging: false,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},
                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

        });
        
    </script>

	
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nuevo Gasto</h4>
      </div>
      <div class="modal-body form-group">
	  <table class="table-form">
			<tr>
				<td>No de documento:</td>
				<td><input type="text" name="gasto_no_documento" id="gasto_no_documento" /></td>
			</tr>
			<tr>
				<td>Fecha de vencimiento:</td>
				<td><input type="text" name="gasto_fecha_vencimiento" id="gasto_fecha_vencimiento" /></td>
			</tr>
			<tr>
				<td>Programar Recordatorio:</td>
				<td><input type="checkbox" name="gasto_fecha_recordatorio_si" id="gasto_fecha_recordatorio_si" /></td>
			</tr>
			<tr>
				<td>Fecha de recordatorio:</td>
				<td><input type="text" name="gasto_fecha_recordatorio" id="gasto_fecha_recordatorio" /></td>
			</tr>
			<tr>
				<td>Categoria:</td>
				<td><input type="text" name="gasto_categoria_id" id="gasto_categoria_id" /></td>
			</tr>
			<tr>
				<td>Concepto:</td>
				<td><input type="text" name="gasto_concepto" id="gasto_concepto" value=""></td>
			</tr>
			<tr>
				<td>Descripción:</td>
				<td><input type="text" name="gasto_descripcion" id="gasto_descripcion" value=""></td>
			</tr>
			<tr>
				<td>Monto:</td>
				<td><input type="text" name="gasto_monto" id="gasto_monto" value=""></td>
			</tr>
	  </table>
		 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button id="boton_crea_gasto" type="button" class="btn btn-primary" onclick="crea_gasto();">Guardar</button>
		<span id="span_crea_gasto"></span>
      </div>
    </div>
  </div>
</div>

<script>
function crea_gasto(){
	$("#boton_crea_gasto").addClass("disabled");
	$("#span_crea_gasto").addClass("glyphicon glyphicon-refresh glyphicon-refresh-animate");
	
	gasto_no_documento=$("#gasto_no_documento").val();
	gasto_fecha_vencimiento=$("#gasto_fecha_vencimiento").val();
	gasto_fecha_recordatorio_si=$("#gasto_fecha_recordatorio_si").val();
	gasto_fecha_recordatorio=$("#gasto_fecha_recordatorio" ).val();
	gasto_categoria_id=$("#gasto_categoria_id" ).val();
	gasto_concepto=$("#gasto_concepto").val();		
	gasto_descripcion=$("#gasto_descripcion").val();
	gasto_monto=$("#gasto_monto").val();
	gasto_status_id = '1';
	
	$.ajax({
		type: "GET",
		url: "ajax/crea_gasto.php",			
		data: {gasto_no_documento:gasto_no_documento,gasto_fecha_vencimiento:gasto_fecha_vencimiento,gasto_fecha_recordatorio_si:gasto_fecha_recordatorio_si,gasto_fecha_recordatorio:gasto_fecha_recordatorio,gasto_categoria_id:gasto_categoria_id,gasto_concepto:gasto_concepto,gasto_descripcion:gasto_descripcion,gasto_monto:gasto_monto,gasto_status_id:gasto_status_id},
		success: function(msg){
			//location.reload();
			//$("#myModal").modal('hide');
			//$("#boton_crea_gasto").removeClass().addClass("btn btn-primary");
			//$("#span_crea_gasto").removeClass();
		}		
	});
}
</script>

</body>

</html>