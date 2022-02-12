<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <table id="tabla" class="table thead-light">
            <thead>
              <tr>
                <th>
                  Codigo
                </th>
                <th>
                  Descripcion
                </th>
                <th>
                  Precio
                </th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <input type="text" id="codigo" class="form-control codigo" value="" />
                </td>
                <td>
                  <input type="text" id="descripcion" class="form-control descripcion" value="" />
                </td>
                <td>
                  <input type="number" id="precio" class="form-control precio" value="" />
                </td>
                <td>
                  <button type="button" class="btn btn-success" id="btnAgregar" onclick="AgregarProducto();">Agregar</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  </body>
</html>
<script>
$(document).ready(function(){
  $("#btnLearn").click(function() {
    $("#btnLearn").hide();
    $('#tabla').hide();

  });
});

function AgregarProducto(){
    var codigo = $('#codigo').val();
    var descripcion = $('#descripcion').val();
    var precio = $('#precio').val();
    alert(codigo+' - '+descripcion+' - '+precio);
}
</script>
