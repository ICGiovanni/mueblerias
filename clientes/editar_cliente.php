<?php
    include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
    require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');
    //include $pathProy.'login/session.php';
    include $pathProy.'/header.php';
    include $pathProy.'/menu.php';
?>

<link href="<?php echo $raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
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
                <a href="./index.php" class="btn btn-primary">Lista de Clientes</a>
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
			<input type="hidden" class="form-control" id="id_cliente" name="id_cliente" value="<?php echo $datos[0]["id_cliente"]?>">
			<input type="hidden" class="form-control" id="id_estado" name="id_estado" value="<?php echo $datos[0]["id_estado"]?>">
			<div class="form-group"><label class="col-sm-2 control-label">ID</label>
			<div class="col-sm-6"><label class="col-sm-2 control-label"><?php echo $datos[0]["id_cliente"]?></label></div>
            </div>
			<div class="form-group"><label class="col-sm-2 control-label">Nombre</label>
			<div class="col-sm-6" ><input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $datos[0]["nombre"]?>"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Apellido Paterno</label>
			<div class="col-sm-6" ><input type="text" class="form-control" id="apellidoP" name="apellidoP" value="<?php echo $datos[0]["apellidoP"]?>"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Apellido Materno</label>
			<div class="col-sm-6" ><input type="text" class="form-control" id="apellidoM" name="apellidoM" value="<?php echo $datos[0]["apellidoM"]?>"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Raz&oacute;n Social</label>
			<div class="col-sm-6"><input type="text" class="form-control" id="razonS" name="razonS" value="<?php echo $datos[0]["razon_social"]?>"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">RFC</label>
			<div class="col-sm-6"><input type="text" class="form-control" id="rfc" name="rfc" value="<?php echo $datos[0]["rfc"]?>"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Calle</label>
			<div class="col-sm-6"><input type="text" class="form-control" id="calle" name="calle" value="<?php echo $datos[0]["calle"]?>"></div>
            </div>
            <div class="form-group">
            <label class="col-sm-2 control-label">No. Exterior</label>
			<div class="col-sm-2"><input type="text" class="form-control" id="noExt" name="noExt" value="<?php echo $datos[0]["num_exterior"]?>"></div>
			<label class="col-sm-2 control-label">No. Interior</label>
			<div class="col-sm-2"><input type="text" class="form-control" id="noInt" name="noInt" value="<?php echo $datos[0]["num_interior"]?>"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Colonia</label>
			<div class="col-sm-6"><input type="text" class="form-control" id="colonia" name="colonia" value="<?php echo $datos[0]["colonia"]?>"></div>
            </div>
            <div class="form-group">
			<label class="col-sm-2 control-label">C.P.</label>
			<div class="col-sm-2"><input type="text" class="form-control" id="codigoPostal" name="codigoPostal" value="<?php echo $datos[0]["codigo_postal"]?>"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Municipio</label>
			<div class="col-sm-6"><input type="text" class="form-control" id="municipio" name="municipio" value="<?php echo $datos[0]["municipio"]?>"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Estado</label>
			<div class="col-sm-6">
			<select id="estado" name="estado" class="form-control m-b">
            <option value="">Seleccione un Estado</option>
            </select>
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
           		$phonesC.='<div class="col-sm-3 "><input class="form-control" id="telefono" name="telefono[]" value="'.$phone.'" type="text"></div>
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
            
            echo $phonesC;
            ?>
            </div>
            <div id="newPhone"></div>
            
          	<div class="form-group">
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
					$emailC.='<div class="col-sm-3 "><input class="form-control" id="email" name="email[]" value="'.$email.'" type="text"></div>';
					$emailC.='<div class="col-md-1">                            
                            <button class="btn btn-primary btn-xs" id="agregarEmail" value="" placeholder="E-mail" type="button"><i class="fa fa-plus"></i></button>
                        </div>';
				}
				else 
				{
					$emailC.='<label class="col-sm-2 control-label">E-mail</label>';
					$emailC.='<div class="col-sm-3 "><input class="form-control" id="email" name="email[]" value="'.$email.'" type="text"></div>';
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
				$emailC.='<div class="col-sm-3 "><input class="form-control" id="email" name="email[]" value="'.$email.'" type="text"></div>';
				$emailC.='<div class="col-md-1">
                            <button class="btn btn-danger btn-xs deleteEmail" id="agregarEmail" value="" placeholder="E-mail" type="button"><i class="fa fa-times"></i></button>
                        </div>';
				$emailC.='</div>';
			}
          	echo $emailC;
          	?>
          	
            </div>
            <div id="newEmail"></div>
            
            <div class="form-group">
			<div class="col-sm-4 col-sm-offset-2">
			<button class="btn btn-white" id="cancelar" type="button">Cancelar</button>
			<button class="btn btn-primary" id="editar" type="button">Guardar</button>
			</div>
			</div>
        
		</form>
	</div>
<script src="<?php echo $raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo $raizProy?>js/plugins/toastr/toastr.min.js"></script>
<script src="<?php echo $raizProy?>clientes/js/clientes.js"></script>   
   

<?php
    include $pathProy.'footer.php';
?>