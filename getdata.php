<table class="table table-bordered table-hover">
	<thead>
   <tr>
     <th>Tipo</th>
     <th>Nombre</th>
     <th>Fojas</th>
     <th>vuelta</th>
     <th>Número</th>
     <th>Año</th>
   </tr>
 </thead>
 <tbody>
  <?php
    $folio=234;
 
  include ("conexion/folio.php");

  $res = $conexion->query("select * from propiedad WHERE folio=$folio");

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
     <a title="Editar" id="editar" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal<?php echo $row['id_propiedad']; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
     <a title="Eliminar" class="btn btn-danger btn-sm"  onclick="deletedata('<?php echo $row['id_propiedad']; ?>')" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>

     <!-- Modal -->
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
                <label for="tipo">Tipo1</label>
                <input type="text" class="form-control" id="tipo<?php echo $row['id_propiedad']; ?>" value="<?php echo $row['TIPO']; ?>">
              </div>
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre<?php echo $row['id_propiedad']; ?>" value="<?php echo $row['NOMBRE']; ?>">
              </div>
              <div class="form-group">
                <label for="fojas">Fojas</label>
                <input type="text" class="form-control" id="fojas<?php echo $row['id_propiedad']; ?>" value="<?php echo $row['FOJAS']; ?>">
              </div>
              <div class="form-group">
                <label for="vuelta">vuelta</label>
                <input type="text" class="form-control" id="vuelta<?php echo $row['id_propiedad']; ?>" value="<?php echo $row['VUELTA']; ?>">
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
            <button type="button" onclick="updatedata('<?php echo $row['id_propiedad']; ?>')" class="btn btn-primary">Grabar</button>
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