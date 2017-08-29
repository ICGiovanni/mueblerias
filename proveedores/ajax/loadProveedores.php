<?php
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'config.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'proveedores/models/class.Proveedores.php');

    $proveedores = new Proveedor();
    $list = $proveedores->getProveedoresList();

    if(count($list)>0){
        foreach($list as $prov){
            
            $telefonos = $proveedores->getProveedorPhone($prov['proveedor_id']);
            
            $telefono = '';
            
            foreach($telefonos as $phone){
                $telefono.= "<b>".$phone['type'].":</b>&nbsp;".$phone['number']."<br /><br />";
            }
                
            $direccion = "<b>Calle</b>: ".$prov['street']."<br /><br /><b>Numero Exterior: </b>".$prov['number']."&nbsp; <b>Interior</b>:".$prov['int_number']."<br /><br /><b>Colonia</b>: ".$prov['neighborhood']."<br /><br /><b>C.P.</b>".$prov['zip_code']."<br /><br />";
            echo "  <tr>
                        <td>".$prov['proveedor_nombre']."</td>
                        <td>".$prov['proveedor_nombre_fiscal']."</td>
                        <td align='center'><a href='#' data-content='".$direccion."' data-title='Dirección del Proveedor' class='showDialog'><i class='fa fa-eye success'></i></a></td>    
                        <td>".$prov['proveedor_representante']."</td>
                        <td align='center'><a href='#' data-content='".$telefono."' data-title='Telefonos del Proveedor' class='showDialog'><i class='fa fa-eye success'></i></a></td>
                        <td>".$prov['email']."</td>
                        
                        <td align='center'>
                            <a href='editarProveedor.php?id=". base64_encode($prov['proveedor_id'])."'>
                                <i class='fa fa-pencil editProv' title='Editar' data-proveedor_id='".$prov['proveedor_id']."'></i>
                            </a>
                            <a href='#'><i class='fa fa-trash deleteProv' title='Borrar'
                                        data-nombre='".$prov['proveedor_nombre']."'
                                        data-proveedor_id='".$prov['proveedor_id']."'
                                        ></i></a>
                        </td>
                    </tr>";
        }
    }
?>