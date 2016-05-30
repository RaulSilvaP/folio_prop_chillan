<script>
        $('#marcarTodo').change(function() {
        if ($(this).is(':checked')) {
            $("input[type=checkbox]").prop('checked', true); //todos los check
//            $("#seleccionados input[type=checkbox]").prop('checked', true); //solo los del objeto #diasHabilitados
        } else {
            $("input[type=checkbox]").prop('checked', false);//todos los check
//            $("#seleccionados input[type=checkbox]").prop('checked', false);//solo los del objeto #diasHabilitados
        }
    });

</script>
<?php 
    $folio = $_POST['folio'];
    $mensaje = $_GET['mensaje'];
?>
<h4>Datos grabados Folio Real Nº : <?php echo $folio; ?></h4>
        <div id="view_transfieren"></div>

<table class="table table-bordered table-hover">
	<thead>
   <tr>
     <th>
        <p>
          <input type="checkbox" name="marcarTodo" id="marcarTodo" >
            <label for="marcarTodo"></label>
          Todos</br>transfieren
        </p>
     </th>
     <th>Tipo</th>
     <th>Nombre</th>
     <th>Fojas</th>
     <th>vuelta</th>
     <th>Número</th>
     <th>Año</th>
     <th>Acción</th>     
   </tr>
 </thead>
 <tbody>
  <?php



  include ("conexion/folio.php");

  $res = $conexion->query("select * from propiedad WHERE folio=$folio");

$total= $res->num_rows;
if($total==1 ) {     //CONDICIONAL PARA DESABILITAR EL BOTÓN ELIMINAR CUANDO QUEDA UN SÓLO REGISTRO EN EL FOLIO
  $desabilitar="disabled";
}else{
  $desabilitar="";
}
while ($row = $res->fetch_assoc()) {
  ?>
 
  <tr>
   <td><input type="checkbox"></td>
   <td><?php echo $row['TIPO']; ?></td>
   <td><?php echo $row['NOMBRE']; ?></td>
   <td><?php echo $row['FOJAS'] ?></td>
   <td><?php echo $row['VUELTA'] ?></td>
   <td><?php echo $row['NUMERO']; ?></td>
   <td><?php echo $row['ANO']; ?></td>
   <td>
     <a title="Editar" id="editar" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal<?php echo $row['id_propiedad']; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
     <a title="<?php echo $mensaje; ?>" class="btn btn-danger btn-sm" <?php echo $desabilitar; ?> onclick="deletedata_propiedad('<?php echo $row['id_propiedad']; ?>','<?php echo $mensaje; ?>')" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span><?php echo $mensaje; ?></a>

     <!-- Modal editar -->
     <div class="modal fade" id="myModal<?php echo $row['id_propiedad']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $row['id_propiedad']; ?>" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel<?php echo $row['id_propiedad']; ?>">Editar datos</h4>
          </div>
          <div class="modal-body">

            <form>
              <div class="form-group">
                <label for="tipo">Tipo</label>
                <input type="text" class="form-control" id="tipo<?php echo $row['id_propiedad']; ?>" value="<?php echo $row['TIPO']; ?>">
              </div>
              <div class="form-group">
                <label for="nombre_prop">Nombre</label>
                <input type="text" class="form-control" id="nombre_prop<?php echo $row['id_propiedad']; ?>" value="<?php echo $row['NOMBRE']; ?>">
              </div>
              <?php 
                  if($row['VUELTA']=="v") {
                    $vuelta_check="checked";
                  }else{
                    $vuelta_check="";
                  }
               ?>
              <div class="form-inline">
                <label for="fojas">Fojas</label>
                <input type="text" class="form-control" id="fojas<?php echo $row['id_propiedad']; ?>" value="<?php echo $row['FOJAS']; ?>" >
                  <label class="checkbox-inline" for="vuelta">
                    <input type="checkbox" name="vuelta<?php echo $row['id_propiedad']; ?>" id="vuelta<?php echo $row['id_propiedad']; ?>" <?php echo $vuelta_check; ?> value="v"/> vuelta
                  </label>

              </div>
              <div class="form-group">
                <label for="numero">Número</label>
                <input type="text" class="form-control" id="numero<?php echo $row['id_propiedad']; ?>" value="<?php echo $row['NUMERO']; ?>">
              </div>
              <div class="form-group">
                <label for="ano">Año</label>
                <input type="text" class="form-control" id="ano<?php echo $row['id_propiedad']; ?>" value="<?php echo $row['ANO']; ?>">
              </div>

            </form>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" onclick="updatedata_propiedad('<?php echo $row['id_propiedad']; ?>','<?php echo $mensaje; ?>')" class="btn btn-primary">Grabar</button>
          </div>
        </div>
      </div>
    </div>   <!--   fin modal editar -->



     <!-- Modal transferir -->
     <div class="modal fade" id="Modal_t" tabindex="-1" role="dialog" aria-labelledby="ModalLabel_t<?php echo $row['id_propiedad']; ?>" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="ModalLabel_t<?php echo $row['id_propiedad']; ?>">Seleccionados transfieren <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span> Nuevo(s) propietario(s)</h4>
          </div>
          <div class="modal-body">

            <form>
              <div class="form-group">
                <label for="tipo_t">Tipo</label>
                <input type="text" class="form-control" id="tipo_t<?php echo $row['id_propiedad']; ?>" value="<?php echo $row['TIPO']; ?>">
              </div>
              <div class="form-group">
                <label for="nombre_prop_t">Nombre</label>
                <input type="text" class="form-control" id="nombre_prop_t<?php echo $row['id_propiedad']; ?>" value="<?php echo $row['NOMBRE']; ?>">
              </div>
              <?php 
                  if($row['VUELTA']=="v") {
                    $vuelta_check="checked";
                  }else{
                    $vuelta_check="";
                  }
               ?>
              <div class="form-inline">
                <label for="fojas_t">Fojas</label>
                <input type="text" class="form-control" id="fojas_t<?php echo $row['id_propiedad']; ?>" value="<?php echo $row['FOJAS']; ?>" >
                  <label class="checkbox-inline" for="vuelta_t">
                    <input type="checkbox" name="vuelta_t<?php echo $row['id_propiedad']; ?>" id="vuelta_t<?php echo $row['id_propiedad']; ?>" <?php echo $vuelta_check; ?> value="v"/> vuelta
                  </label>

              </div>
              <div class="form-group">
                <label for="numero_t">Número</label>
                <input type="text" class="form-control" id="numero_t<?php echo $row['id_propiedad']; ?>" value="<?php echo $row['NUMERO']; ?>">
              </div>
              <div class="form-group">
                <label for="ano_t">Año</label>
                <input type="text" class="form-control" id="ano_t<?php echo $row['id_propiedad']; ?>" value="<?php echo $row['ANO']; ?>">
              </div>

            </form>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" onclick="transferir_propiedad('<?php echo $row['id_propiedad']; ?>','<?php echo $mensaje; ?>')" class="btn btn-primary">Grabar</button>
          </div>
        </div>
      </div>
    </div>   <!--   fin modal transferir -->









  </td>
</tr>
<?php
}
?>
</tbody>
</table>