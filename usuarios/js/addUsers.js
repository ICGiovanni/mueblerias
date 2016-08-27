
$(document).ready(function(){                        
    
    $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });
    
    $("#cancelarUser").click(function(){
        cleanFileds();
        window.location.href = 'index.php';
    });
    
    $("#saveUser").click(function(){            
        saveUser();        
    });

});

function cleanFileds(){
    $('#firstName').val('');
    $('#lastName').val('');
    $('#email').val('');
    $('#password').val('');
    $('#perfil').val(0);
    $('#colaborador').val('');
    $('#sucursal').val(0);
    $('#telefono').val('');
    $('#salario').val('');
    $('#fechaNacimiento').val('');
    $('#comision').val('');
}

function saveUser(){
    var firstName = $('#firstName').val();
    var lastName = $('#lastName').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var perfil = $('#perfil').val();
    
    var colaborador = ($('#colaborador').prop('checked')===true)  ? 1 : 0;
    
    var sucursal = $('#sucursal').val();
    var telefono = $('#telefono').val();
    var salario = ($('#salario').val()!=='') ? $('#salario').val() : 0;
    var fechaNacimiento = $('#fechaNacimiento').val();
    var comision = ($('#comision').val() !=='') ? $("#comision").val() : 0;
    
    
    $.ajax({
        url: "ajax/saveUser.php",
        type: "post",
        data: {
            firstName : firstName,
            lastName : lastName,
            email : email,
            password : password,
            perfil : perfil,
            colaborador : colaborador,
            sucursal : sucursal,
            telefono : telefono,
            salario : salario,
            fechaNacimiento : fechaNacimiento,
            comision : comision
        },
        success: function (response) {
            swal({
                title: "Guardado!",
                text: "Usuario guardado correctamente!",
                type: "success"
            }, function () {
                window.location.href = 'index.php';
            });

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log('error al cargar los usuarios loadUsers()/index.php');
        }
    });
}
