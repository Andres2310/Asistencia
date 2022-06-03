<?php

$conectar= pg_connect("host=127.0.0.1 dbname=cualquiera port=5432 user=postgres password=******") or die ("Error de Conexion".pg_last_error());
//verifica la conexion
if(!$conectar){
echo "No se pudo conectar con el servidor";
}

$ver_empresa = "SELECT * FROM empresa WHERE em_nombre = '$_POST[nombre_emp]'; ";

// Variable $result hold the connection data and the query
$verificar = pg_query($ver_empresa);

// Variable $count hold the result of the query
$total_col = pg_num_rows($verificar);
//ID TEMPORAL


if($total_col==1){

}else{

  $id_usuario= 1;
  $empresa=$_POST['nombre_emp'];
  $email=$_POST['email'];
  $query="INSERT INTO empresa (id_user, em_nombre, em_email) VALUES ('$id_usuario', '$empresa', '$email');";
  pg_query($conectar, $query);

  $buscar = pg_query($conectar,"SELECT id_empresa FROM empresa WHERE em_nombre='$empresa';");
  $id_empresa = pg_fetch_assoc($buscar);
}
pg_close($conectar);

  if(isset($_POST['submit'])){

    $nombre = $_FILES['imagen']['name'];
    $tmp = $_FILES['imagen']['tmp_name'];
    $error = $_FILES['imagen']['error'];
    $tamaño=$_FILES['imagen']['size'];

    $S_extension = explode('.',$nombre);
    $extension = mb_strtolower(end($S_extension));

    $tiposImg = array('jpg','jpeg','png');
    if (in_array($extension, $tiposImg)) {

      if ($error===0) {
        // code...
        if ($tamaño<1000000) {
          $nuevoNombre = 'imagen'.$id_empresa['id_empresa'].".".$extension;
          $carpeta = 'img/'.$nuevoNombre;
          move_uploaded_file($tmp,$carpeta);
	  header("Location: empresa.php");
    pg_close($conectar);
        }else {
          echo "imagen muy grande";
        }

      }else{
        echo "No se pudo subir la imagen";
      }

    } else {
      echo "Imagen no permitida";
    }

  }

pg_close($conectar);
 ?>
