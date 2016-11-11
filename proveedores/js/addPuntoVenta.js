$(document).ready(function(){                        
    
    $('.product-images').slick({
        dots: true
    });
   
   $(".addCarrito").click(function(){
        $(this).parent().parent().parent().addClass("active");            
    });
        
    $(".addPuntoVenta").click(function(){  
        var id = $(this).attr('id');
        swal({   
            title: "Agregar a punto de venta",   
            text: "Desea agregar el producto al punto de venta",   
            type: "info",   
            showCancelButton: true,   
            closeOnConfirm: false,   
            showLoaderOnConfirm: true
        }, function(){

            $.ajax({
                url: "ajax/addPuntoVenta.php",
                type: "post",
                data: {
                    sku : $("#"+id).data('sku'),
                    modelo : $("#"+id).data('modelo'),
                    cantidad : 1,
                    precio : $("#"+id).data('precio')
                },
                success: function (response) {            
                    console.log(response);
                    swal({
                        title: "Actualizado!",
                        text: "Producto agregado correctamente!",
                        type: "success"
                    });            
                },
                error: function(jqXHR, textStatus, errorThrown) {
                   swal("Error, intente nuevamente");
                }
            });                                                                 
        });
    });
    
});
