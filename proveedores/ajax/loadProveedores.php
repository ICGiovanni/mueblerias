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
                $telefono.= $phone['number']."&nbsp;".$phone['type']."<br />";
            }
                
            
            echo "  <tr>
                        <td>".$prov['proveedor_nombre']."</td>
                        <td>".$telefono."</td>
                        <td>".$prov['email']."</td>
                        <td align='center'>".$prov['street']."&nbsp;".$prov['number']."&nbsp;".$prov['int_number']."&nbsp;".$prov['neighborhood']."</td>
                        <td align='center'>
                            <a href='#' data-toggle='modal' data-target='#myModal2'>
                                <i class='fa fa-edit editProv' title='Editar' 
                                    data-proveedor_id='".$prov['proveedor_id']."'
                                    data-address_id='".$prov['address_id']."'                                        
                                    data-nombre='".$prov['proveedor_nombre']."'
                                    data-telefono='".$telefono."'
                                    data-email='".$prov['email']."'
                                    data-email='".$prov['email']."'
                                    data-calle='".$prov['street']."' 
                                    data-numext='".$prov['number']."' 
                                    data-numint='".$prov['int_number']."' 
                                    data-colonia='".$prov['neighborhood']."' 
                                    data-municipio='".$prov['municipality']."' 
                                    data-cp='".$prov['zip_code']."' 
                                    data-estado='".$prov['state']."'     
                                ></i>
                            </a>
                            <a href='#'><i class='fa fa-trash deleteProv' title='Editar'
                                        data-nombre='".$prov['proveedor_nombre']."'
                                        data-proveedor_id='".$prov['proveedor_id']."'
                                        ></i></a>
                        </td>
                    </tr>";
        }
    }
?>