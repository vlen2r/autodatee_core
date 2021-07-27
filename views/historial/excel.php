<?php/**
 * Agregado por Batista 2021-07-26
 * Para filtrar mediante el nombre del cliente.
 * Siendo cliente una tabla foranea de Historial.
 */?>    
<table>
    <tr>
        <th>1</th>
        <th>2</th>
        <th>3</th>
        <th>4</th>
        <th>5</th>
    </tr>
<?php foreach($model as $data):?>
    
    <tr>
        <td><?php echo $data->id?></td>
        <td><?php echo $data->cliente_id?></td>
        <td><?php echo $data->cantidad?></td>
        <td><?php echo $data->fecha?></td>
        <td><?php echo $data->clienteNombre?></td>
    </tr>

<?php endforeach;?>

</table>

<?php //Fin del agregado Batista 2021-07-26 ?>    