<?php
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once $pathProy.'/header.php';
require_once $pathProy.'/menu.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'gastos/models/class.Gastos.php');

$objGasto = new Gasto();
$rows = $objGasto->getGastos();
$rowsGastosCategoria = $objGasto->getGastosCategoria();
$rowsGastosStatus = $objGasto->getGastosStatus();


$asoccGastoCategoria = array();
while(list(,$dataGastoCategoria) = each($rowsGastosCategoria)){
	$asoccGastoCategoria[$dataGastoCategoria["gasto_categoria_id"]]=$dataGastoCategoria["gasto_categoria_desc"];	
}

$asoccGastoStatus = array();
while(list(,$dataGastoStatus) = each($rowsGastosStatus)){
	$asoccGastoStatus[$dataGastoStatus["gasto_status_id"]]=$dataGastoStatus["gasto_status_desc"];	
}

//print_r($rows);
$html_rows = '';


while(list(,$dataGasto) = each($rows)){
	$suma_pagos = 0;
	$dataGasto["gasto_saldo"]=$dataGasto["gasto_monto"] - $suma_pagos;
	$html_rows.= '<tr>
		<td>'.$dataGasto["gasto_no_documento"].'</td>
		<td>'.$dataGasto["gasto_fecha_vencimiento"].'</td>
		<td>'.$asoccGastoCategoria[$dataGasto["gasto_categoria_id"]].'</td>
		<td>'.$dataGasto["gasto_concepto"].'</td>
		<td>$'.number_format($dataGasto["gasto_monto"],2).'</td>
		<td>'.number_format($dataGasto["gasto_saldo"],2).'</td>
		<td>'.$asoccGastoStatus[$dataGasto["gasto_status_id"]].'</td>
		<td align="center"><a href="editar/?gasto_id='.$dataGasto["gasto_id"].'"><i class="fa fa-edit"></i></a> &nbsp;<i class="fa fa-trash"></i></td>
	</tr>';
}



?>
<!-- Data picker -->
<link href="<?=$raizProy?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="<?=$raizProy?>css/plugins/clockpicker/clockpicker.css" rel="stylesheet">


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
							
                            <button type="button" class="btn btn-primary btn-xs"  onclick="location.href = 'nuevo/';" >+ Nuevo Gasto</button>
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
						<th style="text-align:center;">Acción</th>
						
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
						<th style="text-align:center;">Acción</th>
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
	

	<script src="<?=$raizProy?>js/plugins/datapicker/bootstrap-datepicker.js"></script>
	<script src="<?=$raizProy?>js/plugins/datapicker/bootstrap-datepicker.es.js"></script>
	<script src="<?=$raizProy?>js/plugins/clockpicker/clockpicker.js"></script>

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
				"language": {
					"lengthMenu": "Display _MENU_ records per page",
					"zeroRecords": "Nothing found - sorry",
					"info": "Mostrando _MAX_ entradas",
					"infoEmpty": "No records available",
					"infoFiltered": "(filtered from _MAX_ total records)"
				},
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
	
     $.fn.datepicker.defaults.language = 'es';
	 $('.clockpicker').clockpicker();
});
</script>

</body>

</html>