
$(document).ready(function(){                        
    loadProveedores();  
    
    $.getJSON("../clientes/json/states_json.php",function(result){        
        $.each(result, function(i, field){
            $("#estado").append('<option value="'+field.id_estado+'" >'+field.estado+'</option>');
            $("#myModal2 #estado").append('<option value="'+field.id_estado+'" >'+field.estado+'</option>');
        });        
    });
    
    $("#btn_editar_proveedor").click(function(){
        var nombre = $("#myModal2 #nombre").val();
        var email = $("#myModal2 #email").val();
        var telefono = $("#myModal2 #telefono").val();
        var calle = $("#myModal2 #calle").val();
        var numExt = $("#myModal2 #numExt").val();
        var numInt = $("#myModal2 #numInt").val();
        var colonia = $("#myModal2 #colonia").val();
        var cp = $("#myModal2 #cp").val();
        var municipio = $("#myModal2 #municipio").val();
        var estado = $("#myModal2 #estado").val();                
        var proveedor_id =  $("#myModal2 #proveedor_id").val(); 
        var address_id =  $("#myModal2 #address_id").val(); 
        
        $.ajax({
            url: "ajax/updateProveedor.php",
            type: "post",
            data: {
                address_id : address_id,
                proveedor_id : proveedor_id,
                nombre : nombre,            
                email : email,
                telefono : telefono,
                calle: calle,
                numExt: numExt,
                numInt: numInt,
                colonia: colonia,
                cp: cp,
                municipio: municipio,
                estado: estado            
            },
            success: function (response) {            
                $("#myModal2").modal('hide');    
                swal({
                    title: "Actualizado!",
                    text: "Proveedor actualizado correctamente!",
                    type: "success"
                }, function () {                    
                    //console.log(response);
                    loadProveedores();                    
                });

            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log('error al cargar los proveedores loadProveedores()/index.php');
            }
        });
        
    });
    $("#btn_guardar_proveedor").click(function(){
        var nombre = $("#nombre").val();
        var email = $("#email").val();
        var telefono = $("#telefono").val();
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
                email : email,
                telefono : telefono,
                calle: calle,
                numExt: numExt,
                numInt: numInt,
                colonia: colonia,
                cp: cp,
                municipio: municipio,
                estado: estado            
            },
            success: function (response) {            
                $("#myModal").modal('hide');    
                swal({
                    title: "Guardado!",
                    text: "Proveedor guardado correctamente!",
                    type: "success"
                }, function () {                    
                    loadProveedores();    
                    
                });

            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log('error al cargar los proveedores loadProveedores()/index.php');
            }
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
                
           }, 1000)           
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


