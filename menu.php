<?php
if (!isset($_SESSION)) {
    session_start();
}


require_once($_SERVER["REDIRECT_PATH_CONFIG"].'ventas/models/class.Ventas.php');
$instVentas = new Ventas();

$numVentas = count($instVentas->obtenerVentas());
$numVentasEntregadas = count($instVentas->obtenerVentas(1));

$numApartados = count($instVentas->obtenerApartados());
$numApartadosVencidos = count($instVentas->obtenerApartados(0,0));

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
                        <i class="fa fa-money"></i> <span class="nav-label">Gastos</span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/gastos/index.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'gastos/'?>" >Lista de Gastos</a></li>
                        <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/gastos/nuevo/index.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'gastos/nuevo/'?>" >Nuevo Gasto</a></li>
                        <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/gastos/nomina/index.php'){ echo 'active';}?>">
                            <a href="<?php echo $ruta.'gastos/nomina/'?>" >Nomina <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level" >
                                <li>
                                    <a href="<?php echo $ruta.'gastos/nomina/?grupo=DM'?>">Administración</a>
                                </li>
                                <li>
                                    <a href="<?php echo $ruta.'gastos/nomina/?grupo=VN'?>">Empleados</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="<?php if (stristr($_SERVER['SCRIPT_NAME'],'/clientes/')){ echo 'active';}?>">
                    <a href="<?php echo $ruta.'clientes/'?>">
                        <i class="fa fa-users"></i> <span class="nav-label">Clientes</span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/clientes/index.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'clientes/index.php'?>" >Lista de Clientes</a></li>
                        <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/clientes/nuevo_cliente.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'clientes/nuevo_cliente.php'?>" >Nuevo Cliente</a></li>
                    </ul>
                </li>
                <li class="<?php if (stristr($_SERVER['SCRIPT_NAME'],'/publicidad/')){ echo 'active';}?>">
                    <a href="<?php echo $ruta.'publicidad/'?>">
                        <i class="fa fa-envelope"></i> <span class="nav-label">Campañas</span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/publicidad/index.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'publicidad/index.php'?>" >Lista de campañas</a></li>
                        <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/publicidad/nueva_campana.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'publicidad/nueva_campana.php'?>" >Nueva campaña</a></li>
                        <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/publicidad/enviar_campana.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'publicidad/enviar_campana.php'?>" >Enviar campaña</a></li>
                    </ul>
                </li>

                <li class="<?php if (stristr($_SERVER['SCRIPT_NAME'],'/proveedores/') && !stristr($_SERVER['SCRIPT_NAME'],'/proveedores/grid.php')){ echo 'active';}?>">
                    <a href="<?php echo $ruta.'inventarios/'?>">
                        <i class="fa fa-truck"></i> <span class="nav-label">Proveedores</span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/proveedores/index.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'proveedores/'?>" >Lista de proveedores</a></li>
                        <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/proveedores/pedidos.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'proveedores/pedidos.php'?>" >Lista de pedidos</a></li>
                    </ul>
                </li>

                <li class="<?php if ((stristr($_SERVER['SCRIPT_NAME'],'/inventarios/') || stristr($_SERVER['SCRIPT_NAME'],'/productos/index.php') || stristr($_SERVER['SCRIPT_NAME'],'/productos/etiquetas.php') || stristr($_SERVER['SCRIPT_NAME'],'/productos/nuevo_producto.php')  ) && !stristr($_SERVER['SCRIPT_NAME'], '/inventarios/sucursales/index.php')){ echo 'active';}?>">
                    <a href="<?php echo $ruta.'inventarios/'?>">
                        <i class="fa fa-line-chart"></i> <span class="nav-label">Inventarios</span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/productos/nuevo_producto.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'productos/nuevo_producto.php'?>" >Nuevo producto</a></li>
                        <li class="<?php if (stristr($_SERVER['SCRIPT_NAME'],'/productos/')){ echo 'active';}?>">
                        <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/productos/index.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'productos/'?>" >Lista de productos</a></li>                        
                        <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/inventarios/index.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'inventarios/'?>" >Lista de movimientos</a></li>
                        <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/productos/etiquetas.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'productos/etiquetas.php'?>" >Etiquetas</a></li>
                    </ul>
                </li>

                <li class="<?php if (stristr($_SERVER['SCRIPT_NAME'],'/proveedores/grid.php') || (stristr($_SERVER['SCRIPT_NAME'],'/productos/') && !stristr($_SERVER['SCRIPT_NAME'],'/productos/index.php') && !stristr($_SERVER['SCRIPT_NAME'],'/productos/nuevo_producto.php') && !stristr($_SERVER['SCRIPT_NAME'],'/productos/etiquetas.php') )|| stristr($_SERVER['SCRIPT_NAME'],'sucursales/index.php')){ echo 'active';}?>">
                    <a href="<?php echo $ruta.'proveedores/'?>">
                        <i class="fa fa-list"></i> <span class="nav-label">Catalogos</span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/proveedores/grid.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'proveedores/grid.php'?>" >Catalogo de productos</a></li>                        

                        <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/inventarios/sucursales/index.php' || $_SERVER['SCRIPT_NAME'] == '/productos/materiales/index.php' || $_SERVER['SCRIPT_NAME'] == '/productos/colores/index.php' ||  $_SERVER['SCRIPT_NAME'] == '/productos/categorias/index.php' || $_SERVER['SCRIPT_NAME'] == '/productos/versiones/index.php'){ echo 'active';}?>">
                            <a href="<?php echo $ruta.'gastos/nomina/'?>" >Atributos<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level" >
                                <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/inventarios/sucursales/index.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'inventarios/sucursales/'?>" >Sucursales</a></li>
                                <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/productos/materiales/index.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'productos/materiales/'?>" >Materiales</a></li>
                                <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/productos/colores/index.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'productos/colores/'?>" >Colores</a></li>
                                <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/productos/categorias/index.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'productos/categorias/'?>" >Categorias</a></li>
                                <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/productos/versiones/index.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'productos/versiones/'?>" >Versiones</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="<?php if (stristr($_SERVER['SCRIPT_NAME'],'/ventas/')){ echo 'active';}?>">
                    <a href="<?php echo $ruta.'ventas/'?>">
                        <i class="fa fa-shopping-cart"></i> <span class="nav-label">Ventas</span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/ventas/index.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'ventas/index.php'?>" >Nueva Venta</a></li>

                        <li class="<?php if ( stristr($_SERVER['SCRIPT_NAME'],'/ventas/listaVentasEntregadas.php') || stristr($_SERVER['SCRIPT_NAME'],'/ventas/listaVentasPorEntregar.php')){ echo 'active';}?>">
                            <a href="<?php echo $ruta.'ventas/'?>" >Lista de ventas<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level" >
                                <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/ventas/listaVentasPorEntregar.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'ventas/listaVentasPorEntregar.php'?>" >Por Entregar <span class="label label-danger pull-right"><?php echo $numVentas?></span></a></li>
                                <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/ventas/listaVentasEntregadas.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'ventas/listaVentasEntregadas.php'?>" >Entregadas <span class="label label-primary pull-right"><?php echo $numVentasEntregadas?></span></a></li>
                            </ul>
                        </li>
                        <li class="<?php if ( stristr($_SERVER['SCRIPT_NAME'],'/ventas/listaApartadosVigentes.php') || stristr($_SERVER['SCRIPT_NAME'],'/ventas/listaApartadosVencidos.php')){ echo 'active';}?>">
                            <a href="<?php echo $ruta.'ventas/'?>" >Lista de apartados<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level" >
                                <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/ventas/listaApartadosVigentes.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'ventas/listaApartadosVigentes.php'?>" >Vigentes <span class="label label-primary pull-right"><?php echo $numApartados?></span></a></li>
                                <li class="<?php if ($_SERVER['SCRIPT_NAME'] == '/ventas/listaApartadosVencidos.php'){ echo 'active';} ?>"><a href="<?php echo $ruta.'ventas/listaApartadosVencidos.php'?>" >Vencidos <span class="label label-danger pull-right"><?php echo $numApartadosVencidos?></span></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="<?php if (stristr($_SERVER['SCRIPT_NAME'],'/tablero_resumen/')){ echo 'active';}?>">
                    <a href="<?php echo $ruta.'tablero_resumen/'?>">
                        <i class="fa fa-th"></i> <span class="nav-label">Tablero Resumen</span>
                    </a>
                </li>
                <li class="<?php if (stristr($_SERVER['SCRIPT_NAME'],'/calendario/')){ echo 'active';}?>">
                    <a href="<?php echo $ruta.'calendario/'?>">
                        <i class="fa fa-calendar"></i> <span class="nav-label">Calendario</span>
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
                        <span class="m-r-sm text-muted welcome-message">Bienvenido a Globmint. &nbsp;<b><?php echo $_SESSION['login_session']['sucursal_name']; ?></b></span>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info"  href="<?php echo $ruta.'proveedores/grid.php'?>">
                            <i class="fa fa-th"></i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info"  href="<?php echo $ruta.'ventas'?>">
                            <i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;&nbsp;
                            <span class="label label-warning">
                                    <?php
                                    $numProd = 0;
                                    if(isset($_SESSION['punto_venta']) && is_array($_SESSION['punto_venta']['Productos'])){
                                        $numProd =  count($_SESSION['punto_venta']['Productos']);
                                    }
                                    echo $numProd;
                                    ?>
                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $ruta.'login/logout.php'?>">
                            <i class="fa fa-sign-out"></i> Salir
                        </a>
                    </li>
                </ul>
            </nav>
        </div>