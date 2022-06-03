 <!doctype html>
<html lang="es">
<?php $conectar= pg_connect("host=127.0.0.1 dbname=asistencia port=5432 user=postgres password=lyddtees1994") or die ("Error de Conexion".pg_last_error()); ?>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="css/nav-vertical.css">

<!--buscador-->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <title>menu principal</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-global sticky-top justify-content-center" style="background-color: #1f4d7e;">
      <!-- Navbar content -->
      <a class="navbar-brand" href="empresa.php">
        <img src="promonitor.jpg" width="60" height="60" class="d-inline-block align-top" alt="70px">

      </a>

      <a class="navbar-brand mx-auto font-weight-bold text-monospace " href="#"><h2>Promonitor</h2></a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item ml-auto">
                <a class="nav-link" href="#">Cerrar Sesion</a>
            </li>
        </ul>
      </div>
    </nav>


    <div class="sidebar-container">

      <ul class="sidebar-navigation">
        <li>
          <a href="kardex.php">
            <i class="fa fa-home active" aria-hidden="true" ></i> Kardex
          </a>
        </li>

        <!--<li>
            <a href="menu.html?empresa=1">
              <i class="fa fa-tachometer" aria-hidden="true"></i> Reporte General
            </a>
          </li> -->

        <li>
          <a href="personal.php?empresa=1">
            <i class="fa fa-users" aria-hidden="true"></i> Personal
          </a>
        </li>
        <li>
          <a href="sucursal.php?empresa=1">
            <i class="fa fa-cog" aria-hidden="true"></i> Sucursal
          </a>
        </li>
        <li>
          <a href="turnos.php">
            <i class="fa fa-info-circle" aria-hidden="true"></i> Turnos
          </a>
        </li>
      </ul>
    </div>

    <div class="content-container">

      <div class="container-fluid" >

        <div class="container">

          <center><h2>Kardex</h2></center>

          <br>


          <div class="row">

            <div class="col-3">
              <select class="js-example-basic-single" onchange="location = this.value;">
                  <option value="personal.php?empresa=1&contacto=sdsads" selected>Sucursales</option>
                  <?php
                  if(!$conectar){
                    echo "No se pudo conectar con el servidor";
                  }else {
                    // code..

                  $sql="SELECT id_sucursal,suc_nombre
                          FROM sucursal b
                              INNER JOIN empresa a ON b.id_empresa = a.id_empresa
                          WHERE a.id_empresa=1;";

                  $result = pg_query($conectar, $sql);

                  while ($sucursalOption = pg_fetch_assoc($result)) {

                   echo"<option value='kardex.php?empresa=1&sucursal=".$sucursalOption[id_sucursal]."'>".$sucursalOption['suc_nombre']."</option>";
                  }
                  }
                   ?>

                  </select>
            </div>


            <div class="col-3">

              <select class="js-example-basic-single" onchange="location = this.value;">
                  <option value="personal.php?empresa=1&contacto=sdsads" selected>Persona</option>
                  <?php
                  if(!$conectar){
                    echo "No se pudo conectar con el servidor";
                  }else {
                    // code..

                    $sql1="SELECT id_personal,ci,ext_ci,nombres,apellido_paterno,apellido_materno
                          FROM personal a
                                  INNER JOIN sucursal b ON a.id_sucursal = b.id_sucursal
                                  INNER JOIN puesto c ON a.id_puesto = c.id_puesto
                                  INNER JOIN horario_sucursal d ON a.id_horario_sucursal = d.id_horario_sucursal
                                              INNER JOIN horario x ON d.id_horario = x.id_horario INNER JOIN turno z ON x.id_turno = z.id_turno
                                                    WHERE b.id_sucursal='$_GET[sucursal]';";

                    $result1 = pg_query($conectar, $sql1);

                  while ($personalOption = pg_fetch_assoc($result1)) {
                    $personal="".$personalOption[ci]." ".$personalOption[nombres]." ".$personalOption[apellido_paterno]." ".$personalOption[apellido_materno]." ";
                   echo"<option value='kardex.php?empresa=1&sucursal=".$_GET[sucursal]."&personal=".$personalOption[id_personal]."'>".$personal."</option>";
                  }

                  }
                   ?>

                  </select>

            </div>

          </div>

<br></br>

<?php
$aux=$_GET['personal'];
if($aux){
  $sql2="SELECT id_personal,ci,ext_ci,nombres,apellido_paterno,apellido_materno
        FROM personal a
                INNER JOIN sucursal b ON a.id_sucursal = b.id_sucursal
                INNER JOIN puesto c ON a.id_puesto = c.id_puesto
                INNER JOIN horario_sucursal d ON a.id_horario_sucursal = d.id_horario_sucursal
                            INNER JOIN horario x ON d.id_horario = x.id_horario INNER JOIN turno z ON x.id_turno = z.id_turno
                                  WHERE b.id_sucursal='$_GET[sucursal]' AND a.id_personal='$_GET[personal]' ;";

    $result2 = pg_query($conectar, $sql2);
    $kardexNombre = pg_fetch_assoc($result2);
    $nombres=$kardexNombre['nombres']." ".$kardexNombre['apellido_paterno']." ".$kardexNombre['apellido_materno'];
    echo"<center><h3>".$nombres."</h3></center> ";
}





?>
<br>

        </div>

        <table id="tabla" class="table table-bordered" >
          <thead class="thead-dark">
            <tr>
              <th scope="col">Fecha</th>
              <th scope="col">Tol. Ant. Efec.</th>
              <th scope="col">Tol. Ret. Efec.</th>
              <th scope="col">Hr. Ing. 1</th>
              <th scope="col">Hr. Sal. 1</th>
              <th scope="col">Min. Ant. 1</th>
              <th scope="col">Min. Ret. 1</th>
              <th scope="col">Hr. Ing. 2</th>
              <th scope="col">Hr. Sal. 2</th>
              <th scope="col">Min. Ant. 2</th>
              <th scope="col">Min. Ret. 2</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>06-09-2021</td>
              <td>45 min.</td>
              <td>30 min.</td>
              <td>8:00</td>
              <td>12:00</td>
              <td>00:30</td>
              <td>00:00</td>
              <td>15:30</td>
              <td>17:45</td>
              <td>00:15</td>
              <td>00:30</td>

            </tr>


          </tbody>

          <tfoot>
            <th scope="col">Fecha</th>
            <th scope="col">Tol. Ant. Efec.</th>
            <th scope="col">Tol. Ret. Efec.</th>
            <th scope="col">Hr. Ing. 1</th>
            <th scope="col">Hr. Sal. 1</th>
            <th scope="col">Min. Ant. 1</th>
            <th scope="col">Min. Ret. 1</th>
            <th scope="col">Hr. Ing. 2</th>
            <th scope="col">Hr. Sal. 2</th>
            <th scope="col">Min. Ant. 2</th>
            <th scope="col">Min. Ret. 2</th>
          </tfoot>
        </table>


        </div>

      </div>

      <?php
      //cierra coneccion servidor
      pg_close($conectar); ?>

    <!-- Optional JavaScript -->


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


    <script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
    </script>


    <script>

    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            var min = parseInt( $('#min').val(), 10 );
            var max = parseInt( $('#max').val(), 10 );
            var age = parseFloat( data[3] ) || 0; // use data for the age column

            if ( ( isNaN( min ) && isNaN( max ) ) ||
                 ( isNaN( min ) && age <= max ) ||
                 ( min <= age   && isNaN( max ) ) ||
                 ( min <= age   && age <= max ) )
            {
                return true;
            }
            return false;
        }
    );



        $('#tabla').DataTable({
        "pagingType": "full_numbers"
        });
        $('#min, #max').keyup( function() {
        table.draw();
        } );

    </script>

  </body>
</html>
