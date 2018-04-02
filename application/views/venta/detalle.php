<table class="table table-striped table-hover table-bordered">	
	<thead>
		<tr>
			<th>#</th>
			<th>Producto</th>
			<th>Precio</th>
		</tr>
	</thead>
	<tbody>
		<?php $cont=1;
		foreach ($productos as $producto):?>
		<tr>
			<td><?= $cont++ ?></td>
			<td><?= $producto->producto ?></td>
			<td><?= $producto->precio ?></td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>