<?php 

$mensaje = "L�nea 1\r\nL�nea 2\r\nL�nea 3";

// Si cualquier l�nea es m�s larga de 70 caracteres, se deber�a usar wordwrap()
$mensaje = wordwrap($mensaje, 70, "\r\n");

// Enviarlo
echo mail('umedina86@yahoo.com.mx', 'Mi t�tulo', $mensaje);

?>