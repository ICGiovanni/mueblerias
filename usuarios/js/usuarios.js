
$(document).ready(function(){                        

    loadUsers();     
    
    $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });        
        
});

        
function loadUsers(){
    $.ajax({
        url: "ajax/loadUsers.php",
        type: "post",
        data: {type: 0} ,
        success: function (response) {
           $("#loadUsers").html(response);
           setTimeout(function(){
               $('.dataTables-example').DataTable({
                   "language": {
                        "url": "../js/plugins/dataTables/Spanish.json"
                    }
               });

                /* Init DataTables */
                var oTable = $('#editable').DataTable();
                
                $(".active-user").click(function(){
                   activeUser($(this).attr('id'), $(this).data("status"));                    
                });
                
                $('#loadUsers .borrar-user').click(function () {                            
                    var name = $(this).data("name");
                    var id = this.id;
                    swal({
                        title: "¿Estas seguro?",
                        text: "Se va a eliminar el usuario " + name,
                        type: "warning",
                        showCancelButton: true,
                        cancelButtonText: 'Cancelar',
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Borrar",
                        closeOnConfirm: false
                    }, function () {
                        swal("Borrado!", "Se ha borrado el usuario " + name, "success", "#DD6B55");
                        deleteUser(id);
                    });
                    
                });
           }, 1000)

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log('error al cargar los usuarios loadUsers()/index.php');
        }
    });

}

function activeUser(id, status){
    
    if(id!=1){
        $.ajax({
            url: "ajax/activeUser.php",
            type: "post",
            data: {
                id : id,
                status :  status
            },
            success: function (response) {            
                loadUsers();
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log('error al activar los usuarios loadUsers()/index.php');
            }
        });
    }
    else{
        swal({
            title: "No permitido",
            text: "Este usuario no puede ser desactivado",
            type: "info"
        });
    }
}

function deleteUser(id){
    
    $.ajax({
        url: "ajax/deleteUser.php",
        type: "post",
        data: {
            id : id          
        },
        success: function (response) {
            console.log(response);
            loadUsers();
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log('error al cargar los usuarios loadUsers()/index.php');
        }
    });
    
}
