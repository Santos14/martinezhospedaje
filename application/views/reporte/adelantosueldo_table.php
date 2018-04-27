<table class="table" id="table_reporte">
	<thead>
		<tr>
			<th>Item</th>
			<th>Fecha</th>
			<th>Concepto</th>
			<th>Personal</th>
			<th>Monto</th>		
		</tr>
	</thead>
	<tbody>
		<?php $cont = 1; ?>
		<?php foreach ($data as $val): ?>
		<tr>
			<td><?= $cont++; ?></td>
			<td><?= $val->fecha; ?></td>
			<td><?= $val->concepto; ?></td>
			<td><?= $val->descripcion; ?></td>
			<td><?= $val->monto; ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>