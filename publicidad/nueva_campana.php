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
                <a href="./index.php" class="btn btn-primary">Campa&ntilde;as</a>
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

                        <div class="summernote">
                            
                        </div>

                    </div>
                </div>
                <div class="form-group">
			<div class="col-sm-4 col-sm-offset-10">
			<button class="btn btn-white" id="cancelar" type="button">Cancelar</button>
			<button class="btn btn-primary" id="guardar" type="button">Guardar</button>
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
	$('.summernote').summernote();

	$( "#cancelar" ).click(function()
	{
		var url="index.php";
		$(location).attr("href", url);
	});
});

</script>


   

<?php
    include $pathProy.'footer.php';
?>