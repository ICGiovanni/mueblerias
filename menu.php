<?php 
    if (!isset($_SESSION)) {
        session_start();
    }
?>

    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <img alt="image" class="img-circle" src="<?php echo $raizProy.$_SESSION['login_session']['url_image']; ?>" height="50px" style="background-color: #FFF"/>
                            <span class="clear">
                                <span class="block m-t-xs"> 
                                    <strong class="font-bold"><?php echo $_SESSION['login_session']['firstName']."&nbsp".$_SESSION['login_session']['lastName'];?></strong>
                                </span> 
                                <span class="text-muted text-xs block"><?php echo $_SESSION['login_session']['profile_name']; ?></span> 
                            </span>
                        </div>
                        <div class="logo-element">
                            <img src="<?php echo $raizProy?>img/logo_globmint.png" class="img-responsive" />
                        </div>
                    </li>      
                    
                    <li class="<?php if (stristr($_SERVER['SCRIPT_NAME'],'/usuarios/')){ echo 'active';}?>">
                        <a href="<?php echo $ruta.'usuarios/index.php'?>">
                            <i class="fa fa-user"></i> <span class="nav-label">Usuarios</span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/usuarios/index.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'usuarios/index.php'?>" >Lista de Usuarios</a></li>
                            <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/usuarios/newUser.php'){ echo 'active';}?>"><a href="<?php echo $ruta.'usuarios/newUser.php'?>" >Nuevo Usuario</a></li>                                                    
                        </ul>
                    </li>  
                    
                    <li class="<?php if (stristr($_SERVER['SCRIPT_NAME'],'/gastos/')){ echo 'active';}?>">
                        <a href="<?php echo $ruta.'gastos/'?>">
                            <i class="fa fa-user"></i> <span class="nav-label">Gastos</span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/gastos/index.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'gastos/'?>" >Lista de gastos</a></li>
                            <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/gastos/nuevo/index.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'gastos/nuevo/'?>" >Nuevo</a></li>
                            <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/gastos/nomina/index.php'){ echo 'active';}?>"><a href="<?php echo $ruta.'gastos/nomina/'?>" >Nomina</a></li>                                                    
                            <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/gastos/proveedores/index.php'){ echo 'active';}?>"><a href="<?php echo $ruta.'gastos/proveedores/'?>" >Proveedores</a></li>                                                    
                        </ul>
                    </li>
					
                   <li class="<?php if (stristr($_SERVER['SCRIPT_NAME'],'/clientes/')){ echo 'active';}?>">
                        <a href="<?php echo $ruta.'clientes/'?>">
                            <i class="fa fa-user"></i> <span class="nav-label">Clientes</span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/clientes/index.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'clientes/index.php'?>" >Lista de Clientes</a></li>
                            <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/clientes/nuevo_cliente.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'clientes/nuevo_cliente.php'?>" >Nuevo</a></li>                                                                                                                                
                        </ul>
                    </li>  
					<li class="<?php if (stristr($_SERVER['SCRIPT_NAME'],'/publicidad/')){ echo 'active';}?>">
                        <a href="<?php echo $ruta.'publicidad/'?>">
                            <i class="fa fa-user"></i> <span class="nav-label">Campañas</span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/publicidad/index.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'publicidad/index.php'?>" >Lista de campañas</a></li>
                            <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/publicidad/nueva_campana.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'publicidad/nueva_campana.php'?>" >Nueva campaña</a></li>
							<li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/publicidad/enviar_campana.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'publicidad/enviar_campana.php'?>" >Enviar campaña</a></li>							
                        </ul>
                    </li>
					
					<li class="<?php if (stristr($_SERVER['SCRIPT_NAME'],'/productos/')){ echo 'active';}?>">
                        <a href="<?php echo $ruta.'productos/'?>">
                            <i class="fa fa-user"></i> <span class="nav-label">Productos</span>
                        </a>
                        <ul class="nav nav-second-level">
							<li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/productos/index.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'productos/'?>" >Lista de productos</a></li>
							<li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/productos/nuevo_producto.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'productos/nuevo_producto.php'?>" >Nuevo producto</a></li>
                            <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/productos/materiales/index.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'productos/materiales/'?>" >Materiales</a></li>
                            <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/productos/colores/index.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'productos/colores/'?>" >Colores</a></li>                                                                                                                                
                            <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/productos/categorias/index.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'productos/categorias/'?>" >Categorias</a></li>    
                        </ul>
                    </li>
					
                    <li class="<?php if (stristr($_SERVER['SCRIPT_NAME'],'/inventarios/')){ echo 'active';}?>">
                        <a href="<?php echo $ruta.'inventarios/'?>">
                            <i class="fa fa-user"></i> <span class="nav-label">Inventarios</span>
                        </a>
                        <ul class="nav nav-second-level">
							<li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/inventarios/sucursales/index.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'inventarios/sucursales/'?>" >Sucursales</a></li>							
                        </ul>
                    </li>
					
                    <li class="<?php if (stristr($_SERVER['SCRIPT_NAME'],'/proveedores/')){ echo 'active';}?>">
                        <a href="<?php echo $ruta.'proveedores/'?>">
                            <i class="fa fa-user"></i> <span class="nav-label">Catalogos</span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/proveedores/index.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'proveedores/'?>" >Lista de proveedores</a></li>                            
                            <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/proveedores/catalogo.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'proveedores/catalogo.php'?>" >Lista de productos</a></li>                            
                            <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/proveedores/pedidos.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'proveedores/pedidos.php'?>" >Lista de pedidos</a></li>                            
                        </ul>
                    </li>
                    
                    <li class="<?php if (stristr($_SERVER['SCRIPT_NAME'],'/calendario/')){ echo 'active';}?>">
                        <a href="<?php echo $ruta.'calendario/'?>">
                            <i class="fa fa-user"></i> <span class="nav-label">Calendario</span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/calendario/index.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'calendario/index.php'?>" >Vista Mensual</a></li>                                                        
                            <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/calendario/nuevo/index.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'calendario/nuevo/'?>" >Nuevo Evento</a></li>                                                        
                        </ul>
                    </li>
                    
                </ul>
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
						<!--
                        <form role="search" class="navbar-form-custom" action="">
                            <div class="form-group">
                                <input type="text" placeholder="Search..." class="form-control" name="top-search" id="top-search">
                            </div>
                        </form>
						-->
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">Bienvenido a Globmint.</span>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                            </a>
                            <ul class="dropdown-menu dropdown-messages">
                                <li>
                                    <div class="dropdown-messages-box">
                                        <a href="profile.html" class="pull-left">
                                            <img alt="image" class="img-circle" src="<?php echo $raizProy?>img/a7.jpg">
                                        </a>
                                        <div class="media-body">
                                            <small class="pull-right">46h ago</small>
                                            <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                            <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="dropdown-messages-box">
                                        <a href="profile.html" class="pull-left">
                                            <img alt="image" class="img-circle" src="<?php echo $raizProy?>img/a4.jpg">
                                        </a>
                                        <div class="media-body ">
                                            <small class="pull-right text-navy">5h ago</small>
                                            <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                            <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>                                                              
                                <li>
                                    <div class="text-center link-block">
                                        <a href="mailbox.html">
                                            <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                            </a>
                            <ul class="dropdown-menu dropdown-alerts">
                                <li>
                                    <a href="mailbox.html">
                                        <div>
                                            <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                            <span class="pull-right text-muted small">4 minutes ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="profile.html">
                                        <div>
                                            <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                            <span class="pull-right text-muted small">12 minutes ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="grid_options.html">
                                        <div>
                                            <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                            <span class="pull-right text-muted small">4 minutes ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="text-center link-block">
                                        <a href="notifications.html">
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo $ruta.'login/logout.php'?>">
                                <i class="fa fa-sign-out"></i> Salir
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>            