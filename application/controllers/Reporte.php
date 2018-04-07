<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte extends CI_Controller {

	function alojamiento(){
		layoutSystem("reporte/alojamiento");
	}
	function estadodia(){
		layoutSystem("reporte/estadodia");
	}

	function alojamiento_imprimir($fecha){
		$politica= $this->allmodel->selectWhere("politicas",array("idpoliticas" => 3))->result();

		$sql = "SELECT mv.fecha,hb.nrohabitacion,cli.nombres,cli.apellidos,al.estado,am.monto
		FROM movimiento mv INNER JOIN amortizacion am ON (mv.idmovimiento = am.movimiento_idmovimiento)
		INNER JOIN alquiler al ON (al.idalquiler = am.alquiler_idalquiler)
		INNER JOIN habitacion hb ON (hb.idhabitacion = al.habitacion_idhabitacion)
		INNER JOIN cliente cli ON (cli.idcliente = al.cliente_idcliente)
		WHERE date(mv.fecha) = '".$fecha."' and extract(HOUR from mv.fecha)>=".number_format($politica[0]->numero,'0')."
		UNION
		SELECT mv.fecha,hb.nrohabitacion,cli.nombres,cli.apellidos,al.estado,am.monto
		FROM movimiento mv INNER JOIN amortizacion am ON (mv.idmovimiento = am.movimiento_idmovimiento)
		INNER JOIN alquiler al ON (al.idalquiler = am.alquiler_idalquiler)
		INNER JOIN habitacion hb ON (hb.idhabitacion = al.habitacion_idhabitacion)
		INNER JOIN cliente cli ON (cli.idcliente = al.cliente_idcliente)
		WHERE date(mv.fecha) = '".date ('Y-m-d',strtotime('+1 day',strtotime(date($fecha))))."' and extract(HOUR from mv.fecha)<".number_format($politica[0]->numero,'0');

		

		$data = $this->allmodel->querySql($sql)->result(); 
		$html = "<h1 text-align='center'>Alquiler de Habitaciones</h1>";
		$html.= "<h4>Dia ".$fecha."</h4>";
		$html.= "<table border='1'>";
		$html.= "	<thead>";
		$html.= "		<tr>";
		$html.= "			<th>Item</th>";
		$html.= "			<th>Fecha</th>";
		$html.= "			<th>Habitacion</th>";
		$html.= "			<th>Apellidos y Nombres</th>";
		$html.= "			<th>Estado</th>";
		$html.= "			<th>Monto</th>";
		$html.= "		</tr>";
		$html.= "	</thead>";
		$html.= "	<tbody>";
		$cont = 1;
		$total = 0;
		foreach ($data as $val) {
			$total+=$val->monto;
			$html.= "		<tr>";
			$html.= "			<td>".$cont++."</td>";
			$html.= "			<td>".$val->fecha."</td>";
			$html.= "			<td>".$val->nrohabitacion."</td>";
			$html.= "			<td>".$val->apellidos.",".$val->nombres."</td>";
			$html.= "			<td>".$val->estado."</td>";
			$html.= "			<td>".$val->monto."</td>";
			$html.= "		</tr>";
		}
		


		$html.= "	</tbody>";
		$html.= "</table>";
		$html.= "<p>Total: ".$total."</p>";



		$this->load->library('Pdf');

		$pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Hospedaje Martinez');
		$pdf->SetTitle('REPORTE HOSPEDAJE MARTINEZ');
		$pdf->SetSubject('HOSPEDAJE');
		$pdf->SetKeywords('REPORTE,HOSPEDAJE');

		$subtitulobebe = "Ingresos por Habitacion";
 		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
       	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $pdf->setFontSubsetting(true);
		$pdf->SetFont('helvetica', '', 7);
		$pdf->AddPage("A");

		$pdf->writeHTML($html, true, 0, true, 0);

		$nombre_archivo = utf8_decode("ingresos.pdf");
		ob_end_clean();
		$pdf->Output($nombre_archivo, 'I');

	}

	function estadodia_imprimir($fecha){

		$politica= $this->allmodel->selectWhere("politicas",array("idpoliticas" => 3))->result();

		$ingresos = "SELECT mo.fecha,po.descripcion,mo.descripcion desmovimiento,mo.monto
		FROM movimiento mo INNER JOIN concepto po ON (po.idconcepto = mo.concepto_idconcepto)
		INNER JOIN tipomovimiento tm ON (tm.idtipomovimiento = po.tipomovimiento_idtipomovimiento)
		WHERE date(mo.fecha) = '".$fecha."' and extract(HOUR from mo.fecha)>=".number_format($politica[0]->numero,'0')." and tm.idtipomovimiento = 1 UNION
		SELECT mo.fecha,po.descripcion,mo.descripcion desmovimiento,mo.monto
		FROM movimiento mo INNER JOIN concepto po ON (po.idconcepto = mo.concepto_idconcepto)
		INNER JOIN tipomovimiento tm ON (tm.idtipomovimiento = po.tipomovimiento_idtipomovimiento)
		WHERE date(mo.fecha) = '".date ('Y-m-d',strtotime('+1 day',strtotime(date($fecha))))."' and extract(HOUR from mo.fecha)<".number_format($politica[0]->numero,'0')." and tm.idtipomovimiento = 1";

		$egresos = "SELECT mo.fecha,po.descripcion,mo.descripcion desmovimiento,mo.monto
		FROM movimiento mo INNER JOIN concepto po ON (po.idconcepto = mo.concepto_idconcepto)
		INNER JOIN tipomovimiento tm ON (tm.idtipomovimiento = po.tipomovimiento_idtipomovimiento)
		WHERE date(mo.fecha) = '".$fecha."' and extract(HOUR from mo.fecha)>=".number_format($politica[0]->numero,'0')." and tm.idtipomovimiento = 2
		UNION
		SELECT mo.fecha,po.descripcion,mo.descripcion desmovimiento,mo.monto
		FROM movimiento mo INNER JOIN concepto po ON (po.idconcepto = mo.concepto_idconcepto)
		INNER JOIN tipomovimiento tm ON (tm.idtipomovimiento = po.tipomovimiento_idtipomovimiento)
		WHERE date(mo.fecha) = '".date ('Y-m-d',strtotime('+1 day',strtotime(date($fecha))))."' and extract(HOUR from mo.fecha)<".number_format($politica[0]->numero,'0')." and tm.idtipomovimiento = 2";

		

		$dingresos = $this->allmodel->querySql($ingresos)->result(); 
		$degresos = $this->allmodel->querySql($egresos)->result(); 


		$html = "<h1>Reporte del Dia ".$fecha."</h1>";
		$html.= "<h3>Ingresos</h3>";
		$html.= "<table border='1'>";
	
		$html.= "		<tr>";
		$html.= "			<th>Item</th>";
		$html.= "			<th>Fecha</th>";
		$html.= "			<th>Concepto</th>";
		$html.= "			<th>Descripcion</th>";
		$html.= "			<th>Monto</th>";
		$html.= "		</tr>";
	
		$cont = 1;
		$sum_ing = 0;
		foreach ($dingresos as $ig) {
			
			$html.= "		<tr>";
			$html.= "			<td>".$cont++."</td>";
			$html.= "			<td>".$ig->fecha."</td>";
			$html.= "			<td>".$ig->descripcion."</td>";
			$html.= "			<td>".$ig->desmovimiento."</td>";
			$html.= "			<td>".$ig->monto."</td>";
			$html.= "		</tr>";

			$sum_ing+=$ig->monto;
		}
		
	
		$html.= "</table>";
		$html.= "<p>Total: ".$sum_ing."</p>";

		//EGRESOS

		$html.= "<h3>Egresos</h3>";

		$html.= "<table style='border:3px;'>";
		$html.= "	<thead>";
		$html.= "		<tr>";
		$html.= "			<th>Item</th>";
		$html.= "			<th>Fecha</th>";
		$html.= "			<th>Concepto</th>";
		$html.= "			<th>Descripcion</th>";
		$html.= "			<th>Monto</th>";
		$html.= "		</tr>";
		$html.= "	</thead>";
		$html.= "	<tbody>";
		$cont = 1;
		$sum_egr = 0;
		foreach ($degresos as $eg) {
			
			$html.= "		<tr>";
			$html.= "			<td>".$cont++."</td>";
			$html.= "			<td>".$eg->fecha."</td>";
			$html.= "			<td>".$eg->descripcion."</td>";
			$html.= "			<td>".$ig->desmovimiento."</td>";
			$html.= "			<td>".$eg->monto."</td>";
			$html.= "		</tr>";
			$sum_egr+=$eg->monto;
		}
		
		$html.= "	</tbody>";
		$html.= "</table>";
		$html.= "<p>Total: ".$sum_egr."</p>";
		$html.= "<p>Saldo del Dia: ".($sum_ing-$sum_egr)."</p>";






		$this->load->library('Pdf');

		$pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Hospedaje Martinez');
		$pdf->SetTitle('REPORTE HOSPEDAJE MARTINEZ');
		$pdf->SetSubject('HOSPEDAJE');
		$pdf->SetKeywords('REPORTE,HOSPEDAJE');

		$subtitulobebe = "Ingresos por Habitacion";
 		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
       	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $pdf->setFontSubsetting(true);
		$pdf->SetFont('helvetica', '', 7);
		$pdf->AddPage("A");

		$pdf->writeHTML($html, true, 0, true, 0);

		$nombre_archivo = utf8_decode("ingresos.pdf");
		ob_end_clean();
		$pdf->Output($nombre_archivo, 'I');




	}






}
