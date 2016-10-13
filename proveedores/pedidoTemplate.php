<div class="row">    
    <div class="col-lg-12">                      
        <div class="row">
            <div class="col-md-5 text-left">
                <div><b>Proveedor:</b></div>
                <div id='nombre_proveedor'>&nbsp;</div>  
                <div class="clear">&nbsp;</div>
                <div><b>Telefono:</b></div>
                <div id='telefono'>&nbsp;</div>
            </div>
            <div class="col-md-7">
                <div class="title"><b>Detalle del Mueble</b></div>
                <div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>                                
                                <td>Color</td>
                                <td>Material</td>                            
                            </tr>
                        </thead>    
                        <tr>                            
                            <td id="color_mueble">2</td>
                            <td id="material_mueble">3</td>
                        </tr>
                    </table>
                </div>
            </div>    
        </div>                            
        <hr />
        
        <div class="row">
            <div class="col-md-6">
                <div>Despues de la llamada</div>
                <div class="clear">&nbsp;</div>
                <div class="row">
                    <div class="col-md-7">
                        <label class="control-label">Cantidad solicitada:</label>
                    </div>
                    <div class="col-md-5">                            
                        <input class="form-control" id="cantidad" name="cantidad" value="1" type="number" />                                            
                    </div>                            
                </div> 
                <div class="clear">&nbsp;</div>
                <div><b>Fecha de entrega prometida:</b></div>
                <div class="form-group" id="data_1">            
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input class="form-control" value="" type="text" id="fecha" placeholder="Fecha">
                    </div>
                </div>
                <div class="clear">&nbsp;</div>
                <div class="row">
                    <div class="col-md-7">
                        <label class="control-label">Costo total: $</label>
                    </div>
                    <div class="col-md-5">                            
                        <input class="form-control" id="costo" name="costo" value="1" type="number" />                                            
                    </div>                            
                </div>
            </div>
            <div class="col-md-6">
                <div><b>Observaciones:</b></div>
                <textarea class="form-control" rows="10" id='observaciones'></textarea>
            </div>    
        </div> 
        <div class="clear">&nbsp;</div>
    </div>     
</div>     