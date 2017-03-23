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
	
	var validar_direccion=function()
	{
		var bandera=false;
		
		if($("#calle").val()=='')
		{
			toastr.error('Debe de agregar una Calle');
			$("#calle").val('');
			$("#calle").focus();		
		}
		else if($("#noExt").val()=='')
		{
			toastr.error('Debe de agregar un No. Exterior');
			$("#noExt").val('');
			$("#noExt").focus();		
		}
		else if($("#colonia").val()=='')
		{
			toastr.error('Debe de agregar una Colonia');
			$("#colonia").val('');
			$("#colonia").focus();		
		}
		else if($("#codigoPostal").val()=='')
		{
			toastr.error('Debe de agregar un Codigo Postal');
			$("#codigoPostal").val('');
			$("#codigoPostal").focus();
		}
		else if($("#estado").val()=='')
		{
			toastr.error('Debe de agregar un Estado');
			$("#estado").val('');
			$("#estado").focus();
		}
		else if($("#municipio").val()=='')
		{
			toastr.error('Debe de agregar un Municipio');
			$("#municipio").val('');
			$("#municipio").focus();
		}
		else
		{
			bandera=true;
		}
		
		return bandera;
	};
	
	var clean_address=function()
	{
		$("#calle").val('');
		$("#noExt").val('');
		$("#noInt").val('');		
		$("#colonia").val('');
		$("#codigoPostal").val('');
		$("#estado").val('');
		$("#estado").val('').trigger("chosen:updated");
		$("#municipio").val('');
	};
	
	$("#limpiar").click(function()
	{
		clean_address();
	});
	
	$( "#agregar" ).click(function()
	{
		var validate=validar_direccion();
		var table='';
		
		if(validate)
		{
			var address=parseInt($("#address").val());
			var calle=$("#calle").val();
			var noExt=$("#noExt").val();
			var noInt=$("#noInt").val();		
			var colonia=$("#colonia").val();
			var codigoPostal=$("#codigoPostal").val();
			var estado=$("#estado").val();
			var municipio=$("#municipio").val();
			var addressComplete='';
			
			addressComplete+=calle+' '+noExt;
			
			if(noInt!='')
			{
				addressComplete+=' Int.'+noInt;
			}
			
			addressComplete+=' '+colonia;
			addressComplete+=' C.P.'+codigoPostal;
			addressComplete+=' '+municipio+', '+$("#estado option:selected").html();
			
			table+='<tr>';
			table+='<input type="hidden" id="address_'+address+'" name="address_'+address+'" value="'+address+'" class="address">';
			table+='<input type="hidden" id="calle_'+address+'" name="calle_'+address+'" value="'+calle+'">';
			table+='<input type="hidden" id="noExt_'+address+'" name="noExt_'+address+'" value="'+noExt+'">';
			table+='<input type="hidden" id="noInt_'+address+'" name="noInt_'+address+'" value="'+noInt+'">';
			table+='<input type="hidden" id="colonia_'+address+'" name="colonia_'+address+'" value="'+colonia+'">';
			table+='<input type="hidden" id="codigoPostal_'+address+'" name="codigoPostal_'+address+'" value="'+codigoPostal+'">';
			table+='<input type="hidden" id="estado_'+address+'" name="estado_'+address+'" value="'+estado+'">';
			table+='<input type="hidden" id="municipio_'+address+'" name="municipio_'+address+'" value="'+municipio+'">';
			table+='<td>'+addressComplete+'</td>';
			table+='<td class="text-left"><button class="btn btn-danger btn-xs deleteAddress" id="deleteA" value="" placeholder="Descuento" type="button"><i class="fa fa-times"></i></button></td>';
			table+='</tr>';
			
			$('#address_table').append(table);
			$("#address_list").show();
			
			$("#address").val(address+1);
			
			clean_address();
			
			$(".deleteAddress").click(function()
			{            
				$(this).parent().parent().remove();
				
				var address=parseInt($("#address").val());
				
				if(address>0)
				{
					address=address-1;
				}
				
				if(address==0)
				{
					$("#address_list").hide();
				}
				
				$("#address").val(address);
			});
		}
	});
	
	$(".deleteAddress").click(function()
	{            
		$(this).parent().parent().remove();
		
		var address=parseInt($("#address").val());
		
		if(address>0)
		{
			address=address-1;
		}
		
		if(address==0)
		{
			$("#address_list").hide();
		}
		
		$("#address").val(address);
	});
	
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
		var id_estado=$("#id_estado").val();
        $.each(result, function(i, field)
		{
        	if(field.id_estado==id_estado)
        	{
        		$("#estado").append('<option value="'+field.id_estado+'" selected>'+field.estado+'</option>');
        	}
        	else
        	{
        		$("#estado").append('<option value="'+field.id_estado+'" >'+field.estado+'</option>');
        	}
        });
        
        $('#estado').chosen();
    });

	$("#agregarTelefono").click(function(){
        $("#newPhone").append('<div class="form-group"><label class="col-sm-2 control-label"></label><div class="col-sm-3 "><input class="form-control telefono_cliente" id="telefono" name="telefono[]" value="" type="text" onkeypress="return validateNumber(event)"></div><div class="col-md-2">                                <select id="phoneType" name="phoneType[]" class="form-control"><option value="1">Celular</option><option value="2">Casa</option>                                    <option value="3">Oficina</option><option value="4">Otro</option>                                </select></div><div class="col-md-1"><button class="btn btn-danger btn-xs deletePhone" id="agregarTelefono" value="" placeholder="Telefono" type="button"><i class="fa fa-times"></i></button></div></div>');

        $(".deletePhone").click(function(){            
            $(this).parent().parent().remove();
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

	$("#agregarEmail").click(function(){
        $("#newEmail").append('<div class="form-group"><label class="col-sm-2 control-label"></label><div class="col-sm-5"><input class="form-control" id="email" name="email[]" value="" type="text"></div><div class="col-md-1"><button class="btn btn-danger btn-xs deleteEmail" id="agregarEmail" value="" placeholder="E-mail" type="button"><i class="fa fa-times"></i></button></div></div>');

        $(".deleteEmail").click(function(){   
        	console.log("ebtre");
            $(this).parent().parent().remove();
        });  
     });
	
	$(".deleteEmail").click(function(){   
        $(this).parent().parent().remove();
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