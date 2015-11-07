<!-- MUESTRA UNA TABLA DE PROPIEDAD PARA PODER ELIMINAR Y EDITAR REGISTROS DE UN FOLIO
    DETERMINADO
-->
    
<table class="table table-bordered table-hover">
	<thead>
	  <tr>
	    <th>Rut</th>
	    <th>Nombre</th>
	  </tr>
	</thead>
	<tbody>
<?php
$folio = $folio = 22986; 
include "conexion/folio.php";
$res = $conexion->query("select * from propiedad WHERE FOLIO=$folio");
$row = $res->fetch_assoc(); 
foreach ($row as $campo[]=>$valor); 

mysqli_data_seek($res,0);  //devuelve el puntero al primer resultado de la consulta

while ($row = $res->fetch_assoc()) {
?>
    
	  <tr>
	    <td><?php echo $row['FOLIO']; ?></td>
	    <td><?php echo $row['NOMBRE']; ?></td>
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
    <label for="nm">Folio</label>
    <input type="text" class="form-control" id="nm<?php echo $row['id_propiedad']; ?>" value="<?php echo $row['folio']; ?>">
  </div>
  <div class="form-group">
    <label for="gd">Nombre</label>
    <input type="text" class="form-control" id="gd<?php echo $row['id_propiedad']; ?>" value="<?php echo $row['nombre']; ?>">
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