var phones;
$(document).ready(function(){                        
    loadProveedores();  
        
    
    $("#btn_editar_proveedor").click(function(){
        var nombre = $("#nombreComercial").val();
        var nombreFiscal = $("#nombreFiscal").val();
        var representante = $("#representante").val();
        
        var email = $("#email").val();
        
        var telefonos = new Array();
        var tipos = new Array();    

        $("input[name='telefono[]']").each(function(){        
            telefonos.push($(this).val());
        });   
        $("select[name='phoneType[]']").each(function(){                
            tipos.push($(this).val());
        });
        
        var calle = $("#calle").val();
        var numExt = $("#numExt").val();
        var numInt = $("#numInt").val();
        var colonia = $("#colonia").val();
        var cp = $("#cp").val();
        var municipio = $("#municipio").val();
        var estado = $("#estado").val();                
        
        $.ajax({
            url: "ajax/updateProveedor.php",
            type: "post",
            data: {
                nombre : nombre,    
                nombreFiscal: nombreFiscal,
                representante: representante,
                email : email,
                telefonos : JSON.stringify(telefonos),
                tipos : JSON.stringify(tipos),
                calle: calle,
                numExt: numExt,
                numInt: numInt,
                colonia: colonia,
                cp: cp,
                municipio: municipio,
                estado: estado            
            },
            success: function (response) {            
                console.log(response);
                /* 
                swal({
                    title: "Actualizado!",
                    text: "Proveedor actualizado correctamente!",
                    type: "success"
                }, function () {                    
                    window.location.href = 'index.php';
                });
                */
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log('error al cargar los proveedores loadProveedores()/index.php');
            }
        });
        
    });
    $("#btn_guardar_proveedor").click(function(){
        var nombre = $("#nombreComercial").val();
        var nombreFiscal = $("#nombreFiscal").val();
        var representante = $("#representante").val();
        
        var email = $("#email").val();
        
        var telefonos = new Array();
        var tipos = new Array();    

        $("input[name='telefono[]']").each(function(){        
            telefonos.push($(this).val());
        });   
        $("select[name='phoneType[]']").each(function(){                
            tipos.push($(this).val());
        });
        
        var calle = $("#calle").val();
        var numExt = $("#numExt").val();
        var numInt = $("#numInt").val();
        var colonia = $("#colonia").val();
        var cp = $("#cp").val();
        var municipio = $("#municipio").val();
        var estado = $("#estado").val();                
         
        $.ajax({
            url: "ajax/saveProveedor.php",
            type: "post",
            data: {
                nombre : nombre,    
                nombreFiscal: nombreFiscal,
                representante: representante,
                email : email,
                telefonos : JSON.stringify(telefonos),
                tipos : JSON.stringify(tipos),
                calle: calle,
                numExt: numExt,
                numInt: numInt,
                colonia: colonia,
                cp: cp,
                municipio: municipio,
                estado: estado            
            },
            success: function (response) {            
                console.log('response'+response);
                swal({
                    title: "Guardado!",
                    text: "Proveedor guardado correctamente!",
                    type: "success"
                }, function () {                    
                    window.location.href = 'index.php';
                });

            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log('error al cargar los proveedores loadProveedores()/index.php');
            }
        });
        
    });
    
    
    
    $("#agregarTelefono").click(function(){
        $("#newPhone").append("<div>"+
                                "<div class='clear'>&nbsp;</div>"+
                                "<div class='row'><div class='col-md-2'>&nbsp;</div>"+
                                "<div class='col-md-3'><input class='form-control' name='telefono[]' value='' type='text'></div>"+
                                "<div class='col-md-2'>"+
                                    "<select id='phoneType' name='phoneType[]' class='form-control'>"+
                                       phones +
                                    "</select>"+
                                "</div>"+
                                "<div class='col-md-1' style='padding-top: 5px'><button class='btn btn-danger btn-xs deletePhone' value='' type='button'><i class='fa fa-times'></i></button></div>"+
                               "</div></div>");
                       
        $(".deletePhone").click(function(){            
            $(this).parent().parent().parent().remove();
        });               
    });
    
    
});

        
function loadProveedores(){
    $("#listaProveedores").html('');
    $.ajax({
        url: "ajax/loadProveedores.php",
        type: "post",
        data: {type: 0} ,
        success: function (response) {
            
            if($("#listaProveedores").length){
                $("#listaProveedores").html(response);

                setTimeout(function(){
                     if (!$.fn.dataTable.isDataTable( '.dataTables-example' ) ) {                    
                         $('.dataTables-example').DataTable({
                             "oLanguage": {
                                 "sSearch": "Buscar: ",
                                 "sLengthMenu": "Mostrar _MENU_ registros por página",
                                 "sInfo": "Mostrando pagina _PAGE_ de _PAGES_",
                                 "sZeroRecords": "No existen registros",
                                 "sInfoEmpty": "",                        
                                 "oPaginate": {
                                     "sPrevious": "Anterior",
                                     "sNext": "Siguiente"
                                   }
                               }
                         }); 
                     }     
                     else{
                         $('.dataTables-example').DataTable();
                     }

                     $("#listaProveedores .editProv").click(function(){
                         loadDataUpdate($(this));
                     });

                     $("#listaProveedores .deleteProv").click(function(){
                         deleteProveedor($(this));
                     });

                }, 1000);
            }    
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log('error al cargar los usuarios loadUsers()/index.php');
        }
    });

}

function deleteProveedor(element){    
    var name = $(element).data("nombre");
    var proveedor_id = $(element).data("proveedor_id");    
    swal({
        title: "¿Estas seguro?",
        text: "Se va a eliminar el proveedor " + name,
        type: "warning",
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Borrar",
        closeOnConfirm: false
    }, function () {
        swal("Borrado!", "Se ha borrado el usuario " + name, "success", "#DD6B55");
        deleteProveedorAction(proveedor_id);
    });
}

function deleteProveedorAction(proveedor_id){    
    $.ajax({
            url: "ajax/deleteProveedor.php",
            type: "post",
            data: {
                proveedor_id : proveedor_id                
            },
            success: function (response) {            
                $("#myModal2").modal('hide');    
                swal({
                    title: "Eliminado!",
                    text: "Proveedor eliminado correctamente!",
                    type: "success"
                }, function () {                                        
                    setTimeout(function(){
                        loadProveedores();                    
                    }, 1000);
                    
                });

            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log('error al cargar los proveedores loadProveedores()/index.php');
            }
        });
}

function loadDataUpdate(element){
    $("#myModal2 #proveedor_id").val($(element).data("proveedor_id"));
    $("#myModal2 #address_id").val($(element).data("address_id"));
    $("#myModal2 #nombre").val($(element).data("nombre"));
    $("#myModal2 #telefono").val($(element).data("telefono"));
    $("#myModal2 #email").val($(element).data("email"));
    $("#myModal2 #calle").val($(element).data("calle"));
    $("#myModal2 #numExt").val($(element).data("numext"));
    $("#myModal2 #numInt").val($(element).data("numint"));
    $("#myModal2 #colonia").val($(element).data("colonia"));
    $("#myModal2 #municipio").val($(element).data("municipio"));
    $("#myModal2 #cp").val($(element).data("cp"));
    $("#myModal2 #estado").val($(element).data("estado"));
        
}


