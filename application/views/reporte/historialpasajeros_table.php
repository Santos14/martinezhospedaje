<table class="table" id="table_reporte">
	<thead>
		<tr>
			<th>#</th>
			<th>Nro Cuarto</th>
			<th>Fecha Ingreso</th>
			<th>Hora Ingreso</th>
			<th>Nombre y Apellido</th>
			<th>Tipo Doc</th>
			<th>Nro Doc</th>
			<th>Nacionalidad</th>
			<th>Procedencia</th>
			<th>Ocupacion</th>
			<th>Fech Nac.</th>
			<th>KIT</th>
			<th>Fecha Salida</th>
		</tr>
	</thead>
	<tbody>
		<?php $cont = 1; ?>
		<?php foreach ($data as $val): ?>
		<tr>
			<td><?= $cont++; ?></td>
			<td><?= $val->nrohabitacion; ?></td>
			<td><?= $val->fecha_ingreso; ?></td>
			<td><?= $val->hora_ingreso; ?></td>
			<td><?= $val->nombres." ".$val->apellidos; ?></td>
			<td>
			<?php 
			if($val->tipodocumento == '0'){
				echo "DNI";
			}else{
				echo "Pasaporte";
			}
			?>
				
			</td>
			<td><?= $val->nrodocumento; ?></td>
			<td><?= $val->nacionalidad; ?></td>
			<td><?= $val->lugar; ?></td>
			<td><?= $val->ocupacion; ?></td>
			<td><?= $val->fechanac; ?></td>
			<td>
			<?php 
			if($val->kit == '0'){
				echo "NO";
			}else{
				echo "SI";
			}
			?>
			</td>
			<td><?= $val->fecha_salida; ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>