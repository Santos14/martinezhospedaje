<table class="table" id="table_i">
	<thead>
		<tr>
			<th>Item</th>
			<th>Fecha</th>
			<th>Concepto</th>
			<th>Descripcion</th>
			<th>Monto</th>		
		</tr>
	</thead>
	<tbody>
		<?php $sum_ing = 0; ?>
		<?php $cont = 1; ?>
		<?php foreach ($ingreso as $val): ?>
		<?php $sum_ing += $val->monto; ?>
		<tr>
			<td><?= $cont++; ?></td>
			<td><?= $val->fecha; ?></td>
			<td><?= $val->descripcion; ?></td>
			<td><?= $val->desmovimiento; ?></td>
			<td><?= $val->monto; ?></td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td colspan="4" style="text-align:center;">Total</td>
			<td><?= $sum_ing ?></td>
		</tr>
	</tbody>
</table>


<table class="table" id="table_e">
	<thead>
		<tr>
			<th>Item</th>
			<th>Fecha</th>
			<th>Concepto</th>
			<th>Descripcion</th>
			<th>Monto</th>		
		</tr>
	</thead>
	<tbody>
		<?php $sum_egr = 0; ?>
		<?php $cont = 1; ?>
		<?php foreach ($egreso as $val): ?>
		<?php $sum_egr += $val->monto; ?>
		<tr>
			<td><?= $cont++; ?></td>
			<td><?= $val->fecha; ?></td>
			<td><?= $val->descripcion; ?></td>
			<td><?= $val->desmovimiento; ?></td>
			<td><?= $val->monto; ?></td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td colspan="4" style="text-align:center;">Total</td>
			<td><?= $sum_egr ?></td>
		</tr>
	</tbody>
</table>


<table class="table" id='table_s'>
	<tr>
		<td>SALDO DIA:</td>
		<td><?= $sum_ing-$sum_egr ?></td>
	</tr>
</table>