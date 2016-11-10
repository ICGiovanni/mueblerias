# Proyecto Mueblerias Globmint.

##Configuracion de variable en .htacces **agregar al git-ignore para funcionamiento local
SetEnv PATH_CONFIG "/kunden/homepages/1/d642566705/htdocs/"


## variable para a raiz de archivos
$_SERVER['REDIRECT_PATH_CONFIG'];

##db_descrption: globmint_db
host: db642823290.db.1and1.com
db_name: db642823290
user_name: dbo642823290
password: Gl0bm1nt2016!


/* meter evento
require_once($_SERVER['REDIRECT_PATH_CONFIG'].'/calendario/models/class.Calendario.php');
$objCalendario = new Calendario();
$params = array(
					"evento_nombre"=>"Cita Proveedor",
					"evento_fecha"=>"2016-10-28 06:30:00",
					"evento_desc"=>"Veremos detalles para catalogo 2018",
					"evento_recordatorio_activo"=>"1",
					"evento_recordatorio_fecha"=>"2016-10-28 06:00:00",
					"login_id"=>"1"
				);
$evento_id = $objCalendario->insertEvento($params);
*/

/* editar evento
require_once($_SERVER['REDIRECT_PATH_CONFIG'].'/calendario/models/class.Calendario.php');
$objCalendario = new Calendario();
$params = array(
					"evento_nombre"=>"Cita Proveedor",
					"evento_fecha"=>"2016-10-28 06:30:00",
					"evento_desc"=>"Veremos detalles para catalogo 2018",
					"evento_recordatorio_activo"=>"1",
					"evento_recordatorio_fecha"=>"2016-10-28 06:00:00",
					"evento_id"=>"1"
				);
$return = $objCalendario->editEvento($params);
*/

// variable de inicio de sesión
  $_SESSION['login_session']

// productos

$_SESSION['punto_venta']
array(
    array('product_id'=>1, 'cantidad'=>2, 'precio'=>123.00),
    array('product_id'=>2, 'cantidad'=>1, 'precio'=>123.00)
)    
