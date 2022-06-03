<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie-edge">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <style type="text/css">
      .borde{
        background-color: #1f4d7e;
        height: inherit;

      }

    </style>

    <title>Asistencia</title>
  </head>


  <body>

    <div class="header" style="height: 70px">
      <div class="col-12 borde">

        <center><h1>Sistema de asistencia</h1></center>
      </div>
    </div>

<br>




    <div class="container" >

        <br>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
            Añadir empresa
          </button>






      <div class="row ">

        <div class="container mt-4 align-items-center">


        	<div class="row">

            <?php

            $conectar= pg_connect("host=127.0.0.1 dbname=asistencia port=5432 user=postgres password=lyddtees1994") or die ("Error de Conexion".pg_last_error());

            if(!$conectar){
              echo "No se pudo conectar con el servidor";
            }else {
              // code..

            $sql="SELECT id_empresa, em_nombre FROM empresa;";

            $result = pg_query($conectar, $sql);

           while ($empresa = pg_fetch_assoc($result)) {
                        $id_num=$empresa['id_empresa'];
                        $imagen='img/imagen'."$id_num".'.jpg';
                        echo"  <div class='col-lg-4'>";

                        echo" <div class='card' style='width: 23rem;'> ";

                        echo"<h5 class='card-header'><center>".$empresa['em_nombre']."</center></h5>";


                          echo"<div class='card-body-justify'>";
                          echo"<a href='kardex.php?empresa=$id_num'><img src='$imagen' class='card-img-top' alt='...' height='300'></a>";
                          echo"</div>";

                        echo"<div class='card-footer bg-transparent border'>";
                        echo      "<a href='#' class='card-link' data-target='#modalIMG' data-toggle='modal'>Editar</a>";
                        echo        "<a href='borrar_empresa.php?empresa=$id_num' class='card-link justify-content-end'>Eliminar</a>";

                        echo      "</div>";

                        echo    "</div>";

                        echo  "</div>";

            }
            pg_close($conectar);}
             ?>


        	</div>


        </div>

        <!-- modal editar -->

        <div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="modalIMG" role="dialog" tabindex="-1">



          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                <div class="row">

                  <div class="col-6">

                    <form>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nombre Empresa:</label>
                        <input type="text" class="form-control" id="recipient-name">
                      </div>
                      <div class="form-group">
                        <label for="message-text" class="col-form-label">email:</label>
                        <input type="text" class="form-control" id="message-text">
                      </div>
                    </form>

                  </div>

                  <div class="col-6 ">
                    <img src="upload.png" id="preview" class="img-thumbnail">
                      <div id="msg"></div>
                      <form method="post" id="image-form">
                        <input type="file" name="img[]" class="file" accept="image/*">
                      </form>



                  </div>

              </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Actualizar</button>
              </div>
            </div>
          </div>
    </div>
<!-- modal editar termina -->

<!-- modal añadir empresa -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Agregar Empresa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form action="crea_empresa.php" method="post" enctype="multipart/form-data">

    <div class="modal-body">

        <div class="form-row ">

          <div class="col-6">


              <div class="form-group">
                <label for="recipient-name" class="col-form-label" >Nombre Empresa:</label>
                <input type="text" name="nombre_emp" class="form-control" id="recipient-name">
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">email:</label>
                <input type="text" name="email" class="form-control" id="message-text">
              </div>


          </div>

          <div class="col-6 ">
            <img src="upload.png" id="preview" class="img-thumbnail">
              <div id="msg"></div>

                <input type="file" name="imagen" class="file" accept="image/*">

          </div>

        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" name="submit" class="btn btn-primary">Agregar</button>
      </div>
      </form>
    </div>


  </div>
</div>
<!-- termina nueva empresa-->


    <!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript">
    $(document).on("click", ".browse", function() {
      var file = $(this).parents().find(".file");
      file.trigger("click");
    });
    $('input[type="file"]').change(function(e) {
      var fileName = e.target.files[0].name;
      $("#file").val(fileName);

      var reader = new FileReader();
      reader.onload = function(e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview").src = e.target.result;
      };
      // read the image file as a data URL.
      reader.readAsDataURL(this.files[0]);
    });
    </script>


  </body>
</html>
