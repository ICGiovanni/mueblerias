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
});