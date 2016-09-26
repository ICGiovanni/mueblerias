
$(document).ready(function(){                        
    
    $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });
    
    $("#agregarTelefono").click(function(){
        $("#newPhone").append("<div>"+
                                "<div class='clear'>&nbsp;</div>"+
                                "<div class='row'><div class='col-md-3'>&nbsp;</div>"+
                                "<div class='col-md-2'><input class='form-control' name='telefono[]' value='' type='text'></div>"+
                                "<div class='col-md-2'>"+
                                    "<select id='phoneType' name='phoneType[]' class='form-control'>"+
                                        "<option value='1'>Celular</option>"+
                                        "<option value='2'>Casa</option>"+
                                        "<option value='3'>Oficina</option>"+
                                        "<option value='4'>Otro</option>"+
                                    "</select>"+
                                "</div>"+
                                "<div class='col-md-1'><button class='form-control deletePhone' value='' type='button'><i class='fa fa-times'></i></button></div>"+
                               "</div></div>");
                       
        $(".deletePhone").click(function(){            
            $(this).parent().parent().parent().remove();
        });               
    });
    
    $(".deletePhone").click(function(){            
        $(this).parent().parent().parent().remove();
    });      
    
    $("#cancelarUser").click(function(){
        cleanFileds();
        window.location.href = 'index.php';
    });
    
    $("#updateUser").click(function(){            
        window.location.href = 'index.php';
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
    var secondLastName = $('#secondLastName').val();
    
    var email = $('#email').val();
    var password = $('#password').val();
    var perfil = $('#perfil').val();            
    var sucursal = $('#sucursal').val();
    
    var telefonos = new Array();
    var tipos = new Array();    
    
    $("input[name='telefono[]']").each(function(){        
        telefonos.push($(this).val());
    });   
    $("select[name='phoneType[]']").each(function(){                
        tipos.push($(this).val());
    });    
    
    var salario = ($('#salario').val()!=='') ? $('#salario').val() : 0;
    var fechaNacimiento = $('#fechaNacimiento').val();
    var comision = ($('#comision').val() !=='') ? $("#comision").val() : 0;        
    
    var calle = $('#calle').val();
    var numExt = $('#numExt').val();
    var numInt = $('#numInt').val();
    var colonia = $('#colonia').val();
    var cp = $('#cp').val();
    var municipio = $('#municipio').val();
    var estado = $('#estado').val();
    
    $.ajax({
        url: "ajax/saveUser.php",
        type: "post",
        data: {
            firstName : firstName,
            lastName : lastName,
            secondLastName : secondLastName,
            email : email,
            password : password,
            perfil : perfil,    
            sucursal : sucursal,
            telefonos : JSON.stringify(telefonos),
            tipos : JSON.stringify(tipos),
            salario : salario,
            fechaNacimiento : fechaNacimiento,
            comision : comision,
            calle: calle,
            numExt: numExt,
            numInt: numInt,
            colonia: colonia,
            cp: cp,
            municipio: municipio,
            estado: estado            
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
