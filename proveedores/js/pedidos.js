$(document).ready(function(){                        
    
    $('#data_1 .input-group .date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });   
    
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
    
    $("#listaPedidos .deletePedido").click(function(){
        deletePedido($(this));
    });

    $("#listaPedidos .editPedido").click(function(){
        loadDataUpdate($(this));
    });
    
    $("#btn_editar_pedido").click(function(){
        updatePedido();
    });

});

function updatePedido(){
    var pedido_id = $("#pedido_id").val();
    var cantidad = $("#cantidad").val();
    var fecha = $("#fecha").val();
    var costo = $("#costo").val();
    var observaciones = $("#observaciones").val();
    
    $.ajax({
        url: "ajax/updatePedido.php",
        type: "post",
        data: {
            pedido_id : pedido_id,
            cantidad : cantidad,
            fecha : fecha,
            costo : costo,
            observaciones : observaciones
        },
        success: function (response) {            
            console.log(response);
            
            swal({
                title: "Actualizado!",
                text: "Pedido actualizado correctamente!",
                type: "success"
            }, function () {                                        
                location.reload();                 
            });            
        },
        error: function(jqXHR, textStatus, errorThrown) {
           //console.log('error al cargar los proveedores loadProveedores()/index.php');
        }
    });
}

function loadDataUpdate(element){
    var proveedor = $(element).data("proveedor");
    $("#nombre_proveedor").html(proveedor);
    
    var categorias = $(element).data("categorias");
    $("#categoria_mueble").html(categorias);
    var colores = $(element).data("colores");
    $("#color_mueble").html(colores);
    var materiales = $(element).data("materiales");
    $("#material_mueble").html(materiales);
    
    var telefono = $(element).data("telefono");
    $("#telefono").html(telefono);
    
    var stock = $(element).data("stock");
    $("#cantidad").val(stock);
    
    var fecha = $(element).data("fecha");
    $("#fecha").val(fecha);
    
    var observaciones = $(element).data("observaciones");
    $("#observaciones").val(observaciones);
    
    var costo = $(element).data("costo");
    $("#costo").val(costo);
    
    var pedido_id = $(element).data("pedido");
    $("#pedido_id").val(pedido_id);
    
    
}

function deletePedido(element){
    var producto = $(element).data("producto");
    var pedido_id = $(element).data("pedido");    
    
    swal({
        title: "¿Esta usted seguro?",
        text: "Se va a eliminar el pedido de " + producto ,
        type: "warning",
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Borrar",
        closeOnConfirm: false
    }, function () {
        swal("Borrado!", "Se ha borrado el pedido de " + producto, "success", "#DD6B55");
        deletePedidoAction(pedido_id);
        $(element).parent().parent().parent().remove();
    });
}

function deletePedidoAction(pedido_id){
    $.ajax({
        url: "ajax/deletePedido.php",
        type: "post",
        data: {
            pedido_id : pedido_id                
        },
        success: function (response) {            
            console.log(response);
            swal({
                title: "Eliminado!",
                text: "Pedido eliminado correctamente!",
                type: "success"
            }, function () {                                        
                setTimeout(function(){
                    //loadProveedores();                    
                }, 1000);

            });

        },
        error: function(jqXHR, textStatus, errorThrown) {
           //console.log('error al cargar los proveedores loadProveedores()/index.php');
        }
    });
} 