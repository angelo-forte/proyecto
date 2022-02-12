<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Mi Proyecto</title>
  </head>
  <body>
    <div class="container-fluid">
      <div id="menu">
        <p>MENU</p>
        <button type="button" id="btnProductos" class="btn btn-primary">Productos</button>
        <button type="button" id="btnRecibos" class="btn btn-primary">Recibos</button>
        <button type="button" id="btnDespachos" class="btn btn-primary">Despachos</button>
      </div>
      <div id="divProductos">
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
                    <input type="number" id="precio" class="form-control precio solonumeros" value="" />
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
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  </body>
</html>
<script>
$(document).ready(function(){
  $('#divProductos').hide();
  $("#btnLearn").click(function() {
    $("#btnLearn").hide();
    $('#tabla').hide();
  });
  //Se define el evento onclick para el boton Productos
  //Esto lo va a hacer cuando el usuario haga click en el boton
  $('#btnProductos').on('click', function () {
    $('#divProductos').show();
    $('#btnProductos').removeClass('btn-primary');
    $('#btnProductos').addClass('btn-success');
  }); //fin de btnProductos click

}); //Fin del document ready

function AgregarProducto(){
    var codigo = $('#codigo').val();
    var descripcion = $('#descripcion').val();
    var precio = $('#precio').val();
    if (codigo == '' || descripcion == '' || precio == ''){
      alert('Datos incompletos');
      return;
    }
    //alert(codigo+' - '+descripcion+' - '+precio);
    //El siguiente codigo manda los datos a la api que esta en el servidor
    $.ajax({type: "POST",
      dataType: "json",
      data: {metodo:'GuardaProducto',codigo:codigo,descripcion:descripcion,precio:precio},
      url: "api/api.php",
    }).done(function(result){
      if (result.status == 'Success'){
        console.log('Me estoy haciendo guey!!');
        setTimeout(function(){
          $('#tabla').attr('disable',true);
          $('#codigo').val('');
          $('#descripcion').val('');
          $('#precio').val('');
				}, 2000);

      } //de mi if result
      else{
        alert('Hubo una falla.')
      }

    });
}
</script>
