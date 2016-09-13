<?php
    include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
    //include $pathProy.'login/session.php';
    include $pathProy.'/header.php';
    include $pathProy.'/menu.php';
?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Nueva Campa&ntilde;a</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">Campa&ntilde;a</a>
                </li>
                <li class="active">
                    <strong>Nueva Campa&ntilde;a</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <button class="btn btn-danger btn-xs" id="cancelar" type="button">Cancelar</button>&nbsp;&nbsp; <button class="btn btn-primary btn-xs" id="guardar" type="button">Guardar Campaña</button>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content">

	<div class="row">
           <label class="col-sm-2 control-label">Campa&ntilde;a</label>
			<div class="col-sm-12" ><input type="text" class="form-control" id="nombre" name="nombre"></div>
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content no-padding">

                        <div class="summernote" id="textHtml">
                            
                        </div>

                    </div>
                </div>
                
            </div>
            </div>
           </div>
           
<script src="<?php echo $raizProy?>js/plugins/summernote/summernote.min.js"></script>
<script>
$(document).ready(function()
{
	$("#nombre").focus();
	$('#textHtml').summernote();

	$( "#cancelar" ).click(function()
	{
		var url="index.php";
		$(location).attr("href", url);
	});

	$("#guardar").click(function()
	{
		var nombre=$("#nombre").val();
		var aHTML=$("#textHtml").code();

		if(nombre=='')
		{
			alert("Debe de agregar un Nombre");
			$("#nombre").focus();
		}
		else if(aHTML=='')
		{
			alert("Debe de agregar Contenido");
			$("#textHtml").focus();
		}
		else
		{
				var url="guardar_campana.php";
		 
			$.ajax(
			{
		    	type: "POST",
		        url: url,
		        data: {nombre:nombre,text:aHTML}, // serializes the form's elements.
		        success: function(data)
		        {
		        	alert("La Campa\u00f1a ha sido guardada"); // show response from the php script.
		        	var url="index.php";
		    		$(location).attr("href", url);
				}
			});
		}
	});
});

</script>


   

<?php
    include $pathProy.'footer.php';
?>