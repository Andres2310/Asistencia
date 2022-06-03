<?php
$conectar= pg_connect("host=127.0.0.1 dbname=cualquiera port=5432 user=postgres password=**********") or die ("Error de Conexion".pg_last_error());
//verifica la conexion

if(!$conectar){
echo "No se pudo conectar con el servidor";
}


pg_close($conectar);
 ?>
