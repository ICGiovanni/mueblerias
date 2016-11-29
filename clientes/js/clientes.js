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
	
	$("#nombre").focus();

	$( "#guardar" ).click(function()
	{
		var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;

		if($("#nombre").val()=='')
		{
			toastr.error('Debe de agregar un Nombre');
			$("#nombre").val('');
			$("#nombre").focus();		
		}
		else if($("#apellidoP").val()=='')
		{
			toastr.error('Debe de agregar un Apellido Paterno');
			$("#apellidoP").val('');
			$("#apellidoP").focus();		
		}
		else if($("#apellidoM").val()=='')
		{
			toastr.error('Debe de agregar un Apellido Materno');
			$("#apellidoM").val('');
			$("#apellidoM").focus();		
		}
		else if($("#telefono").val()=='')
		{
			toastr.error('Debe de agregar un Telefono');
			$("#telefono").val('');
			$("#telefono").focus();
		}
		else if(!email_regex.test($("#email").val()))
		{
			toastr.error('Debe de agregar un E-mail valido');
			$("#email").val('');
			$("#email").focus();
		}
		else
		{
			var url="guardar_cliente.php";
			 
			$.ajax(
			{
		    	type: "POST",
		        url: url,
		        data: $("#form_cliente").serialize(), // serializes the form's elements.
		        success: function(data)
		        {
		        	alert("El Cliente ha sido registrado"); // show response from the php script.
		        	var url="index.php";
		    		$(location).attr("href", url);
				}
			});

			
		}
	});
	
	$( "#cancelar" ).click(function()
	{
		var url="index.php";
		$(location).attr("href", url);
	});

	$.getJSON("states_json.php",function(result)
	{
        $.each(result, function(i, field)
		{
        	$("#estado").append('<option value="'+field.id_estado+'" >'+field.estado+'</option>');
        });
    });

	$("#agregarTelefono").click(function(){
        $("#newPhone").append('<div class="form-group"><label class="col-sm-2 control-label"></label><div class="col-sm-3 "><input class="form-control" id="telefono" name="telefono[]" value="" type="text"></div><div class="col-md-2">                                <select id="phoneType" name="phoneType[]" class="form-control"><option value="1">Celular</option><option value="2">Casa</option>                                    <option value="3">Oficina</option><option value="4">Otro</option>                                </select></div><div class="col-md-1"><button class="btn btn-danger btn-xs deletePhone" id="agregarTelefono" value="" placeholder="Telefono" type="button"><i class="fa fa-times"></i></button></div></div>');

        $(".deletePhone").click(function(){            
            $(this).parent().parent().remove();
        });  
     });

	$("#agregarEmail").click(function(){
        $("#newEmail").append('<div class="form-group"><label class="col-sm-2 control-label"></label><div class="col-sm-3 "><input class="form-control" id="email" name="email[]" value="" type="text"></div><div class="col-md-1"><button class="btn btn-danger btn-xs deleteEmail" id="agregarEmail" value="" placeholder="E-mail" type="button"><i class="fa fa-times"></i></button></div></div>');

        $(".deleteEmail").click(function(){            
            $(this).parent().parent().remove();
        });  
     });
	
});