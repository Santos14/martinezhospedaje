<table class="table" id="table_reporte">
	<thead>
		<tr>
			<th>Item</th>
			<th>Fecha</th>
			<th>Monto</th>	
		</tr>
	</thead>
	<tbody>
		<?php $cont = 1; ?>
		<?php foreach ($listPagos as $val): ?>
		<tr>
			<td><?= $cont++; ?></td>
			<td><?= $val->fecha; ?></td>
			<td><?= $val->monto; ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>