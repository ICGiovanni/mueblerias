$(document).ready(function()
{
	toastr.options=
	{
		  "closeButton": true,
		  "debug": false,
		  "progressBar": true,
		  "preventDuplicates": false,
		  "positionClass": "toast-top-right",
		  "onclick": null,
		  "showDuration": "400",
		  "hideDuration": "1000",
		  "timeOut": "7000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
	}
	
	$("#guardar_corte_parcial").click(function()
	{
		$.ajax(
		{
			type: "POST",
			url: "cash_register.php?t=P",
	        success: function(data)
	        {
	        	swal({
	                title: "Guardado!",
	                text: "Corte de Caja guardado correctamente!",
	                type: "success"
	            }, function () {
	                window.location.href = 'corte_caja.php';
	            });
	        }
		});
	});
	
	$("#guardar_corte_final").click(function()
	{
		$.ajax(
		{
			type: "POST",
			url: "cash_register.php?t=F",
	        success: function(data)
	        {
	        	swal({
	                title: "Guardado!",
	                text: "Corte de Caja guardado correctamente!",
	                type: "success"
	            }, function () {
	                window.location.href = 'corte_caja.php';
	            });
	        }
		});
	});
	
	$('#montoInicial').on('shown.bs.modal', function ()
	{
	    $('#monto').focus();
	}) 
	
	$("#guardarMonto").click(function()
	{
		var mount=$("#monto").val();
		$.ajax(
		{
			type: "POST",
			url: "cash_register.php?t=M&m="+mount,
	        success: function(data)
	        {
	        	swal({
	                title: "Guardado!",
	                text: "Monto guardado correctamente!",
	                type: "success"
	            }, function ()
	            {
	            	$("#monto").val('');
	                //window.location.href = 'corte_caja.php';
	            });
	        }
		});
	});
	
	$(document).on('click', "a.deleteBoxCutPartial", function()
	{
		var id=$(this).attr('data-id');
		
		$.ajax(
		{
			type: "POST",
			url: "cash_register.php?t=DP&cp="+id,
	        success: function(data)
	        {
	        	swal({
	                title: "Eliminado!",
	                text: "Corte Parcial eliminado correctamente!",
	                type: "success"
	            }, function ()
	            {
	            	window.location.href = 'corte_caja.php';
	            });
	        }
		});
    });
	
	$(document).on('click', "a.deleteBoxCutFinal", function()
	{
		var id=$(this).attr('data-id');
		
		$.ajax(
		{
			type: "POST",
			url: "cash_register.php?t=DF&cf="+id,
	        success: function(data)
	        {
	        	swal({
	                title: "Eliminado!",
	                text: "Corte Final eliminado correctamente!",
	                type: "success"
	            }, function ()
	            {
	            	window.location.href = 'corte_caja.php';
	            });
	        }
		});
    });
});

function validateCantidad(evt)
{
	evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
	
	
    if ((charCode > 31 && (charCode < 48 || charCode > 57) && charCode!=46))
	{
        return false;
    }
}