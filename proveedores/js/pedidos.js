var totalPedido=0;
var productosPedido = [];
var productosBorrar = [];

$(document).ready(function(){                        
    
    $('.input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: 'yyyy/mm/dd',
    });   
    
    if($('.dataTables-example').lenght){
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
    
    $("#listaPedidos .deletePedido").click(function(){
        deletePedido($(this));
    });

    $("#listaPedidos .editPedido").click(function(){
        loadDataUpdate($(this));
    });
    
    $("#btn_editar_pedido").click(function(){
        updatePedido();
    });
    
    $("#proveedor").change(function(){
        $("#form_proveedor").submit();
    });
    
    $("#agregarProducto").click(function(){
        
        var idProd = $("#selectProducto").val();
        
        if(idProd!=0){
            agregarProductoPedido(idProd);
        }
    });
    
    $("#actualizar_pedido").click(function(){        
        $('#myModal').modal('hide');
    });
    
    $("#recibir_pedido").click(function(){
        var idPedido = $("#pedido_id").val();
        var productos = $("#productos_ped").val();
        
        savePedidosInventario(idPedido, productos);
    });
    
    $("#crearPedido").click(function(){
        
        var proveedor = $("#proveedor").val();
        var sucursal = $("#selectSucursal").val();
        var fechaEntrega = $("#fechaEntrega").val();
        var fechaRecordatorio = $("#fechaRecordatorio").val();        
        var observaciones = $("#observaciones").val();
        var email = $("#email").val();

        $.ajax({
            url: "ajax/savePedido.php",
            type: "post",
            data: {
                proveedor : proveedor,
                sucursal : sucursal,
                fechaEntrega : fechaEntrega,
                fechaRecordatorio :  fechaRecordatorio,                
                observaciones : observaciones,
                email : email,
                productos :  JSON.stringify(productosPedido)
            },
            success: function (response) {            
                console.log(response);
                swal({
                    title: "Guardado!",
                    text: "Pedido guardado correctamente!",
                    type: "success"
                }, function () {                    
                    window.location.href = 'pedidos.php';
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
               //console.log('error al cargar los proveedores loadProveedores()/index.php');
            }
        });
    });
});

function agregarProductoPedido(idProd){
    element = $("#producto_"+idProd);
    
    var sku = $(element).data('sku');
    var modelo = $(element).data('modelo');
    var precio = $(element).data('precio');
    totalPedido = totalPedido+precio;
    $("#listaProductos").append(
                                "<tr id='row_"+idProd+"'>"+
                                    "<td>"+sku+"</td>"+
                                    "<td>"+modelo+"</td>"+
                                    "<td><input type='text' name='cantidad' id='cantidad_"+idProd+"' value='1'></td>"+
                                    "<td class='text-right'>"+precio.toFixed(2)+"</td>"+
                                "</tr>"
                                );
    $("#totalPedido").html(totalPedido.toFixed(2));   
    productosPedido.push(idProd);        
}

function savePedidosInventario(idPedido, productos){
    
    $.ajax({
        url: "ajax/savePedidoInventario.php",
        type: "post",
        data: {
            pedido_id : idPedido,
            productos : productos            
        },
        success: function (response) {            
            console.log('response'+response);
            
            swal({
                title: "Registrado!",
                text: "Productos registrados en inventario correctamente!",
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
    
    
    productosBorrar = [];
    
    var productos = $(element).data("productos");    
    var pedido_id = $(element).data("pedido");
    
    $("#pedido_id").val('');
    $("#productos_ped").val('');
    
    $("#pedido_id").val(pedido_id);
    $("#productos_ped").val(JSON.stringify(productos));
    
    var html = '';
    $.each(productos, function( index, value ) {
        console.log(value);
        html += ('<tr><td style="padding: 5px"><button class="btn btn-danger btn-xs borrarProductoTabla" type="button" data-pedido="'+value.pedido_id+'" data-producto="'+value.producto_id+'" ><i class="fa fa-trash"></i></button></td><td>'+value.stock+'</td><td>&nbsp;'+value.producto_sku+'</td><td>&nbsp;'+value.producto_name+'</td></tr>');
    });
    
    $("#productosEnPedido").html(html);
    
    
    $(".borrarProductoTabla").click(function(){
        
        var idProducto = $(this).data('producto');
        var idPedido = $(this).data('pedido');                        
        
        borrarProductosPedido(idProducto, idPedido, this);
        
    });
}


function borrarProductosPedido(idProducto, idPedido, elem){
    $(elem).parent().parent().remove();    
}

function deletePedido(element){
    var producto = $(element).data("producto");
    var pedido_id = $(element).data("pedido");    
    
    swal({
        title: "¿Esta usted seguro?",
        text: "Se va a eliminar el pedido " + pedido_id ,
        type: "warning",
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Borrar",
        closeOnConfirm: false
    }, function () {
        swal("Borrado!", "Se ha borrado el pedido " + pedido_id, "success", "#DD6B55");
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