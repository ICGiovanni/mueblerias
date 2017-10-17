$(document).ready(function()
{
	var loadimg=function()
	{
		var id_producto=$("#id_producto").val();	
		
		$.getJSON("images.php?t=g&id="+id_producto,function(result)
		{
			var img='<div id="blueimp-gallery" class="blueimp-gallery">	            <div class="slides"></div><h3 class="title"></h3><a class="prev">Prev.</a>	            <a class="next">Sig.</a><a class="close">x</a><a class="play-pause"></a>	            <ol class="indicator"></ol></div>';
			
	        $.each(result, function(i, field)
			{
	    		img+='<div class="infont col-md-3 col-sm-4"><a data-gallery="" title="Image from Unsplash" href="'+field.imagen_route+'"><img src="'+field.imagen_route+'" width="75" height="75"></a><a href="#" data-img="'+field.imagen_id+'" class="img_delete"><i class="fa fa-trash-o"></i></a></div>';
	        	
	        });
	        
        	$("#gallery").html(img);

	    });
	}
	
	loadimg();
	
	$(document).on('click', "a.img_delete", function()
			{
				var r=confirm("\u00BFDesea continuar?");

		    	if(r==true)
		    	{
					var id_img=$(this).attr('data-img');
					var id_producto=$("#id_producto").val();

					$.ajax
					({
						type: "POST",
						url: "images.php",
						data: {t:'d',id:id_producto,id_i:id_img},
						dataType: "text/html",
						complete: function(data)
						{
							loadimg();
						},
						failure: function(errMsg)
						{
							alert(errMsg);
						}
					});
		    	}
			});
	
	$('.add_more').click(function(e){
        e.preventDefault();
        $("#newImage").append('<div class="form-group"><label class="col-sm-2 control-label"></label><div class="col-sm-4" ><input name="upload[]" type="file" id="upload" accept="image/*"/></div><div class="col-sm-2"><button class="btn btn-danger btn-xs delete_img" id="agregarEmail" value="" placeholder="E-mail" type="button"><i class="fa fa-times"></i></button></div></div>');
        
        $(".delete_img").click(function(){            
        	$(this).parent().parent().remove();
        });  
    });
    
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
		var tipo_producto=$("#tipo_producto").val();
		var bandera=false;
		
    	$.each($('.products'), function (index, value)
    	{
    		var id=$(value).val();
    		bandera=true;
    	});	

    	var banderaV=false;
    	$.each($('.products_variante'), function (index, value)
		{
    		var id=$(value).val();
    		banderaV=true;
    	});	
		
		if($("#sku").val()=='')
		{
			toastr.error('Debe de agregar el SKU del producto');
			$("#sku").val('');
			$("#sku").focus();		
		}
		else if($("#nombre").val()=='')
		{
			toastr.error('Debe de agregar un Nombre');
			$("#nombre").val('');
			$("#nombre").focus();		
		}
		else if($("#descripcion").val()=='' && (tipo_producto=='U' || tipo_producto=='P'))
		{
			toastr.error('Debe de agregar una breve Descripci\u00F3n');
			$("#descripcion").val('');
			$("#descripcion").focus();
		}
		else if($("#color").val()=='' && (tipo_producto=='U' || tipo_producto=='V'))
		{
			toastr.error('Debe de agregar un Color');
			$("#color").val('');
			$("#color").focus();		
		}
		else if($("#material").val()=='' && (tipo_producto=='U' || tipo_producto=='V'))
		{
			toastr.error('Debe de agregar un tipo de Material');
			$("#material").val('');
			$("#material").focus();		
		}
		else if($("#categoria").val()=='' && (tipo_producto=='U' || tipo_producto=='P'))
		{
			toastr.error('Debe de agregar un tipo de Categoria');
			$("#categoria").val('');
			$("#categoria").focus();		
		}
		else if($("#proveedor").val()=='')
		{
			toastr.error('Debe de agregar un Proveedor');
			$("#proveedor").val('');
			$("#proveedor").focus();
		}
		else if($("#precioU").val()=='' && (tipo_producto=='U' || tipo_producto=='V'))
		{
			toastr.error('Debe de agregar el Precio Utilitario del producto');
			$("#precioU").val('');
			$("#precioU").focus();		
		}
		else if($("#precioP").val()=='' && (tipo_producto=='U' || tipo_producto=='V'))
		{
			toastr.error('Debe de agregar el Precio P\u00FAblico');
			$("#precioU").val('');
			$("#precioU").focus();		
		}
		else if($("#minimoA").val()=='' && (tipo_producto=='U' || tipo_producto=='V'))
		{
			toastr.error('Debe de agregar el Mínimo en almacen');
			$("#minimoA").val('');
			$("#minimoA").focus();		
		}
		else if($("#maximoA").val()=='' && (tipo_producto=='U' || tipo_producto=='V'))
		{
			toastr.error('Debe de agregar el Maximo en almacen');
			$("#maximoA").val('');
			$("#maximoA").focus();		
		}
		else if($('#conjunto').is(":checked") && bandera==false)
        {
			toastr.error('Debe de agregar un producto para armar el Conjunto');
			$("#producto").val('');
			$("#producto").focus();
        }
		else if(tipo_producto=='V' && $("#producto_padre_id").val()==0)
		{
			toastr.error('Debe de agregar un producto padre para la variación');
			$("#producto_padre").val('');
			$("#producto_padre").focus();
		}
		else if(tipo_producto=='P' && banderaV==false)
		{
			toastr.error('Debe de agregar un producto para armar el Producto Principal');
			$("#productoV").val('');
			$("#productoV").focus();
		}
		else
		{
			var url="guardar_producto.php";
	
			var formData = new FormData($("#form_productos")[0]);
	
		    $.ajax({
		        url: url,
		        type: 'POST',
		        data: formData,
		        async: false,
		        success: function (data)
		        {
			        var producto_id=data;
			        if($('#conjunto').is(":checked"))
			        {
				        var url="guardar_conjunto.php?id="+producto_id;
				        var products=new Array();
				        
				        $.each($('.products'), function (index, value)
		            	{
				        	var p={};
				        	var id=$(value).val();
				        	var cantidad=$("#cantidad_"+id).val();
				        	p.id=id;
				        	p.cantidad=cantidad;
				        	products.push(p);
		            	});	

				        var jsonProducts=JSON.stringify(products);
				        
			        	$.ajax({
					        url: url,
					        type: 'POST',
					        data:  jsonProducts,
					        contentType: "application/json; charset=utf-8",
					        async: false,
					        dataType: "json",
					        success: function (data)
					        {
					        	if(tipo_producto!='P')
						        {
					        		swal({
						                title: "Guardado!",
						                text: "Producto guardado correctamente!",
						                type: "success"
						            }, function () {
						                window.location.href = 'index.php';
						            });
						        }
					        },
					        cache: false,
					        contentType: false,
					        processData: false
					    });
			        }
			        else if(tipo_producto!='P')
			        {
			        	swal({
			                title: "Guardado!",
			                text: "Producto guardado correctamente!",
			                type: "success"
			            }, function () {
			                window.location.href = 'index.php';
			            });
			        }

			        if(tipo_producto=='P')
			        {
			        	var url="guardar_variantes.php?id="+producto_id;
				        var products=new Array();
				        
				        $.each($('.products_variante'), function (index, value)
		            	{
				        	var p={};
				        	var id=$(value).val();
				        	p.id=id;
				        	products.push(p);
		            	});	

				        var jsonProducts=JSON.stringify(products);
				        
			        	$.ajax({
					        url: url,
					        type: 'POST',
					        data:  jsonProducts,
					        contentType: "application/json; charset=utf-8",
					        async: false,
					        dataType: "json",
					        success: function (data)
					        {
					        	swal({
					                title: "Guardado!",
					                text: "Producto guardado correctamente!",
					                type: "success"
					            }, function () {
					                window.location.href = 'index.php';
					            });
					        },
					        cache: false,
					        contentType: false,
					        processData: false
					    });
			        }
		            
		        },
		        cache: false,
		        contentType: false,
		        processData: false
		    });
		}
		
	});
	
	$( "#editar" ).click(function()
	{
		var tipo_producto=$("#tipo_producto").val();
		var bandera=false;
		var producto_id=$("#id_producto").val();
		
    	$.each($('.products'), function (index, value)
    	{
    		var id=$(value).val();
    		bandera=true;
    	});	

    	var banderaV=false;
    	$.each($('.products_variante'), function (index, value)
		{
    		var id=$(value).val();
    		banderaV=true;
    	});	
		
		if($("#sku").val()=='')
		{
			toastr.error('Debe de agregar el SKU del producto');
			$("#sku").val('');
			$("#sku").focus();		
		}
		else if($("#nombre").val()=='')
		{
			toastr.error('Debe de agregar un Nombre');
			$("#nombre").val('');
			$("#nombre").focus();		
		}
		else if($("#descripcion").val()=='' && (tipo_producto=='U' || tipo_producto=='P'))
		{
			toastr.error('Debe de agregar una breve Descripci\u00F3n');
			$("#descripcion").val('');
			$("#descripcion").focus();
		}
		else if($("#color").val()==undefined && (tipo_producto=='U' || tipo_producto=='V'))
		{
			toastr.error('Debe de agregar un Color');
			$("#color").val('');
			$("#color").focus();		
		}
		else if($("#version").val()==undefined && (tipo_producto=='U' || tipo_producto=='V'))
		{
			toastr.error('Debe de agregar una Versión');
			$("#version").val('');
			$("#version").focus();		
		}
		else if($("#material").val()==undefined && (tipo_producto=='U' || tipo_producto=='V'))
		{
			toastr.error('Debe de agregar un tipo de Material');
			$("#material").val('');
			$("#material").focus();		
		}
		else if($("#categoria").val()==undefined && (tipo_producto=='U' || tipo_producto=='P'))
		{
			toastr.error('Debe de agregar un tipo de Categoria');
			$("#categoria").val('');
			$("#categoria").focus();		
		}
		else if($("#proveedor").val()=='')
		{
			toastr.error('Debe de agregar un Proveedor');
			$("#proveedor").val('');
			$("#proveedor").focus();
		}
		else if($("#precioU").val()=='' && (tipo_producto=='U' || tipo_producto=='V'))
		{
			toastr.error('Debe de agregar el Precio Utilitario del producto');
			$("#precioU").val('');
			$("#precioU").focus();		
		}
		else if($("#precioP").val()=='' && (tipo_producto=='U' || tipo_producto=='V'))
		{
			toastr.error('Debe de agregar el Precio P\u00FAblico');
			$("#precioU").val('');
			$("#precioU").focus();		
		}
		else if($("#minimoA").val()=='' && (tipo_producto=='U' || tipo_producto=='V'))
		{
			toastr.error('Debe de agregar el Mínimo en almacen');
			$("#minimoA").val('');
			$("#minimoA").focus();		
		}
		else if($("#maximoA").val()=='' && (tipo_producto=='U' || tipo_producto=='V'))
		{
			toastr.error('Debe de agregar el Maximo en almacen');
			$("#maximoA").val('');
			$("#maximoA").focus();		
		}
		else if($('#conjunto').is(":checked") && bandera==false)
        {
			toastr.error('Debe de agregar un producto para armar el Conjunto');
			$("#producto").val('');
			$("#producto").focus();
        }
		else if(tipo_producto=='V' && $("#producto_padre_id").val()==0)
		{
			toastr.error('Debe de agregar un producto padre para la variación');
			$("#producto_padre").val('');
			$("#producto_padre").focus();
		}
		else if(tipo_producto=='P' && banderaV==false)
		{
			toastr.error('Debe de agregar un producto para armar el Producto Principal');
			$("#productoV").val('');
			$("#productoV").focus();
		}
				else
				{
					var url="actualizar_producto.php";
			
					var formData = new FormData($("#form_productos")[0]);
			
				    $.ajax({
				        url: url,
				        type: 'POST',
				        data: formData,
				        async: false,
				        success: function (data)
				        {
				        	var producto_id=$("#id_producto").val();
				        	
					        if($('#conjunto').is(":checked"))
					        {
						        var url="guardar_conjunto.php?id="+producto_id;
						        var products=new Array();
						        
						        $.each($('.products'), function (index, value)
				            	{
						        	var p={};
						        	var id=$(value).val();
						        	var cantidad=$("#cantidad_"+id).val();
						        	p.id=id;
						        	p.cantidad=cantidad;
						        	products.push(p);
				            	});	

						        var jsonProducts=JSON.stringify(products);
						        
					        	$.ajax({
							        url: url,
							        type: 'POST',
							        data:  jsonProducts,
							        contentType: "application/json; charset=utf-8",
							        async: false,
							        dataType: "json",
							        success: function (data)
							        {
							        	if(tipo_producto!='P')
								        {
							        		swal({
								                title: "Guardado!",
								                text: "Producto guardado correctamente!",
								                type: "success"
								            }, function () {
								                window.location.href = 'index.php';
								            });
								        }
							        },
							        cache: false,
							        contentType: false,
							        processData: false
							    });
					        }
					        else if(tipo_producto!='P')
					        {
					        	swal({
					                title: "Guardado!",
					                text: "Producto guardado correctamente!",
					                type: "success"
					            }, function () {
					                window.location.href = 'index.php';
					            });
					        }
					        
					        if(tipo_producto=='P')
					        {
					        	var url="guardar_variantes.php?id="+producto_id;
						        var products=new Array();
						        
						        $.each($('.products_variante'), function (index, value)
				            	{
						        	var p={};
						        	var id=$(value).val();
						        	p.id=id;
						        	products.push(p);
				            	});	

						        var jsonProducts=JSON.stringify(products);
						        
					        	$.ajax({
							        url: url,
							        type: 'POST',
							        data:  jsonProducts,
							        contentType: "application/json; charset=utf-8",
							        async: false,
							        dataType: "json",
							        success: function (data)
							        {
							        	swal({
							                title: "Guardado!",
							                text: "Producto guardado correctamente!",
							                type: "success"
							            }, function () {
							                window.location.href = 'index.php';
							            });
							        },
							        cache: false,
							        contentType: false,
							        processData: false
							    });
					        }
				        },
				        cache: false,
				        contentType: false,
				        processData: false
				    });

				    
				}
				
			});
	
	$( "#cancelar" ).click(function()
	{
		var url="index.php";
		$(location).attr("href", url);
	});

	
	$('#sku').keyup(function()
	{
    	this.value = $.trim(this.value.toLocaleUpperCase());
    });

    var remove_accent=function(str)
    {
    	var map={'À':'A','Á':'A','Â':'A','Ã':'A','Ä':'A','Å':'A','Æ':'AE','Ç':'C','È':'E','É':'E','Ê':'E','Ë':'E','Ì':'I','Í':'I','Î':'I','Ï':'I','Ð':'D','Ñ':'N','Ò':'O','Ó':'O','Ô':'O','Õ':'O','Ö':'O','Ø':'O','Ù':'U','Ú':'U','Û':'U','Ü':'U','Ý':'Y','ß':'s','à':'a','á':'a','â':'a','ã':'a','ä':'a','å':'a','æ':'ae','ç':'c','è':'e','é':'e','ê':'e','ë':'e','ì':'i','í':'i','î':'i','ï':'i','ñ':'n','ò':'o','ó':'o','ô':'o','õ':'o','ö':'o','ø':'o','ù':'u','ú':'u','û':'u','ü':'u','ý':'y','ÿ':'y','Ā':'A','ā':'a','Ă':'A','ă':'a','Ą':'A','ą':'a','Ć':'C','ć':'c','Ĉ':'C','ĉ':'c','Ċ':'C','ċ':'c','Č':'C','č':'c','Ď':'D','ď':'d','Đ':'D','đ':'d','Ē':'E','ē':'e','Ĕ':'E','ĕ':'e','Ė':'E','ė':'e','Ę':'E','ę':'e','Ě':'E','ě':'e','Ĝ':'G','ĝ':'g','Ğ':'G','ğ':'g','Ġ':'G','ġ':'g','Ģ':'G','ģ':'g','Ĥ':'H','ĥ':'h','Ħ':'H','ħ':'h','Ĩ':'I','ĩ':'i','Ī':'I','ī':'i','Ĭ':'I','ĭ':'i','Į':'I','į':'i','İ':'I','ı':'i','Ĳ':'IJ','ĳ':'ij','Ĵ':'J','ĵ':'j','Ķ':'K','ķ':'k','Ĺ':'L','ĺ':'l','Ļ':'L','ļ':'l','Ľ':'L','ľ':'l','Ŀ':'L','ŀ':'l','Ł':'L','ł':'l','Ń':'N','ń':'n','Ņ':'N','ņ':'n','Ň':'N','ň':'n','ŉ':'n','Ō':'O','ō':'o','Ŏ':'O','ŏ':'o','Ő':'O','ő':'o','Œ':'OE','œ':'oe','Ŕ':'R','ŕ':'r','Ŗ':'R','ŗ':'r','Ř':'R','ř':'r','Ś':'S','ś':'s','Ŝ':'S','ŝ':'s','Ş':'S','ş':'s','Š':'S','š':'s','Ţ':'T','ţ':'t','Ť':'T','ť':'t','Ŧ':'T','ŧ':'t','Ũ':'U','ũ':'u','Ū':'U','ū':'u','Ŭ':'U','ŭ':'u','Ů':'U','ů':'u','Ű':'U','ű':'u','Ų':'U','ų':'u','Ŵ':'W','ŵ':'w','Ŷ':'Y','ŷ':'y','Ÿ':'Y','Ź':'Z','ź':'z','Ż':'Z','ż':'z','Ž':'Z','ž':'z','ſ':'s','ƒ':'f','Ơ':'O','ơ':'o','Ư':'U','ư':'u','Ǎ':'A','ǎ':'a','Ǐ':'I','ǐ':'i','Ǒ':'O','ǒ':'o','Ǔ':'U','ǔ':'u','Ǖ':'U','ǖ':'u','Ǘ':'U','ǘ':'u','Ǚ':'U','ǚ':'u','Ǜ':'U','ǜ':'u','Ǻ':'A','ǻ':'a','Ǽ':'AE','ǽ':'ae','Ǿ':'O','ǿ':'o'};
    	var res='';
    	for(var i=0;i<str.length;i++)
        {
            c=str.charAt(i);
            res+=map[c]||c;
		}

		return res;
    };

	var getCode=function()
	{
		var letter=['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','X','Y','Z'];
		var num=Math.floor(Math.random()*9)+1;
		var letter_code=letter[Math.floor(Math.random()*9)+1];

		var code=letter_code+num;

		var num=Math.floor(Math.random()*9)+1;
		var letter_code=letter[Math.floor(Math.random()*9)+1];

		code+=letter_code+num;

		return code;
	};
    
	var get_sku=function()
	{
		var mod=$("#nombre").val().toUpperCase().split(' ');
		var modelo='';
		var sku='';
		
		for(var i=0;i<mod.length;i++)
		{
	    	if(mod[i]!='')
	    	{
				modelo=mod[i];
	    	}
	    }
				
		modelo=$.trim(modelo);
		modelo=modelo.substring(3,0);
				
		sku=modelo;

		var selected=$("#proveedor").find('option:selected');
    	var proveedor_abrev=selected.data('name').toUpperCase();
    	proveedor_abrev=$.trim(proveedor_abrev);
    	proveedor_abrev=proveedor_abrev.substring(3,0);
		
    	if(proveedor_abrev!='')
    	{
        	if(sku=='')
        	{
    			sku+=proveedor_abrev;
        	}
        	else
        	{
        		sku+='-'+proveedor_abrev;
        	}
    	}

		var selected=$("#color").find('option:selected');
    	var color_abrev=selected.data('abrev');
		
    	if(color_abrev!='')
    	{
        	if(sku=='')
        	{
    			sku+=color_abrev;
        	}
        	else
        	{
        		sku+='-'+color_abrev;
        	}
    	}

    	var selected=$("#material").find('option:selected');
    	var material_abrev=selected.data('abrev');
		
    	if(material_abrev!='')
    	{
        	if(sku=='')
        	{
    			sku+=material_abrev;
        	}
        	else
        	{
        		sku+='-'+material_abrev;
        	}
    	}

    	code=$("#code").val();

		if(code=='')
		{
			code=getCode();
			$("#code").val(code);		
		}

		if(sku=='')
		{
			sku=code;
		}
		else
		{
			sku+='-'+code;
		}
		
		$("#sku").val(sku);
	};

	var hide_div=function(tipo_producto)
	{
		if(tipo_producto=='P')
		{
			$("#div_principal").show();
			$("#div_variacion").hide();
			$("#div_producto_padre").hide();
			$("#div_check_conjunto").hide();
			$("#div_variantes").show();
			$("#categoria").chosen("destroy");
			$("#categoria").chosen();
			$('#proveedor').chosen("destroy");
			$("#proveedor").chosen();
			$("#descripcion_compuesto").show();
			$("#descripcion_unitario").hide();
			
		}
		else if(tipo_producto=='V')
		{	
			$("#div_principal").hide();
			$("#div_variacion").show();
			$("#div_producto_padre").show();
			$("#div_check_conjunto").show();
			$("#div_variantes").hide();
			$('#color').chosen("destroy");
			$('#color').chosen();
			$('#version').chosen("destroy");
			$('#version').chosen();
			$('#material').chosen("destroy");
			$("#material").chosen();
			$('#proveedor').chosen("destroy");
			$("#proveedor").chosen();
			$("#descripcion_compuesto").hide();
			$("#descripcion_unitario").show();
		}
		else if(tipo_producto=='U')
		{	
			$("#div_principal").show();
			$("#div_variacion").show();
			$("#div_producto_padre").hide();
			$("#div_check_conjunto").show();
			$("#div_variantes").hide();
			$("#categoria").chosen("destroy");
			$("#categoria").chosen();
			$('#color').chosen("destroy");
			$('#color').chosen();
			$('#version').chosen("destroy");
			$('#version').chosen();
			$('#material').chosen("destroy");
			$("#material").chosen();
			$('#proveedor').chosen("destroy");
			$("#proveedor").chosen();
			$("#descripcion_compuesto").hide();
			$("#descripcion_unitario").show();
		}
		else
		{
			$("#div_principal").show();
			$("#div_variacion").hide();
		}
	};

	$("#div_variacion").hide();

	hide_div($("#tipo_producto").val());
	
	$("#tipo_producto").change(function()
	{
		var tipo_producto=$(this).val();
		hide_div(tipo_producto);		
	});

    $("#color").change(function()
    {
    	if(!$("#manual").is(":checked"))
		{
    		get_sku();
		}
    });

    $("#material").change(function()
	{
    	if(!$("#manual").is(":checked"))
		{
    		get_sku();
		}
    });

    $("#proveedor").change(function()
	{
    	if(!$("#manual").is(":checked"))
		{
    		get_sku();
		}
    });

	$('#nombre').keyup(function()
	{
		if(!$("#manual").is(":checked"))
		{
			get_sku();
		}
    });

	$('#manual').change(function()
	{
		if($(this).is(":checked"))
		{
			$("#sku").prop('readonly',false);
			$("#sku").focus();			
		}
		else
		{
			$("#sku").prop('readonly',true);
			get_sku();
		}
	});

	$('#conjunto').change(function()
	{
		$(".easy-autocomplete").css("width","auto");
        if($(this).is(":checked"))
        {
        	$("#div_conjunto").fadeIn();
        	$("#producto").focus();
        }
        else
        {
        	$("#div_conjunto").fadeOut();
        }
    });

	var options=
	{
		url: "get_products_unique.php",
		getValue: function(element)
		{
			var name=element.producto_sku+' '+element.producto_name;
			
			return name;
		},
		template: {
			type: "custom",
			method: function(value, item) {
				return "<img src='" + item.imagen + "' height='50' width='50'/>"+ value;
			}
		},
		adjustWidth: false,
		list:
		{
			match:
			{
				enabled: true
			},
			showAnimation:
			{
				type: "fade", //normal|slide|fade
				time: 400,
				callback: function() {}
			},
			hideAnimation: {
				type: "slide", //normal|slide|fade
				time: 400,
				callback: function() {}
			},
			onChooseEvent:function()
			{
				var id=$("#producto").getSelectedItemData().producto_id;
				var sku=$("#producto").getSelectedItemData().producto_sku;
				var name=$("#producto").getSelectedItemData().producto_name;
				var imagen=$("#producto").getSelectedItemData().imagen;
				
				SelectedItemData(id,sku,name,imagen);
			}
		}
	};

	var SelectedItemData=function(id,sku,name,imagen)
	{
		var table='';

		var product=$("#product_"+id).val();

		if(product==undefined)
		{
			table+='<tr>';
			table+='<input type="hidden" id="product_'+id+'" name="product_'+id+'" value="'+id+'" class="products">';
			
			if(imagen!='')
			{
				imagen='<img src="'+imagen+'" height="50" width="50">';
			}
			
			table+='<td>'+imagen+'</td>';
			table+='<td><input id="cantidad_'+id+'" value="1" size="3" onkeypress="return validateNumber(event)"></td>';
			table+='<td>'+sku+'</td>';
			table+='<td>'+name+'</td>';
			table+='<td class="text-left"><a id="delete_'+id+'" href="#" onCLick="deleteRow(this.id);"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>';
			table+='</tr>';			
	
			$('#products_table').append(table);
	
			$("#producto").focus();
			$("#producto").val('');
			$("#product_list").fadeIn();
		}
		else
		{
			$("#producto").focus();
			$("#producto").val('');
			alert("El producto ya ha sido agregado");
		}
	}

	$("#producto").easyAutocomplete(options);




	var options=
	{
		url: "get_products_unique.php",
		getValue: function(element)
		{
			var name=element.producto_sku+' '+element.producto_name;
			
			return name;
		},
		template: {
			type: "custom",
			method: function(value, item) {
				return "<img src='" + item.imagen + "' height='50' width='50'/>"+ value;
			}
		},
		adjustWidth: false,
		list:
		{
			match:
			{
				enabled: true
			},
			showAnimation:
			{
				type: "fade", //normal|slide|fade
				time: 400,
				callback: function() {}
			},
			hideAnimation: {
				type: "slide", //normal|slide|fade
				time: 400,
				callback: function() {}
			},
			onChooseEvent:function()
			{
				var id=$("#productoV").getSelectedItemData().producto_id;
				var sku=$("#productoV").getSelectedItemData().producto_sku;
				var name=$("#productoV").getSelectedItemData().producto_name;
				var imagen=$("#productoV").getSelectedItemData().imagen;
				
				SelectedItemDataV(id,sku,name,imagen);
			}
		}
	};

	var SelectedItemDataV=function(id,sku,name,imagen)
	{
		var table='';

		var product=$("#product_"+id).val();

		if(product==undefined)
		{
			table+='<tr>';
			table+='<input type="hidden" id="product_'+id+'" name="product_'+id+'" value="'+id+'" class="products_variante">';
			
			if(imagen!='')
			{
				imagen='<img src="'+imagen+'" height="50" width="50">';
			}
			
			table+='<td>'+imagen+'</td>';
			table+='<td>'+sku+'</td>';
			table+='<td>'+name+'</td>';
			table+='<td class="text-left"><a id="delete_'+id+'" href="#" onCLick="deleteRow(this.id);"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>';
			table+='</tr>';			
	
			$('#products_table_variante').append(table);
	
			$("#productoV").focus();
			$("#productoV").val('');
			$("#product_list_variante").fadeIn();
		}
		else
		{
			$("#productoV").focus();
			$("#productoV").val('');
			alert("El producto ya ha sido agregado");
		}
	}

	$("#productoV").easyAutocomplete(options);
	



	

	var optionsP=
	{
		url: "get_products_main.php?t=P",
		getValue: function(element)
		{
			var name=element.producto_sku+' '+element.producto_name;
			
			return name;
		},
		template: {
			type: "custom",
			method: function(value, item) {
				return "<img src='" + item.imagen + "' height='50' width='50'/>"+ value;
			}
		},
		adjustWidth: false,
		list:
		{
			match:
			{
				enabled: true
			},
			showAnimation:
			{
				type: "fade", //normal|slide|fade
				time: 400,
				callback: function() {}
			},
			hideAnimation: {
				type: "slide", //normal|slide|fade
				time: 400,
				callback: function() {}
			},
			onChooseEvent:function()
			{
				var id=$("#producto_padre").getSelectedItemData().producto_id;
				$("#producto_padre_id").val(id);				
			}
		}
	};

	$("#producto_padre").easyAutocomplete(optionsP);

	$("#color").chosen();
	$("#material").chosen();
	$("#categoria").chosen();
	$("#proveedor").chosen();
	$("#version").chosen();
	
	if(!$("#id_producto").val())
	{
		$("#tipo_producto").chosen();
	}

	var calculateDiscount=function()
	{
		var precio_utilitario=$("#precioU").val();
		precio_utilitario=parseFloat(precio_utilitario);
		precio_utilitario=precio_utilitario.toFixed(2);
		
		var precioUD=precio_utilitario;
		var bandera=0;
		
		$("input[name='descuento[]']").each(function()
		{        
			if($(this).val()!='' || $(this).val()!=0)
			{
				var discount=$(this).val()/100;
				discount=parseFloat(discount);
				discount=discount.toFixed(2);
				precioUD=parseFloat(precioUD-(discount*precioUD));
				bandera=1;
			}
		}); 

		if(bandera==0)
		{
			$("#precioUD").val($("#precioU").val());
		}
		else
		{
			precioUD=parseFloat(precioUD);
			precioUD=precioUD.toFixed(2);
			
			$("#precioUD").val(precioUD);
		}
	};
	
	
	var validateDiscount=function(discount)
	{
		if($("#precioU").val()=='' || $("#precioU").val()==0)
		{
			discount.val('');
			$("#precioU").val('');
			$("#precioUD").val('');
			$("#precioU").focus();
			alert("Debe de agregar primero el Precio Unitario");
		}
		else if(discount.val()>=100)
		{
			discount.val('');
			discount.focus();
			alert("Descuento Invalido");
			$("#precioUD").val($("#precioU").val());
			calculateDiscount();
		}
		else
		{
			calculateDiscount();
		}
	};
	
	$("#agregarDescuento").click(function()
	{
		if($("#descuento").val()!='')
		{
	        $("#newDiscount").append('<div class="form-group"><label class="col-sm-2 control-label"></label><div class="col-sm-2 "><div class="input-group m-b"><input class="form-control discount" id="descuento" name="descuento[]" value="" type="text" onkeypress="return validateNumber(event)"><span class="input-group-addon">+%</span></div></div><div class="col-md-1">                                <button class="btn btn-danger btn-xs deleteDiscount" id="agregarDescuento" value="" placeholder="Descuento" type="button"><i class="fa fa-times"></i></button></div></div>');
	
	        $(".deleteDiscount").click(function(){            
	            $(this).parent().parent().remove();
	            calculateDiscount();
	        });
	        
	        $(".discount").keyup(function()
	        {
	        	validateDiscount($(this));
	        });  
		}
		else
		{
			$("#descuento").val('');
			$("#descuento").focus();
			alert("Debe de agregar primero un Descuento");
		}
     });

	var public_price=function()
	{
		var precio_compra=$("#precioU").val();
		var aumento=$("#precioPUP").val();
		var precio_publico='';
		
		if(precio_compra!='')
		{
			aumento=parseFloat(aumento/100);
			aumento=aumento.toFixed(2);
			
			precio_compra=parseFloat(precio_compra);
			precio_compra=precio_compra.toFixed(2);
			
			precio_publico=parseFloat(precio_compra*aumento);
			precio_publico=precio_publico.toFixed(2);
			precio_publico=parseFloat(precio_publico)+parseFloat(precio_compra);
			precio_publico=precio_publico.toFixed(2);
			
			$("#precioP").val(precio_publico);
		}
		else
		{
			$("#precioP").val('');
		}
	};


	var calculateDiscountP=function()
	{
		if($("#precioU").val())
		{
			$("#precioPD").val($("#precioP").val());
			var precio_utilitario=$("#precioP").val();
			precio_utilitario=parseFloat(precio_utilitario);
			precio_utilitario=precio_utilitario.toFixed(2);
			
			var precioUD=precio_utilitario;
			var bandera=0;
			
			$("input[name='descuentoP[]']").each(function()
			{        
				if($(this).val()!='' || $(this).val()!=0)
				{
					var discount=$(this).val()/100;
					discount=parseFloat(discount);
					discount=discount.toFixed(2);
					precioUD=parseFloat(precioUD-(discount*precioUD));
					bandera=1;
				}
			}); 
	
			if(bandera==0)
			{
				$("#precioPD").val($("#precioP").val());
			}
			else
			{
				precioUD=parseFloat(precioUD);
				precioUD=precioUD.toFixed(2);
				
				$("#precioPD").val(precioUD);
			}
		}
		else
		{
			$("#precioPD").val('');
		}
	};

	var public_price_min=function()
	{
		var price_public=$("#precioP").val();
		var aumento=$("#precioPMM").val();
		var precio_publico_min='';
		
		if(price_public!='')
		{
			aumento=parseFloat(aumento/100);
			aumento=aumento.toFixed(2);
			
			price_public=parseFloat(price_public);
			price_public=price_public.toFixed(2);
			
			precio_publico_min=parseFloat(price_public*aumento);
			precio_publico_min=precio_publico_min.toFixed(2);
			precio_publico_min=parseFloat(price_public)-parseFloat(precio_publico_min);
			precio_publico_min=precio_publico_min.toFixed(2);
			
			$("#precioPM").val(precio_publico_min);
		}
		else
		{
			$("#precioPM").val('');
		}
	};
	
	$(".discount").keyup(function()
	{
		validateDiscount($(this));    	
    });


    var calculate_prices=function()
    {
    	calculateDiscount();
		public_price();
		calculateDiscountP();
		public_price_min();
    };

	$("#precioU").keyup(function()
	{
		if($(this).val()!='')
		{
			$("#precioUD").val($(this).val());
			$("#precioP").val($(this).val());
			calculate_prices();
		}
		else
		{
			$("#precioP").val('');
			$("#precioUD").val('');
			$("#precioPD").val('');
			$("#precioPM").val('');
		}    	
    });



	var validateDiscountP=function(discount)
	{
		if($("#precioP").val()=='' || $("#precioP").val()==0)
		{
			discount.val('');
			$("#precioP").val('');
			$("#precioPD").val('');
			$("#precioP").focus();
			alert("Debe de agregar primero el Precio Público");
		}
		else if(discount.val()>=100)
		{
			discount.val('');
			discount.focus();
			alert("Descuento Invalido");
			$("#precioPD").val($("#precioP").val());
			calculateDiscountP();
		}
		else
		{
			calculateDiscountP();
		}
	};
	
	$("#agregarDescuentoP").click(function()
	{
		if($("#descuentoP").val()!='')
		{
			$("#newDiscountP").append('<div class="form-group"><label class="col-sm-2 control-label"></label><div class="col-sm-2 "><div class="input-group m-b"><input class="form-control discountP" id="descuentoP" name="descuentoP[]" value="" type="text" onkeypress="return validateNumber(event)"><span class="input-group-addon">%</span></div></div><div class="col-md-1">                                <button class="btn btn-danger btn-xs deleteDiscountP" id="agregarDescuentoP" value="" placeholder="Descuento" type="button"><i class="fa fa-times"></i></button></div></div>');
			
			$(".deleteDiscountP").click(function(){            
				$(this).parent().parent().remove();
			    calculateDiscountP();
			});
			        
			$(".discountP").keyup(function()
			{
				validateDiscountP($(this));
			});  
		}
		else
		{
			$("#descuentoP").val('');
			$("#descuentoP").focus();
			alert("Debe de agregar primero un Descuento");
		}
	});

	
	$(".discountP").keyup(function()
	{
		validateDiscountP($(this));    	
	});

	$("#precioP").keyup(function()
	{
		calculateDiscountP();    	
	});

	$("#precioPUP").keyup(function()
	{
		if($(this).val()<100)
		{
			calculate_prices();
		}
		else
		{
			$(this).val('');
			alert("Descuento Invalido");
		}
	});

	$("#precioPMM").keyup(function()
	{
		if($(this).val()<100)
		{
			calculate_prices();
		}
		else
		{
			$(this).val('');
			alert("Descuento Invalido");
		}	    	
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

function deleteRow(td)
{
	$("#"+td).parent().parent().remove();

	var bandera=false;
	$.each($('.products'), function (index, value)
	{
		var id=$(value).val();
		bandera=true;
	});
	
	if(bandera==false)
	{
		$("#product_list").fadeOut();
	}
	
	$("#producto").val('');
	$("#producto").focus();
}

function validateNumber(evt)
{
	evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
}
