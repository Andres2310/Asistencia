<?php 

$conectar= pg_connect("host=127.0.0.1 dbname=cualquiera port=5432 user=postgres password=*******") or die ("Error de Conexion".pg_last_error());
//verifica la conexion

if(!$conectar){
echo "No se pudo conectar con el servidor";
}else{


   $query="UPDATE sucursal
              SET sucursal_borrado = TRUE
              WHERE id_sucursal='$_GET[sucursal]';";
   pg_query($conectar, $query);

}

pg_close($conectar);
header("Location: sucursal.php?empresa=1");

 ?>
