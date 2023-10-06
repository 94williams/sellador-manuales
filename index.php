<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sellador Manuales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
     
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalSellarManual">
    Sellar Manual
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modalSellarManual" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
      <div class="modal-header custom-color" style="color:white">
      <h5 class="modal-title">Sellar Manual</h5>
      </div>
      <div class="modal-body">
      
      <!-- Begin Page Content -->
      <div class="container-fluid">
      
      <form class="row g-3" action="sellar-manual.inc.php" method="post" enctype="multipart/form-data">
      <div class="form-group col-12">
      <label for="exampleInputEmail1">Registro</label>
      <input type="text" class="form-control" name="sellar-manual_registro" id="inText">
      </div>
      <div class="form-group col-12">
      <label for="exampleInputEmail1">Altura</label>
      <input type="text" class="form-control" name="medida_altura" id="altura">
      </div>
      <div class="form-group col-12">
      <input type="file" name="archivo_pdf" accept=".pdf">
      </div>
      <button type="submit" class="btn btn-user btn-secondary btn-block custom-color" name="submit">Sellar</button>
      </form>

      </div>
      </div>
      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>