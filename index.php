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
      </div><br>
      <div id="divProductos">
        <div id="menuProductos">
          <button type="button" id="btnProductosAgregar" class="btn btn-success btn-sm">Agregar</button>
          <button type="button" id="btnProductosConsultar" class="btn btn-light btn-sm">Consultar</button>
          <div id="divSelectProductos">
            <label for="selectProductos">Selecciona un producto:</label>
            <select name="selectProductos" id="selectProductos">
            </select>
          </div>
        </div>
        <div class="row">
          <div id="divTablaAgregarProductos" class="col-md-12"><br>
            <p>Agregar nuevo producto</p>
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
          <!-- ESTE ES EL DIV PARA MOSTRAR LOS DATOS DEL PRODUCTO SELECCIONADO -->
          <div id="divTablaMostrarProductos" class="col-md-12"><br>
            <p></p>
            <table id="tablaMostrarProductos" class="table thead-light">
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
                    <input type="text" id="mostrarCodigo" class="form-control codigo" value="" />
                    <input type="text" id="idProducto" />
                  </td>
                  <td>
                    <input type="text" id="mostrarDescripcion" class="form-control descripcion" value="" />
                  </td>
                  <td>
                    <input type="number" id="mostrarPrecio" class="form-control precio solonumeros" value="" />
                  </td>
                  <td>
                    <button type="button" class="btn btn-success" id="btnEdicionProductos">Aplicar Cambio</button>
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
  $('#divSelectProductos').hide();
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

  //Se define el evento onclick para el boton Consultar Producto
  $('#btnProductosConsultar').on('click', function () {
    $('#divTablaAgregarProductos').hide();
    $('#divTablaMostrarProductos').hide();
    $('#divSelectProductos').show();
    $('#btnProductosConsultar').removeClass('btn-light');
    $('#btnProductosConsultar').addClass('btn-success');
    $('#btnProductosAgregar').removeClass('btn-success');
    $('#btnProductosAgregar').addClass('btn-light');

    //Hacemos petición ajax para llenar el select de Productos
    $.ajax({type: "POST",
      dataType: "json",
      data: {metodo:'DameProductos'},
      url: "api/api.php",
    }).done(function(result){
      if (result.status == 'Success'){
        var cadena = '';
        //console.log(result);
        //console.log(result.items);
        //console.log(result.items.length);
        for (var i=0;i < result.items.length;i++){
          cadena += '<option value="'+result.items[i].id+'" >'+result.items[i].codigo+'</option>';
        }
        $('#selectProductos').empty(); //Limpio el select
        $('#selectProductos').append(cadena); //Lo lleno con la cadena
        //console.log(cadena);
      } //de mi if result
      else{
        alert('Hubo una falla.')
      }
    });
  });

  $('#btnEdicionProductos').on('click', function () {
    var idProducto = $('#idProducto').val()
    var codigo = $('#mostrarCodigo').val();
    var descripcion = $('#mostrarDescripcion').val();
    var precio = $('#mostrarPrecio').val();
    $.ajax({type: "POST",
      dataType: "json",
      data: {metodo:'GuardaProductoCambio',codigo:codigo,descripcion:descripcion,
            precio:precio,idProducto:idProducto},
      url: "api/api.php",
    }).done(function(result){
      if (result.status == 'Success'){
        alert('Actualizacion exitosa');
        $('#idProducto').val('')
        $('#mostrarCodigo').val('');
        $('#mostrarDescripcion').val('');
        $('#mostrarPrecio').val('');
      }
      else {
        alert('Hubo un error');
      }
    });
  });


  $('#selectProductos').on('change', function () {
    var idProducto = $('#selectProductos').val(); //guardo el valor del select
    $('#idProducto').val(idProducto);
    //Hacemos petición ajax para obtener los datos del id seleccionado
    $.ajax({type: "POST",
      dataType: "json",
      data: {metodo:'DameProductosDetalles',idProducto:idProducto},
      url: "api/api.php",
    }).done(function(result){
      if (result.status == 'Success'){
        $('#divTablaMostrarProductos').show(); //Mostramos el div
        $('#mostrarCodigo').val(result.codigo);
        $('#mostrarDescripcion').val(result.descripcion);
        $('#mostrarPrecio').val(result.precio);
      }
    });
  });



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
        console.log('Aqui pasando el rato!!');
        setTimeout(function(){
          $('#tabla').attr('disable',true);
          $('#codigo').val('');
          $('#descripcion').val('');
          $('#precio').val('');
				}, 4000);

      } //de mi if result
      else{
        alert('Hubo una falla.')
      }

    });
}
</script>
