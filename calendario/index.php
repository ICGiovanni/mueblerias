<?php
session_start();
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once $pathProy.'/header.php';
require_once $pathProy.'/menu.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'calendario/models/class.Calendario.php');

$objCalendario = new Calendario();

?>
<link href="<?=$raizProy?>css/plugins/iCheck/custom.css" rel="stylesheet">
<link href="<?=$raizProy?>css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
<link href="<?=$raizProy?>css/plugins/fullcalendar/fullcalendar.print.css" rel='stylesheet' media='print'>
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
                        <p></p>
                        <div class='external-event navy-bg'>Go to shop and buy some products.</div>
                        <div class='external-event navy-bg'>Check the new CI from Corporation.</div>
                        <div class='external-event navy-bg'>Send documents to John.</div>
                        <div class='external-event navy-bg'>Phone to Sandra.</div>
                        <div class='external-event navy-bg'>Chat with Michael.</div>
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
<script src="<?=$raizProy?>js/plugins/fullcalendar/moment.min.js"></script>
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
<script src="<?=$raizProy?>js/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="<?=$raizProy?>js/plugins/fullcalendar/locale-all.js"></script>
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
                right: 'month,agendaWeek,agendaDay'
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
                {
                    title: 'All Day Event',
                    start: new Date(y, m, 1)
                },
                {
                    title: 'Long Event',
                    start: new Date(y, m, d-5),
                    end: new Date(y, m, d-2)
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d-3, 16, 0),
                    allDay: false
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d+4, 16, 0),
                    allDay: false
                },
                {
                    title: 'Meeting',
                    start: new Date(y, m, d, 10, 30),
                    allDay: false
                },
                {
                    title: 'Lunch',
                    start: new Date(y, m, d, 12, 0),
                    end: new Date(y, m, d, 14, 0),
                    allDay: false
                },
                {
                    title: 'Birthday Party',
                    start: new Date(y, m, d+1, 19, 0),
                    end: new Date(y, m, d+1, 22, 30),
                    allDay: false
                },
                {
                    title: 'Click for Google',
                    start: new Date(y, m, 28),
                    end: new Date(y, m, 29),
                    url: 'http://google.com/'
                }
            ]
        });

    });

</script>

</body>

</html>