
<table class="table" id="table_reporte">
	<thead>
		<tr>
			<th>Item</th>
			<th>Fecha</th>
			<th>Habitacion</th>
			<th>Apellidos y Nombres</th>
			<th>Estado</th>
			<th>Monto</th>		
		</tr>
	</thead>
	<tbody>
		<?php $cont=1; ?>
		<?php foreach ($info as $value): ?>
			<tr> 
				<td><?= $cont++ ?></td>
				<td><?= $value->fecha ?></td>
				<td><?= $value->nrohabitacion ?></td>
				<td><?= $value->apellidos.", ".$value->nombres ?></td>
				<td><?php if($value->estado=='1'){echo 'Activo';}else{ echo 'Terminado';} ?></td>
				<td><?= $value->monto ?></td>
			</tr>
			
		<?php endforeach ?>
		
	</tbody>
</table>