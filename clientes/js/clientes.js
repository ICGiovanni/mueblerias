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

	var validate_form=function()
	{
		var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
		var bandera=false;

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
			bandera=true;
		}
		
		return bandera;
	};
	
	$( "#guardar" ).click(function()
	{
		var validate=validate_form();
		
		if(validate)
		{
			var url="guardar_cliente.php";
			 
			$.ajax(
			{
		    	type: "POST",
		        url: url,
		        data: $("#form_cliente").serialize(), // serializes the form's elements.
		        success: function(data)
		        {
		    		swal({
		                title: "Guardado!",
		                text: "Cliente guardado correctamente!",
		                type: "success"
		            }, function () {
		                window.location.href = 'index.php';
		            });
				}
			});
		}
	});
	
	$( "#editar" ).click(function()
	{
		var validate=validate_form();
		
		if(validate)
		{
			var url="actualizar_cliente.php";
			
			$.ajax(
			{
				type: "POST",
				url: url,
				data: $("#form_cliente").serialize(), // serializes the form's elements.
				success: function(data)
				{
					swal({
		                title: "Guardado!",
		                text: "Cliente actualizado correctamente!",
		                type: "success"
		            }, function () {
		                window.location.href = 'index.php';
		            });
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
        $("#newPhone").append('<div class="form-group"><label class="col-sm-2 control-label"></label><div class="col-sm-3 "><input class="form-control" id="telefono" name="telefono[]" value="" type="text" onkeypress="return validateNumber(event)"></div><div class="col-md-2">                                <select id="phoneType" name="phoneType[]" class="form-control"><option value="1">Celular</option><option value="2">Casa</option>                                    <option value="3">Oficina</option><option value="4">Otro</option>                                </select></div><div class="col-md-1"><button class="btn btn-danger btn-xs deletePhone" id="agregarTelefono" value="" placeholder="Telefono" type="button"><i class="fa fa-times"></i></button></div></div>');

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
	
	$(".telefono_cliente").keyup(function(event)
	{
		if(event.which!=8)
		{
			var str=$(this).val();
			str=str.replace(/\s+/g,"");
			
			var j=0;
			var cad="";
			for(var i=0; i<str.length;i++)
			{
				var caracter=str.charAt(i);
				
				if(j==1)
				{
					cad+=caracter+' ';
					j=0;
				}
				else
				{
					cad+=caracter;
					j++;
				}
			}
			
			$(this).val(cad);
		}
	});
	
});

function validateNumber(evt)
{
	evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
}