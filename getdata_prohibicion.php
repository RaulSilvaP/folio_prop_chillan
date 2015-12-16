<?php 
    $folio = $_POST['folio'];
    $mensaje = $_GET['mensaje'];
?>
<h4>Datos de Prohibición Folio Real Nº : <?php echo $folio; ?></h4>

<table class="table table-bordered table-hover">
	<thead>
   <tr>
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

  $res = $conexion->query("select * from prohibicion WHERE folio=$folio");

$total= $res->num_rows;
//if($total==1 ) {     //CONDICIONAL PARA DESABILITAR EL BOTÓN ELIMINAR CUANDO QUEDA UN SÓLO REGISTRO EN EL FOLIO
//  $desabilitar="disabled";
//}else{
  $desabilitar="";
//}
while ($row = $res->fetch_assoc()) {
  ?>
 
  <tr>
   <td><?php echo $row['TIPO']; ?></td>
   <td><?php echo $row['NOMBRE']; ?></td>
   <td><?php echo $row['FOJAS'] ?></td>
   <td><?php echo $row['VUELTA'] ?></td>
   <td><?php echo $row['NUMERO']; ?></td>
   <td><?php echo $row['ANO']; ?></td>
   <td>
     <a title="Editar" id="editar" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal<?php echo $row['id_prohibicion']; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
     <a title="<?php echo $mensaje; ?>" class="btn btn-danger btn-sm" <?php echo $desabilitar; ?> onclick="deletedata_prohibicion('<?php echo $row['id_prohibicion']; ?>','<?php echo $mensaje; ?>')" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span><?php echo $mensaje; ?></a>

     <!-- Modal -->
     <div class="modal fade" id="myModal<?php echo $row['id_prohibicion']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $row['id_prohibicion']; ?>" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel<?php echo $row['id_prohibicion']; ?>">Editar datos</h4>
          </div>
          <div class="modal-body">

            <form>
              <div class="form-group">
                <label for="tipo">Tipo</label>
                <input type="text" class="form-control" id="tipo<?php echo $row['id_prohibicion']; ?>" value="<?php echo $row['TIPO']; ?>">
              </div>
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre<?php echo $row['id_prohibicion']; ?>" value="<?php echo $row['NOMBRE']; ?>">
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
                <input type="text" class="form-control" id="fojas<?php echo $row['id_prohibicion']; ?>" value="<?php echo $row['FOJAS']; ?>" >
                  <label class="checkbox-inline" for="vuelta">
                    <input type="checkbox" name="vuelta<?php echo $row['id_prohibicion']; ?>" id="vuelta<?php echo $row['id_prohibicion']; ?>" <?php echo $vuelta_check; ?> value="v"/> vuelta
                  </label>

              </div>
              <div class="form-group">
                <label for="numero">Número</label>
                <input type="text" class="form-control" id="numero<?php echo $row['id_prohibicion']; ?>" value="<?php echo $row['NUMERO']; ?>">
              </div>
              <div class="form-group">
                <label for="ano">Año</label>
                <input type="text" class="form-control" id="ano<?php echo $row['id_prohibicion']; ?>" value="<?php echo $row['ANO']; ?>">
              </div>
              <div class="form-group">
                <label for="acreedor">Acreedor...</label>
                <textarea class="form-control" id="acreedor<?php echo $row['id_prohibicion']; ?>" value=""><?php echo $row['ACREEDOR']; ?></textarea>
              </div>

            </form>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" onclick="updatedata_prohibicion('<?php echo $row['id_prohibicion']; ?>','<?php echo $mensaje; ?>')" class="btn btn-primary">Grabar</button>
          </div>
        </div>
      </div>
    </div>

  </td>
</tr>
<?php
}
?>
</tbody>
</table>