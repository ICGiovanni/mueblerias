<?php
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'login/session.php');
require_once $pathProy.'/header2.php';
require_once $pathProy.'/menu.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'calendario/models/class.Calendario.php');

$objCalendario = new Calendario();
$rowEventos = $objCalendario->getEventos($_SESSION["login_session"]["login_id"]);
$jsonEventos = array();
$proximos = array();

while(list(,$dataEventos) = each($rowEventos)){
	list($evento_fecha, $evento_hora) = explode(" ",$dataEventos["evento_fecha"]);
	list($evento_fecha_ano, $evento_fecha_mes, $evento_fecha_dia) = explode("-",$evento_fecha);
	list($evento_hora_hora, $evento_hora_minuto, $evento_hora_segundo) = explode(":",$evento_hora);
	$jsonEventos[]="{                    
				title: '".$dataEventos["evento_nombre"]."',
				start: new Date(".$evento_fecha_ano.", ".(intval($evento_fecha_mes)-1).", ".$evento_fecha_dia.", ".$evento_hora_hora.", ".$evento_hora_minuto."),
				allDay: false,
				url: 'editar/?evento_id=".$dataEventos["evento_id"]."'
			}";
	if( $evento_fecha_dia == date("d") ){
		$proximos[]="<div class='external-event navy-bg'><a href='editar/?evento_id=".$dataEventos["evento_id"]."' style='color:#FFF;'>".$evento_hora_hora.":".$evento_hora_minuto." ".$dataEventos["evento_nombre"]."</a></div>";
	}
}
?>
<link href="<?=$raizProy?>css/plugins/iCheck/custom.css" rel="stylesheet">
<link href="<?=$raizProy?>css/plugins/fullcalendar/fullcalendar-3.0.1.css" rel="stylesheet">
<link href="<?=$raizProy?>css/plugins/fullcalendar/fullcalendar.print-3.0.1.css" rel='stylesheet' media='print'>
<link href="<?=$raizProy?>css/style.css" rel="stylesheet">

<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-4">
		<h2>Calendario</h2>
		<ol class="breadcrumb">
			<li>
				<a href="">Calendario</a>
			</li>
		</ol>
	</div>
	<div class="col-sm-8">
		<div class="title-action">
			<button type="button" class="btn btn-primary btn-xs"  onclick="location.href = 'nuevo/';" >
			+ Nuevo Evento
			</button>
		</div>
	</div>
</div>

<div class="wrapper wrapper-content">
    <div class="row animated fadeInDown">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Eventos próximos</h5>
                </div>
                <div class="ibox-content">
                    <div id='external-events'>
                        <!-- <p></p> -->
                        <?=implode("",$proximos)?>
                        <p class="m-t">
                            <!-- <input type='checkbox' id='drop-remove' class="i-checks" checked /> <label for='drop-remove'>remove after drop</label> -->
                        </p>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-lg-9">
            <div class="ibox float-e-margins">                
                <div class="ibox-content">
					<!--calendario-->
                    <div id="calendar"></div>
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
<script src="<?=$raizProy?>js/plugins/fullcalendar/moment-2.14.1.min.js"></script>
<script src="<?=$raizProy?>js/jquery-3.1.0.js"></script>
<script src="<?=$raizProy?>js/bootstrap-3.3.7.min.js"></script>
<script src="<?=$raizProy?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?=$raizProy?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?=$raizProy?>js/inspinia.js"></script>
<script src="<?=$raizProy?>js/plugins/pace/pace.min.js"></script>

<!-- jQuery UI custom -->
<script src="<?=$raizProy?>js/jquery-ui.custom.min.js"></script>

<!-- iCheck -->
<script src="<?=$raizProy?>js/plugins/iCheck/icheck.min.js"></script>

<!-- Full Calendar -->
<script src="<?=$raizProy?>js/plugins/fullcalendar/fullcalendar-3.0.1.min.js"></script>
<script src="<?=$raizProy?>js/plugins/fullcalendar/es.js"></script>
<script>

	$(document).ready(function() {
		
		

        $('#external-events div.external-event').each(function() {

        });


        /* initialize the calendar
         -----------------------------------------------------------------*/
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
		
		var initialLocaleCode = 'es';

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listMonth'
            },
			locale: initialLocaleCode,
            editable: false,
            droppable: false, // this allows things to be dropped onto the calendar
            drop: function() {
				/*
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }*/
            },
            events: [
               <?=implode(",",$jsonEventos)?>
            ]
        });

    });

</script>

</body>

</html>