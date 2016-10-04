$(document).ready(function(){                        
    
    $("#catalogoProductos .nuevoPedido").click(function(){
        var producto_id = $(this).data('producto');
        var categorias = $(this).data('categoria');
        var colores = $(this).data('color');
        var materiales = $(this).data('material');
        var proveedor = $(this).data("proveedor");
        var telefono = $(this).data("telefono");
        
        $("#categoria_mueble").html(categorias);
        $("#color_mueble").html(colores);
        $("#material_mueble").html(materiales);
        $("#nombre_proveedor").html(proveedor);        
        $("#telefono").html(telefono);
        
        $("#producto_id").val(producto_id);
    });
    
    $("#btn_guardar_pedido").click(function(){
        
        var cantidad = $("#cantidad").val();
        var fecha = $("#fecha").val();
        var costo = $("#costo").val();
        var observaciones = $("#observaciones").val();
        var producto_id = $("#producto_id").val();
        var proveedor_id = $("#proveedor_id_update").val();
        $.ajax({
            url: "ajax/savePedido.php",
            type: "post",
            data: {
                producto_id : producto_id,
                proveedor_id : proveedor_id,
                cantidad : cantidad,
                fecha : fecha,
                costo : costo,
                observaciones : observaciones
            },
            success: function (response) {            
                swal({
                    title: "Guardado!",
                    text: "Pedido guardado correctamente!",
                    type: "success"
                }, function () {                                        
                    $("#myModal3").modal('hide');                 
                });            
                
            },
            error: function(jqXHR, textStatus, errorThrown) {
               //console.log('error al cargar los proveedores loadProveedores()/index.php');
            }
        });
    });

});

