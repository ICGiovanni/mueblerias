$(document).ready(function(){                        
    
    $('.product-images').slick({
        dots: true
    });
   
    /*$(".addCarrito").click(function(){
       var lineId = $(this).data('line');
       $("#"+lineId).show();            
    });*/
        
    $(".addPuntoVenta").click(function(){  
        var id = $(this).attr('id');
        var cantId = $(this).data('id');
        swal({   
            title: "Agregar a punto de venta",   
            text: "Desea agregar el producto al punto de venta",   
            type: "info",   
            showCancelButton: true,   
            closeOnConfirm: true,   
            showLoaderOnConfirm: true
        }, function(){
            
            $.ajax({
                url: "ajax/addPuntoVenta.php",
                type: "post",
                data: {
                    id: cantId,
                    sku : $("#"+id).data('sku'),
                    modelo : $("#"+id).data('modelo'),
                    cantidad : $("#cantidad_"+cantId).val(),
                    precio : $("#"+id).data('precio'),
                    imagen : $("#"+id).data('imagen')
                },
                success: function (response) {            
                    $("#line_"+cantId).css("visibility","visible");    
                    console.log(response);
                    /*swal({
                        title: "Actualizado!",
                        text: "Producto agregado correctamente!",
                        type: "success"
                    });*/            
                },
                error: function(jqXHR, textStatus, errorThrown) {
                   swal("Error, intente nuevamente");
                }
            });                                                                 
        });
    });
    
    $(".removePuntoVenta").click(function(){  
        var id = $(this).attr('id');  
        var cantId = $(this).data('id');
        
        swal({   
            title: "Quitar de punto de venta",   
            text: "Desea quitar el producto del punto de venta",   
            type: "error",   
            showCancelButton: true,   
            closeOnConfirm: true,   
            showLoaderOnConfirm: true
        }, function(){

            $.ajax({
                url: "ajax/removePuntoVenta.php",
                type: "post",
                data: {
                    id : cantId,
                    sku : $("#"+id).data('sku')                    
                },
                success: function (response) {  
                    //console.log(response);
                    window.location.href = 'grid.php';
                    /*swal({
                        title: "Actualizado!",
                        text: "Producto agregado correctamente!",
                        type: "success"
                    });*/            
                },
                error: function(jqXHR, textStatus, errorThrown) {
                   swal("Error, intente nuevamente");
                }
            });                                                                 
        });
    });
    
});
