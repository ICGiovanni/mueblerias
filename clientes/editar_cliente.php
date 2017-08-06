<?php
    include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
    require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');
    //include $pathProy.'login/session.php';
    include $pathProy.'/header.php';
    include $pathProy.'/menu.php';
?>

<link href="<?php echo $raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<link href="<?=$raizProy?>css/plugins/chosen/chosen.css" rel="stylesheet">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Editar Cliente</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">Clientes</a>
                </li>
                <li class="active">
                    <strong>Editar Cliente</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="./index.php" class="btn btn-warning btn-xs"><i class="fa fa-arrow-left"></i> Regresar a listado</a>
            </div>
        </div>
    </div>
<?php
$clientes=new Clientes();
$id_cliente=$_REQUEST["id"];
$datos=$clientes->GetClientes($id_cliente);

?>
    <div class="wrapper wrapper-content animated fadeInRight">
		<form method="get" class="form-horizontal" action="/" id="form_cliente">
		<input type="hidden" id="address" name="address" value="0">
			<input type="hidden" id="address_current" name="address_current" value="">
			<input type="hidden" class="form-control" id="id_cliente" name="id_cliente" value="<?php echo $datos[0]["id_cliente"]?>">
			<input type="hidden" class="form-control" id="id_estado" name="id_estado" value="<?php echo $datos[0]["id_estado"]?>">
			<div class="form-group"><label class="col-sm-2 control-label">ID</label>
			<div class="col-sm-6"><label class="col-sm-2 control-label"><?php echo $datos[0]["id_cliente"]?></label></div>
            </div>
			<div class="form-group"><label class="col-sm-2 control-label">Nombre</label>
			<div class="col-sm-5" ><input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $datos[0]["nombre"]?>"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Apellido Paterno</label>
			<div class="col-sm-5" ><input type="text" class="form-control" id="apellidoP" name="apellidoP" value="<?php echo $datos[0]["apellidoP"]?>"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Apellido Materno</label>
			<div class="col-sm-5" ><input type="text" class="form-control" id="apellidoM" name="apellidoM" value="<?php echo $datos[0]["apellidoM"]?>"></div>
            </div>
            
            
            
            <div class="col-lg-11">
			<div class="panel panel-default">
            <div class="panel-heading">
            <label class="control-label">Datos Cliente</label>
			</div>
            <div class="panel-body">
            
            <div class="form-group"><label class="col-sm-2 control-label">Tipo</label>
			<div class="col-sm-6">
			<select data-placeholder="Selecciona un Tipo" class="chosen-select" style="width:300px;" tabindex="4" id="tipo_datos" name="tipo_datos">
			<option value="envio">Envio</option>
			<option value="facturacion">Facturación</option>
			</select>
			</div>
			</div>
            
            <div id="div_facturacion" name=""div_facturacion"">
            <div class="form-group"><label class="col-sm-2 control-label">Raz&oacute;n Social</label>
			<div class="col-sm-6"><input type="text" class="form-control" id="razonS" name="razonS"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">RFC</label>
			<div class="col-sm-6"><input type="text" class="form-control" id="rfc" name="rfc"></div>
            </div>
            </div>
            
            <div class="form-group"><label class="col-sm-2 control-label">Calle</label>
			<div class="col-sm-6"><input type="text" class="form-control" id="calle" name="calle"></div>
            </div>
            <div class="form-group">
            <label class="col-sm-2 control-label">No. Exterior</label>
			<div class="col-sm-2"><input type="text" class="form-control" id="noExt" name="noExt"></div>
			<label class="col-sm-2 control-label">No. Interior</label>
			<div class="col-sm-2"><input type="text" class="form-control" id="noInt" name="noInt"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Colonia</label>
			<div class="col-sm-6"><input type="text" class="form-control" id="colonia" name="colonia"></div>
            </div>
            <div class="form-group">
			<label class="col-sm-2 control-label">C.P.</label>
			<div class="col-sm-2"><input type="text" class="form-control" id="codigoPostal" name="codigoPostal"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Estado</label>
			<div class="col-sm-6">
			<select data-placeholder="Selecciona un estado" class="chosen-select" style="width:300px;" tabindex="4" id="estado" name="estado">
            <option value=""></option>
            </select>
			<button class="btn btn-danger btn-xs" id="limpiar_estado" type="button"><i class="fa fa-times"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
			</div>
			<div class="form-group"><label class="col-sm-2 control-label">Municipio</label>
			<div class="col-sm-6"><input type="text" class="form-control" id="municipio" name="municipio"></div>
            </div>
            
            <div class="form-group"><label class="col-sm-2 control-label">Referencia</label>
			<div class="col-sm-6"><textarea class="form-control" id="referencia" name="referencia"></textarea></div>
            </div>
            
            <div class="form-group">
			<div class="col-sm-6 col-sm-offset-2" align="right"><br>
			<button class="btn btn-warning btn-xs" id="limpiar_address" type="button">Limpiar</button>&nbsp;&nbsp;&nbsp;&nbsp;
			<button class="btn btn-primary btn-xs" id="addAddress" type="button">Agregar Dirección</button>
			<button class="btn btn-primary btn-xs" style="display: none;" id="aditAddress" type="button">Actualizar Dirección</button>
			</div>
			</div>
			<?php 
			
			$direcciones=$clientes->GetDataCliente($id_cliente);
			
			if(count($direcciones))
			{
				$display="";
			}
			else
			{
				$display="display:none;";
			}
			
			$content="";
			$i=0;
			foreach($direcciones as $d)
			{
				$tipo=$d['cliente_direccion_tipo_desc'];
				$rfc=$d['cliente_direccion_rfc'];
				$razonS=$d['cliente_direccion_razon_social'];
				$calle=$d['cliente_direccion_calle'];
				$noExt=$d['cliente_direccion_numero_ext'];
				$noInt=$d['cliente_direccion_numero_int'];
				$colonia=$d['cliente_direccion_colonia'];
				$codigoP=$d['cliente_direccion_cp'];
				$id_estado=$d['id_estado'];
				$estado=$d['estado'];
				$municipio=$d['cliente_direccion_municipio'];
				$referencia=$d['cliente_direccion_entre_calles'];
				
				$content.='<tr>';
				$content.='<input id="address_'.$i.'" name="address_'.$i.'" value="'.$i.'" class="address" type="hidden">';
				$content.='<input id="tipo_datos_'.$i.'" name="tipo_datos_'.$i.'" value="'.$tipo.'" type="hidden">';
				$content.='<input id="razonS_'.$i.'" name="razonS_'.$i.'" value="'.$razonS.'" type="hidden">';
				$content.='<input id="rfc_'.$i.'" name="rfc_'.$i.'" value="'.$rfc.'" type="hidden">';
				$content.='<input id="calle_'.$i.'" name="calle_'.$i.'" value="'.$calle.'" type="hidden">';
				$content.='<input id="noExt_'.$i.'" name="noExt_'.$i.'" value="'.$noExt.'" type="hidden">';
				$content.='<input id="noInt_'.$i.'" name="noInt_'.$i.'" value="'.$noInt.'" type="hidden">';
				$content.='<input id="colonia_'.$i.'" name="colonia_'.$i.'" value="'.$colonia.'" type="hidden">';
				$content.='<input id="codigoPostal_'.$i.'" name="codigoPostal_'.$i.'" value="'.$codigoP.'" type="hidden">';
				$content.='<input id="estado_'.$i.'" name="estado_'.$i.'" value="'.$id_estado.'" type="hidden">';
				$content.='<input id="municipio_'.$i.'" name="municipio_'.$i.'" value="'.$municipio.'" type="hidden">';
				$content.='<input id="referencia_'.$i.'" name="referencia_'.$i.'" value="'.$referencia.'" type="hidden">';
				
				$datos='';
				
				if($tipo=='envio')
				{
					$tipo='<div id="addres_tipo_'.$i.'">Envio</div>';
					$datos.="";
				}
				else
				{
					$tipo='<div id="addres_tipo'.$i.'">Facturación</div>';
					$datos.="<strong>RFC: </strong>".$rfc."<br><strong>Razón Social: </strong>".$razonS."<br>";
				}
				
				$datos.='<strong>Calle: </strong>'.$calle.' <strong>No. Ext: </strong>'.$noExt;
				
				if($noInt)
				{
					$datos.='<strong>No. Int.: </strong>'.$noInt.'<br>';	
				}
				
				$datos.='<strong>Colonia: </strong>'.$colonia.' <strong>C.P. </strong>'.$codigoP.'<br><strong>Municipio o Delegación: </strong> '.$municipio.' <strong>Estado: </strong>'.$estado.'<br>';
				
				if($referencia)
				{
					$datos.='<strong>Referencia: </strong>'.$referencia;
            	}
				
				
				$content.='<td>'.$tipo.'</td>';
				$content.='<td><div id="addres_div_'.$i.'">'.$datos.'</div></td>';
				$content.='<td class="text-left"><div class="infont col-md-1 col-sm-1"><a href="#" title="Editar" id-num="'.$i.'" class="editAddress"><i class="fa fa-pencil editAddress"></i></a></div><div class="infont col-md-1 col-sm-1"><a href="#" title="Borrar" class="deleteAddress"><i class="fa fa-trash-o"></i></a></div></td>';
				
				$content.='</tr>';
				
				$i++;
			}
			
			
			?>
			
			
			<div class="form-group">
	           	<div class="col-sm-8" >
	           	<div id="address_list" class="ibox-content" style="<?=$display;?>">
	           	
	           	<table class="table table-striped">
	           	<thead>
					<tr>
						<td><strong>Tipo</strong></td>
						<td><strong>Datos</strong></td>
						<td></td>
					</tr>
				</thead>
	           	<tbody id="address_table">
	           	<?=$content;?>
	           	</tbody>
	           	</table>
	           </div>
	           </div>
	           </div>
            
            </div>
			</div>
            </div>
            
            
            
            
            <div class="form-group">
            <?php
           	$phones=$clientes->GetPhonesClient($id_cliente);
           	
           	$phonesC="";
           	$i=0;
           	foreach($phones as $p)
           	{
           		$phone=$p['number'];
           		$type=$p['phone_type_id'];
           		
           		$phonesC.='<div class="form-group">';
           		
           		if($i==0)
           		{
           			$phonesC.='<label class="col-sm-2 control-label">Telefono</label>';
           		}
           		else
           		{
           			$phonesC.='<label class="col-sm-2 control-label"></label>';
           		}
           		$phonesC.='<div class="col-sm-3 "><input class="form-control telefono_cliente" id="telefono" name="telefono[]" value="'.$phone.'" type="text"></div>
           	<div class="col-md-2">
                            <select id="phoneType" name="phoneType[]" class="form-control">';
           		
           		foreach($clientes->GetTypesPhones() as $t)
           		{
           			if($t['phone_type_id']==$type)
           			{
           				$phonesC.='<option value="'.$t['phone_type_id'].'" selected>'.$t['type'].'</option>';
           			}
           			else
           			{
           				$phonesC.='<option value="'.$t['phone_type_id'].'">'.$t['type'].'</option>';
           			}
           		}
           		
           		$phonesC.='</select></div>';
           		
           		
           		
           		if($i==0)
           		{
           			$phonesC.='<div class="col-md-1">
                            <button class="btn btn-primary btn-xs" id="agregarTelefono" value="" placeholder="Telefono" type="button"><i class="fa fa-plus"></i></button></div>';
           		}
           		else
           		{
           			$phonesC.='<div class="col-md-1"><button class="btn btn-danger btn-xs deletePhone" id="agregarTelefono" value="" placeholder="Telefono" type="button"><i class="fa fa-times"></i></button></div>';
           		}
           		
           		$phonesC.='</div>';
           		
           		$i++;
           	}
            
           	if(!$phonesC)
           	{
           		$phonesC='<label class="col-sm-2 control-label">Telefono</label>
           	<div class="col-sm-3 "><input class="form-control telefono_cliente" id="telefono" name="telefono[]" value="" type="text" onkeypress="return validateNumber(event)"></div><div class="col-md-2">
                            <select id="phoneType" name="phoneType[]" class="form-control">
                                <option value="1">Celular</option>
                                <option value="2">Casa</option>
                                <option value="3">Oficina</option>
                                <option value="4">Otro</option>
                            </select>
                        </div>
			<div class="col-md-1">                            
                            <button class="btn btn-primary btn-xs" id="agregarTelefono" value="" placeholder="Telefono" type="button"><i class="fa fa-plus"></i></button>
                        </div>    ';
           	}
           	
            echo $phonesC;
            ?>
            </div>
            <div id="newPhone"></div>
            
          	
          	<?php 
          	$emails=$clientes->GetEmailsClient($id_cliente);
          	
          	$emailC="";
          	$i=0;
			foreach($emails as $e)
			{
				$email=$e['email'];
				$emailC.='<div class="form-group">';
				if($i==0)
				{
					$emailC.='<label class="col-sm-2 control-label">E-mail</label>';
					$emailC.='<div class="col-sm-5"><input class="form-control" id="email" name="email[]" value="'.$email.'" type="text"></div>';
					$emailC.='<div class="col-md-1">                            
                            <button class="btn btn-primary btn-xs" id="agregarEmail" value="" placeholder="E-mail" type="button"><i class="fa fa-plus"></i></button>
                        </div>';
				}
				else 
				{
					$emailC.='<label class="col-sm-2 control-label">E-mail</label>';
					$emailC.='<div class="col-sm-5"><input class="form-control" id="email" name="email[]" value="'.$email.'" type="text"></div>';
					$emailC.='<div class="col-md-1">
                            <button class="btn btn-danger btn-xs deleteEmail" id="agregarEmail" value="" placeholder="E-mail" type="button"><i class="fa fa-times"></i></button>
                        </div>';
				}
				$emailC.='</div>';
				
				$i++;
			}
			
			if(!$emailC)
			{
				$emailC.='<div class="form-group">';
				$emailC.='<label class="col-sm-2 control-label">E-mail</label>';
				$emailC.='<div class="col-sm-5"><input class="form-control" id="email" name="email[]" value="" type="text"></div>';
				$emailC.='<div class="col-md-1">
                            <button class="btn btn-danger btn-xs deleteEmail" id="agregarEmail" value="" placeholder="E-mail" type="button"><i class="fa fa-times"></i></button>
                        </div>';
				$emailC.='</div>';
			}
          	echo $emailC;
          	?>
          	
            
            <div id="newEmail"></div>
            
            <div class="form-group">
			<div class="col-sm-6 col-sm-offset-2" align="right"><br>
			<button class="btn btn-danger btn-xs" id="cancelar" type="button">Cancelar</button>&nbsp;&nbsp;&nbsp;&nbsp;
			<button class="btn btn-primary btn-xs" id="editar" type="button">Guardar Cambio</button>
			</div>
			</div>
            
		</form>
	</div>
<script src="<?php echo $raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo $raizProy?>js/plugins/toastr/toastr.min.js"></script>
<script src="<?php echo $raizProy?>clientes/js/clientes.js"></script>   
<script src="<?=$raizProy?>js/plugins/chosen/chosen.jquery.js"></script>   

<?php
    include $pathProy.'footer.php';
?>