$(document).ready(function()
{
	//$('.phone').chosen();
	$("#limpiar_estado").hide();
	$('#tipo_datos').chosen();
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

	$("#estado").change(function()
	{
		$("#limpiar_estado").show();
	});
	
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
		var tipo_datos=$("#tipo_datos").val();
		
		if(tipo_datos=='facturacion' && $("#razonS").val()=='')
		{
			toastr.error('Debe de agregar una Razón Social');
			$("#razonS").val('');
			$("#razonS").focus();	
		}
		else if(tipo_datos=='facturacion' && $("#rfc").val()=='')
		{
			toastr.error('Debe de agregar un RFC');
			$("#rfc").val('');
			$("#rfc").focus();	
		}
		else if($("#calle").val()=='')
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
		$("#tipo_datos").val('facturacion').trigger('chosen:updated');
		$("#div_facturacion").show();
		$("#razonS").val('');
		$("#rfc").val('');
		$("#calle").val('');
		$("#noExt").val('');
		$("#noInt").val('');		
		$("#colonia").val('');
		$("#codigoPostal").val('');
		$("#estado").val('');
		$("#estado").val('').trigger("chosen:updated");
		$("#municipio").val('');
	};
	
	var edit_address=function(id)
	{	
		$("#tipo_datos").val($("#tipo_datos_"+id).val()).trigger('chosen:updated');
		if($("#tipo_datos_"+id).val()=='facturacion')
		{
			$("#div_facturacion").show();
		}
		else
		{
			$("#div_facturacion").hide();
		}
		
		$("#razonS").val($("#razonS_"+id).val());
		$("#rfc").val($("#rfc_"+id).val());
		$("#calle").val($("#calle_"+id).val());
		$("#noExt").val($("#noExt_"+id).val());
		$("#noInt").val($("#noInt_"+id).val());		
		$("#colonia").val($("#colonia_"+id).val());
		$("#codigoPostal").val($("#codigoPostal_"+id).val());
		$("#estado").val($("#estado_"+id).val()).trigger('chosen:updated');
		$("#municipio").val($("#municipio_"+id).val());
		$("#address_current").val(id);
		$("#addAddress").hide();
		$("#aditAddress").show();
	};
	
	$("#limpiar_address").click(function()
	{
		clean_address();
	});
	
	$("#tipo_datos").change(function()
	{
		var tipo_datos=$(this).val();
		
		if(tipo_datos=='facturacion')
		{
			$("#div_facturacion").show();
		}
		else if(tipo_datos=='envio')
		{
			$("#div_facturacion").hide();
		}
		
		$("#razonS").val('');
		$("#rfc").val('');
		
	});	
	
	$("#limpiar_estado").click(function()
	{
		$("#estado").val('').trigger('chosen:updated');
		$("#limpiar_estado").hide();
	});
		
	$("#aditAddress").click(function()
	{
		var validate=validar_direccion();
		
		if(validate)
		{
			var address=$("#address_current").val();
			var tipo_datos=$("#tipo_datos").val();
			var razonS=$("#razonS").val();
			var rfc=$("#rfc").val();
			var calle=$("#calle").val();
			var noExt=$("#noExt").val();
			var noInt=$("#noInt").val();		
			var colonia=$("#colonia").val();
			var codigoPostal=$("#codigoPostal").val();
			var estado=$("#estado").val();
			var municipio=$("#municipio").val();
			var addressComplete='';
			
			if(tipo_datos=='facturacion')
			{
				tipo_datos='Facturación';
				addressComplete+='RFC: '+rfc+' '+razonS+' ';
			}
			else
			{
				tipo_datos='Envio';
				razonS='';
				rfc='';
			}
			
			addressComplete+=calle+' '+noExt;
			
			if(noInt!='')
			{
				addressComplete+=' Int.'+noInt;
			}
			
			addressComplete+=' '+colonia;
			addressComplete+=' C.P.'+codigoPostal;
			addressComplete+=' '+municipio+', '+$("#estado option:selected").html();
			
			$("#addres_div_"+address).html(addressComplete);
			$("#addres_tipo_"+address).html(tipo_datos);
			$("#tipo_datos_"+address).val($("#tipo_datos").val());
			$("#razonS_"+address).val(razonS);
			$("#rfc_"+address).val(rfc);
			$("#calle_"+address).val(calle);
			$("#noExt_"+address).val(noExt);
			$("#noInt_"+address).val(noInt);		
			$("#colonia_"+address).val(colonia);
			$("#codigoPostal_"+address).val(codigoPostal);
			$("#estado_"+address).val(estado);
			$("#municipio_"+address).val(municipio);
			
			$("#addAddress").show();
			$("#aditAddress").hide();
			
			clean_address();
		}
	});
	
	$( "#addAddress" ).click(function()
	{
		var validate=validar_direccion();
		var table='';
		
		if(validate)
		{
			var address=parseInt($("#address").val());
			var tipo_datos=$("#tipo_datos").val();
			var razonS=$("#razonS").val();
			var rfc=$("#rfc").val();
			var calle=$("#calle").val();
			var noExt=$("#noExt").val();
			var noInt=$("#noInt").val();		
			var colonia=$("#colonia").val();
			var codigoPostal=$("#codigoPostal").val();
			var estado=$("#estado").val();
			var municipio=$("#municipio").val();
			var addressComplete='';
			
			if(tipo_datos=='facturacion')
			{
				tipo_datos='Facturación';
				addressComplete+='RFC: '+rfc+' '+razonS+' ';
			}
			else
			{
				tipo_datos='Envio';
			}
			
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
			table+='<input type="hidden" id="tipo_datos_'+address+'" name="tipo_datos_'+address+'" value="'+$("#tipo_datos").val()+'">';
			table+='<input type="hidden" id="razonS_'+address+'" name="razonS_'+address+'" value="'+razonS+'">';
			table+='<input type="hidden" id="rfc_'+address+'" name="rfc_'+address+'" value="'+rfc+'">';
			table+='<input type="hidden" id="calle_'+address+'" name="calle_'+address+'" value="'+calle+'">';
			table+='<input type="hidden" id="noExt_'+address+'" name="noExt_'+address+'" value="'+noExt+'">';
			table+='<input type="hidden" id="noInt_'+address+'" name="noInt_'+address+'" value="'+noInt+'">';
			table+='<input type="hidden" id="colonia_'+address+'" name="colonia_'+address+'" value="'+colonia+'">';
			table+='<input type="hidden" id="codigoPostal_'+address+'" name="codigoPostal_'+address+'" value="'+codigoPostal+'">';
			table+='<input type="hidden" id="estado_'+address+'" name="estado_'+address+'" value="'+estado+'">';
			table+='<input type="hidden" id="municipio_'+address+'" name="municipio_'+address+'" value="'+municipio+'">';
			table+='<td><div id="addres_tipo_'+address+'">'+tipo_datos+'</div></td>';
			table+='<td><div id="addres_div_'+address+'">'+addressComplete+'</div></td>';
			//table+='<td class="text-left"><button class="btn btn-primary btn-xs editAddress" id="editA" value="" placeholder="" type="button" id-num="'+address+'"><i class="fa fa-pencil"></i></button>  ';
			table+='<td class="text-left"><div class="infont col-md-1 col-sm-1"><a href="#" title="Editar" id-num="'+address+'" class="editAddress"><i class="fa fa-pencil editAddress"></i></a></div><div class="infont col-md-1 col-sm-1"><a href="#" title="Borrar" class="deleteAddress"><i class="fa fa-trash-o"></i></a></div></td>';
			//table+='<button class="btn btn-danger btn-xs deleteAddress" id="deleteA" value="" placeholder="" type="button"><i class="fa fa-trash-o"></i></button></td>';
			table+='</tr>';
			
			$('#address_table').append(table);
			$("#address_list").show();
			
			$("#address").val(address+1);
			
			clean_address();
			
			$(".deleteAddress").on("click", function ()
			{            
				var bandera=false;
				
				$(this).parent().parent().parent().remove();
				
				$('#address_table > tr').each(function()
				{
					bandera=true;
				});
				
				if(!bandera)
				{
					$("#address_list").hide();
				}
			});
			
			$('.editAddress').on("click", function ()
			{
				var id = $(this).attr('id-num');
				edit_address(id);
			});
			
			/*$(".editAddress").on("click", function () {on("click", function ()
			{            
				 var id = $(this).attr('id-num');
				 alert("ddddd");
				 edit_address(id);
			});*/
		}
	});
	
	$(".editAddress a").click(function()
	{            
		 var id = $(this).attr('id-num');
		 
		 edit_address(id);
	});
	
	$(".deleteAddress").click(function()
	{            
		var bandera=false;
		
		$(this).parent().parent().remove();
		
		$('#address_table > tr').each(function()
		{
			bandera=true;
		});
		
		if(!bandera)
		{
			$("#address_list").hide();
		}
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
		        	var idCliente=data;
		        	var banderaAddress=false;
		        	var addressArray=new Array();
		        	
		        	$(".editAddress").each(function (index) 
        	        { 
		        		banderaAddress=true;
		        		var a={};
        				var id = $(this).attr('id-num');
        				var tipo="";
        				
        				if($("#tipo_datos_"+id).val()=='facturacion')
    					{
        					tipo=1;
    					}
        				else
        				{
        					tipo=2;
        				}
        				
        				a.tipo=tipo;
        				a.razonS=$("#razonS_"+id).val();
        				a.rfc=$("#rfc_"+id).val();
        				a.calle=$("#calle_"+id).val();
        				a.noExt=$("#noExt_"+id).val();
        				a.noInt=$("#noInt_"+id).val();
        				a.colonia=$("#colonia_"+id).val();
        				a.codigoPostal=$("#codigoPostal_"+id).val();
        				a.estado=$("#estado_"+id).val();
        				a.municipio=$("#municipio_"+id).val();
        				a.referencia='';
        				
        				addressArray.push(a);
        	        });
		        	
		        	if(!banderaAddress)
		        	{
		        		swal({
			                title: "Guardado!",
			                text: "Cliente guardado correctamente!",
			                type: "success"
			            }, function () {
			                window.location.href = 'index.php';
			            });
		        	}
		        	else
		        	{
		        		var jsonAddress=JSON.stringify(addressArray);
		        		
		        		$.ajax
						({
							type: "POST",
							url: "sava_data_clients.php?id="+idCliente,
							data: jsonAddress,
							contentType: "application/json; charset=utf-8",
							dataType: "json",
							complete: function(data)
							{
								swal({
					                title: "Guardado!",
					                text: "Cliente guardado correctamente!",
					                type: "success"
					            }, function () {
					                window.location.href = 'index.php';
					            });
							},
							failure: function(errMsg)
							{
								alert(errMsg);
							}
						});
		        		
		        	}
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
        $("#newPhone").append('<div class="form-group"><label class="col-sm-2 control-label"></label><div class="col-sm-3 "><input class="form-control telefono_cliente" id="telefono" name="telefono[]" value="" type="text" onkeypress="return validateNumber(event)"></div><div class="col-md-2">                                <select id="phoneType" name="phoneType[]" class="form-control chosen-select phone" ><option value="1">Celular</option><option value="2">Casa</option>                                    <option value="3">Oficina</option><option value="4">Otro</option>                                </select></div><div class="col-md-1"><button class="btn btn-danger btn-xs deletePhone" id="agregarTelefono" value="" placeholder="Telefono" type="button"><i class="fa fa-times"></i></button></div></div>');

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
        
        $('.phoneType').chosen();
        $('.phoneType').trigger("chosen:updated");
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
