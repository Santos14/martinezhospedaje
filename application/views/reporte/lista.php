<form id="formulario" class="form-horizontal form-label-left" onsubmit="return guardar()">
	<div class="form-group">
		<label  class="control-label col-md-2">SELEC. INTERNO</label>
		<div class="col-md-5">
			<div class="input-group">
                            		<input type="text" class="form-control" id="interno_name" placeholder="BUSCAR INTERNO . . ." readonly="true">
                            		<span class="input-group-btn">
                                             	<button type="button" class="btn btn-success" onclick="buscar()">BUSCAR</button>
                                        	</span>
                                        	<input type="hidden" name="interno" id="interno">
                          	</div>
		</div>
		<div class="col-md-2">
			<select class="form-control" id="opcion" name="opcion"  required>
				<option value="">OPCION</option>
				<option value="1">VISITAS</option>
				<option value="2">F. INTEGRAL</option>
				<option value="3">F. PSICOLOGICA</option>
				<option value="4">F. SALUD</option>
				<option value="5">F. SOCIAL</option>
				<option value="6">F. SOCIAL EVOL.</option>
			</select>
		</div>
		<div class="col-md-3">
			<button type="button" class="btn btn-success btn-guardar" onclick="generar()"> <i class="fa fa-print"></i> GENERAR REPORTE</button>
		</div>	
	</div>

	<div class="ln_solid"></div>
	<h4 align="center"><i class="fa fa-file-o"></i> VISTA DEL REPORTE GENERADO </h4>
	<iframe id="iframe-reporte" src="" style="width: 100%; height:330px;"> </iframe>
</form>

<div id="lista_internos" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" align="center">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">LISTA DE INTERNOS - ALDEA INFANTIL</h4>
			</div>
			<div class="modal-body">
				<table id="datatable1" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
					<thead>
					   	<tr>
					     		<th>NRO</th>
					     		<th>DNI</th>
					     		<th>NOMBRES COMPLETOS</th>
					     		<th>SEXO</th>
					     		<th>TRAIDO POR</th>
					     		<th>N° SEGURO</th>
					     		<th>ACCION</th>
					   	</tr>
					</thead>
					<tbody>
						<?php $cont = 0;
				                        	foreach($internos as $val){ $cont = $cont + 1; ?>
					                              	<tr>
					                                        	<td><?php echo $cont; ?></td>
					                                        	<td><?php echo $val["dni"]; ?></td>
					                                        	<td><?php echo $val["nombre"].' '. $val["apellido"]; ?></td>
					                                        	<td><?php echo $val["sexo"]; ?></td>
					                                        	<td><?php echo $val["traido_por"]; ?></td>
					                                        	<td><?php echo $val["num_seguro"]; ?></td>
					                                        	<td>
					                                                	<button type="button" class="btn btn-success btn-xs" onclick="check(<?php echo $val["idinterno"]; ?>,'<?php echo $val["nombre"].' '. $val["apellido"]; ?>')">
					                                                        	Seleccionar
					                                                	</button>
					                                        	</td>
					                             	</tr>
				                        	<?php }
				                	?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>