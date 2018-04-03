<div style="width: 65%;margin-left:26%; border:1px solid silver;padding: 1%;">
	<strong>DETALLE MOROSIDAD</strong>
	<br>
	<table class='table table-striped table-bordered'>
		<thead>
			<tr>
				<th>#</th>
				<th>Fecha</th>
				<th>Concepto</th>
				<th>Monto (S/)</th>
			</tr>
		</thead>
		<tbody>
			<?php $cont=1; ?>
			<?php foreach ($morosidad as $mor):?>
			<tr>
				<td><?= $cont++ ?></td>
				<td><?= $mor->fecha ?></td>
				<td><?= $mor->concepto ?></td>
				<td><?= $mor->monto ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<br>