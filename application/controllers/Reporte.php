<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte extends CI_Controller {

	function alojamiento(){
		layoutSystem("reporte/alojamiento");
	}
	function estadodia(){
		layoutSystem("reporte/estadodia");
	}
	function adelantopersonal(){
		layoutSystem("reporte/adelantopersonal");
	}
	function historialpasajeros(){
		layoutSystem("reporte/historialpasajeros");
	}

	function cronopagos(){

		$sql_habocupadas = "SELECT * FROM habitacion WHERE (disponibilidad='2' or disponibilidad='3' or disponibilidad='5' or disponibilidad='6' ) and estado <> '0' ORDER BY nrohabitacion asc";

		$data["hab_ocupadas"] = $this->allmodel->querySql($sql_habocupadas)->result();

		layoutSystem("reporte/cronogramapagos",$data);
	}

	function estadomes(){
		$data["anios"] = $this->allmodel->querySql("SELECT DISTINCT(EXTRACT(YEAR from fecha_ingreso)) anios FROM alquiler")->result();
		layoutSystem("reporte/estadomes",$data);
	}
	function estadisticamensual(){
		$data["anios"] = $this->allmodel->querySql("SELECT DISTINCT(EXTRACT(YEAR from fecha_ingreso)) anios FROM alquiler")->result();
		layoutSystem("reporte/estadisticamensual",$data);
	}

	function cronogramapagos_imprimir($nrohabitacion){
		
		$bAlq = "SELECT al.* 
		FROM habitacion hb INNER JOIN alquiler al ON (hb.idhabitacion = al.habitacion_idhabitacion)
		WHERE hb.estado='1' and al.estado='1' and hb.nrohabitacion='".$nrohabitacion."' LIMIT 1";

		$alq = $this->allmodel->querySql($bAlq)->result(); 

		$listaPagos = "SELECT mv.fecha, mv.monto 
		FROM alquiler al INNER JOIN amortizacion am ON (al.idalquiler = am.alquiler_idalquiler)
		INNER JOIN movimiento mv ON (mv.idmovimiento = am.movimiento_idmovimiento)
		WHERE al.estado='1' and am.estado='1' and mv.estado='1' and al.idalquiler = ".$alq[0]->idalquiler."
		ORDER BY mv.fecha asc";

		$lPagos = $this->allmodel->querySql($listaPagos)->result(); 

		$data["listPagos"] =$lPagos;


		$this->load->view("reporte/listapagos_table",$data);
	}


	function estadomes_imprimir($mes,$anio){
		
		$ingresos = "SELECT mo.fecha,po.descripcion,mo.descripcion desmovimiento,mo.monto
		FROM movimiento mo INNER JOIN concepto po ON (po.idconcepto = mo.concepto_idconcepto)
		INNER JOIN tipomovimiento tm ON (tm.idtipomovimiento = po.tipomovimiento_idtipomovimiento)
		WHERE tm.idtipomovimiento = 1 and mo.estado='1' and (EXTRACT(MONTH FROM mo.fecha) = '".$mes."' and EXTRACT(YEAR FROM mo.fecha) = '".$anio."') ORDER BY mo.fecha asc";

		$egresos = "SELECT mo.fecha,po.descripcion,mo.descripcion desmovimiento,mo.monto
		FROM movimiento mo INNER JOIN concepto po ON (po.idconcepto = mo.concepto_idconcepto)
		INNER JOIN tipomovimiento tm ON (tm.idtipomovimiento = po.tipomovimiento_idtipomovimiento)
		WHERE tm.idtipomovimiento = 2 and mo.estado='1' and (EXTRACT(MONTH FROM mo.fecha) = '".$mes."' and EXTRACT(YEAR FROM mo.fecha) = '".$anio."') ORDER BY mo.fecha asc";

		$dingresos = $this->allmodel->querySql($ingresos)->result(); 
		$degresos = $this->allmodel->querySql($egresos)->result(); 

		$data["ingreso"] = $dingresos;
		$data["egreso"] = $degresos;

		$this->load->view("reporte/movimientosmes_table",$data);
	}

	function informeestadistica($mes,$anio){
		$data["anio"] = $anio;
		$data["mes"] = $mes;

		
		$sql_IsB = "SELECT hbt.idhabitacion,hbt.nrohabitacion
		FROM habitacion hbt INNER JOIN tipohabitacion tht ON (hbt.tipohabitacion_idtipohabitacion = tht.idtipohabitacion)
		WHERE tht.descripcion='Individual' and hbt.disponibilidad <> '4' and hbt.idhabitacion NOT IN (
		SELECT hb.idhabitacion
		FROM habitacion hb INNER JOIN tipohabitacion th ON (hb.tipohabitacion_idtipohabitacion = th.idtipohabitacion)
		INNER JOIN detalle_servicio ds ON (hb.idhabitacion = ds.habitacion_idhabitacion)
		INNER JOIN servicio s ON (ds.servicio_idservicio = s.idservicio)
		WHERE th.descripcion='Individual' and s.descripcion='Baño' and hb.disponibilidad <> '4'
		)";
		$sql_IcB = "SELECT hb.idhabitacion,hb.nrohabitacion
		FROM habitacion hb INNER JOIN tipohabitacion th ON (hb.tipohabitacion_idtipohabitacion = th.idtipohabitacion)
		INNER JOIN detalle_servicio ds ON (hb.idhabitacion = ds.habitacion_idhabitacion)
		INNER JOIN servicio s ON (ds.servicio_idservicio = s.idservicio)
		WHERE th.descripcion='Individual' and s.descripcion='Baño' and hb.disponibilidad <> '4'";

		$sql_McB = "SELECT hb.idhabitacion,hb.nrohabitacion
		FROM habitacion hb INNER JOIN tipohabitacion th ON (hb.tipohabitacion_idtipohabitacion = th.idtipohabitacion)
		INNER JOIN detalle_servicio ds ON (hb.idhabitacion = ds.habitacion_idhabitacion)
		INNER JOIN servicio s ON (ds.servicio_idservicio = s.idservicio)
		WHERE th.descripcion='Matrimonial' and s.descripcion='Baño' and hb.disponibilidad <> '4'";
		$sql_MsB = "SELECT hbt.idhabitacion,hbt.nrohabitacion
		FROM habitacion hbt INNER JOIN tipohabitacion tht ON (hbt.tipohabitacion_idtipohabitacion = tht.idtipohabitacion)
		WHERE tht.descripcion='Matrimonial' and hbt.disponibilidad <> '4' and hbt.idhabitacion NOT IN (
		SELECT hb.idhabitacion
		FROM habitacion hb INNER JOIN tipohabitacion th ON (hb.tipohabitacion_idtipohabitacion = th.idtipohabitacion)
		INNER JOIN detalle_servicio ds ON (hb.idhabitacion = ds.habitacion_idhabitacion)
		INNER JOIN servicio s ON (ds.servicio_idservicio = s.idservicio)
		WHERE th.descripcion='Matrimonial' and s.descripcion='Baño' and hb.disponibilidad <> '4'
		)";

		$sql_DcB = "SELECT hb.idhabitacion,hb.nrohabitacion
		FROM habitacion hb INNER JOIN tipohabitacion th ON (hb.tipohabitacion_idtipohabitacion = th.idtipohabitacion)
		INNER JOIN detalle_servicio ds ON (hb.idhabitacion = ds.habitacion_idhabitacion)
		INNER JOIN servicio s ON (ds.servicio_idservicio = s.idservicio)
		WHERE th.descripcion='Doble' and s.descripcion='Baño' and hb.disponibilidad <> '4'";
		$sql_DsB = "SELECT hbt.idhabitacion,hbt.nrohabitacion
		FROM habitacion hbt INNER JOIN tipohabitacion tht ON (hbt.tipohabitacion_idtipohabitacion = tht.idtipohabitacion)
		WHERE tht.descripcion='Doble' and hbt.disponibilidad <> '4' and hbt.idhabitacion NOT IN (
		SELECT hb.idhabitacion
		FROM habitacion hb INNER JOIN tipohabitacion th ON (hb.tipohabitacion_idtipohabitacion = th.idtipohabitacion)
		INNER JOIN detalle_servicio ds ON (hb.idhabitacion = ds.habitacion_idhabitacion)
		INNER JOIN servicio s ON (ds.servicio_idservicio = s.idservicio)
		WHERE th.descripcion='Doble' and s.descripcion='Baño' and hb.disponibilidad <> '4'
		)";

		$sql_nrocamas_ind = "SELECT hb.idhabitacion,hb.nrohabitacion,th.descripcion tipohabitacion, de.especificacion
		FROM habitacion hb INNER JOIN tipohabitacion th ON (hb.tipohabitacion_idtipohabitacion = th.idtipohabitacion)
		INNER JOIN detalle_elementos de ON (de.habitacion_idhabitacion = hb.idhabitacion)
		INNER JOIN elemento e ON (e.idelemento = de.elemento_idelemento)
		WHERE th.descripcion='Individual' and e.descripcion='Cama' and hb.disponibilidad <> '4'";

		$sql_nrocamas_dob = "SELECT hb.idhabitacion,hb.nrohabitacion,th.descripcion tipohabitacion, de.especificacion
		FROM habitacion hb INNER JOIN tipohabitacion th ON (hb.tipohabitacion_idtipohabitacion = th.idtipohabitacion)
		INNER JOIN detalle_elementos de ON (de.habitacion_idhabitacion = hb.idhabitacion)
		INNER JOIN elemento e ON (e.idelemento = de.elemento_idelemento)
		WHERE th.descripcion='Doble' and e.descripcion='Cama' and hb.disponibilidad <> '4'";

		$sql_nrocamas_mat = "SELECT hb.idhabitacion,hb.nrohabitacion,th.descripcion tipohabitacion, de.especificacion
		FROM habitacion hb INNER JOIN tipohabitacion th ON (hb.tipohabitacion_idtipohabitacion = th.idtipohabitacion)
		INNER JOIN detalle_elementos de ON (de.habitacion_idhabitacion = hb.idhabitacion)
		INNER JOIN elemento e ON (e.idelemento = de.elemento_idelemento)
		WHERE th.descripcion='Matrimonial' and e.descripcion='Cama' and hb.disponibilidad <> '4'";

		$sql_arrib_ind = "SELECT count(al.idalquiler) arribos
		FROM alquiler al 
		INNER JOIN habitacion hb ON (al.habitacion_idhabitacion = hb.idhabitacion) 
		INNER JOIN tipohabitacion th ON (hb.tipohabitacion_idtipohabitacion = th.idtipohabitacion)
		INNER JOIN cliente cli ON (al.cliente_idcliente = cli.idcliente)
		WHERE th.descripcion='Individual' and al.estado = '2' and al.tipoalquiler_idtipoalquiler<>'2' 
		and (EXTRACT(MONTH FROM al.fecha_ingreso) = '".$mes."' and EXTRACT(YEAR FROM al.fecha_ingreso) = '".$anio."')";
		$sql_arrib_mat = "SELECT count(al.idalquiler) arribos
		FROM alquiler al 
		INNER JOIN habitacion hb ON (al.habitacion_idhabitacion = hb.idhabitacion) 
		INNER JOIN tipohabitacion th ON (hb.tipohabitacion_idtipohabitacion = th.idtipohabitacion)
		INNER JOIN cliente cli ON (al.cliente_idcliente = cli.idcliente)
		WHERE th.descripcion='Matrimonial' and al.estado = '2' and al.tipoalquiler_idtipoalquiler<>'2' 
		and (EXTRACT(MONTH FROM al.fecha_ingreso) = '".$mes."' and EXTRACT(YEAR FROM al.fecha_ingreso) = '".$anio."')";
		$sql_arrib_dob = "SELECT count(al.idalquiler) arribos
		FROM alquiler al 
		INNER JOIN habitacion hb ON (al.habitacion_idhabitacion = hb.idhabitacion) 
		INNER JOIN tipohabitacion th ON (hb.tipohabitacion_idtipohabitacion = th.idtipohabitacion)
		INNER JOIN cliente cli ON (al.cliente_idcliente = cli.idcliente)
		WHERE th.descripcion='Doble' and al.estado = '2' and al.tipoalquiler_idtipoalquiler<>'2' 
		and (EXTRACT(MONTH FROM al.fecha_ingreso) = '".$mes."' and EXTRACT(YEAR FROM al.fecha_ingreso) = '".$anio."')";

		$sql_habnocheocupadas_ind = "SELECT hb.idhabitacion, hb.nrohabitacion, sum(al.nrodias) totaldias
		FROM alquiler al INNER JOIN habitacion hb ON (al.habitacion_idhabitacion = hb.idhabitacion) 
		INNER JOIN tipohabitacion th ON (hb.tipohabitacion_idtipohabitacion = th.idtipohabitacion)
		WHERE th.descripcion='Individual' and al.estado = '2' and al.tipoalquiler_idtipoalquiler<>'2' and (EXTRACT(MONTH FROM al.fecha_ingreso) = '".$mes."' and EXTRACT(YEAR FROM al.fecha_ingreso) = '".$anio."') 
		GROUP BY hb.idhabitacion, hb.nrohabitacion";

		$sql_habnocheocupadas_mat = "SELECT hb.idhabitacion, hb.nrohabitacion, sum(al.nrodias) totaldias
		FROM alquiler al INNER JOIN habitacion hb ON (al.habitacion_idhabitacion = hb.idhabitacion) 
		INNER JOIN tipohabitacion th ON (hb.tipohabitacion_idtipohabitacion = th.idtipohabitacion)
		WHERE th.descripcion='Matrimonial' and al.estado = '2' and al.tipoalquiler_idtipoalquiler<>'2' and (EXTRACT(MONTH FROM al.fecha_ingreso) = '".$mes."' and EXTRACT(YEAR FROM al.fecha_ingreso) = '".$anio."')  
		GROUP BY hb.idhabitacion, hb.nrohabitacion";


		$sql_habnocheocupadas_dob = "SELECT hb.idhabitacion, hb.nrohabitacion, sum(al.nrodias) totaldias
		FROM alquiler al INNER JOIN habitacion hb ON (al.habitacion_idhabitacion = hb.idhabitacion) 
		INNER JOIN tipohabitacion th ON (hb.tipohabitacion_idtipohabitacion = th.idtipohabitacion)
		WHERE th.descripcion='Doble' and al.estado = '2' and al.tipoalquiler_idtipoalquiler<>'2' and (EXTRACT(MONTH FROM al.fecha_ingreso) = '".$mes."' and EXTRACT(YEAR FROM al.fecha_ingreso) = '".$anio."')  
		GROUP BY hb.idhabitacion, hb.nrohabitacion";

		$sql_arribos_dias = "SELECT date(fecha_ingreso) ingreso, count(idalquiler) veces
		FROM alquiler
		WHERE estado = '2' and tipoalquiler_idtipoalquiler <> '2'
					and (EXTRACT(MONTH FROM fecha_ingreso) = '".$mes."' and EXTRACT(YEAR FROM fecha_ingreso) = '".$anio."')
		GROUP BY date(fecha_ingreso)
		ORDER BY date(fecha_ingreso) asc";


		$sql_arribos_proc = "SELECT pr.idprocedencia,pr.lugar,pr.tipoprocedencia, count(al.idalquiler) nroarribos FROM alquiler al INNER JOIN procedencia pr ON (al.procedencia_idprocedencia = pr.idprocedencia)  WHERE pr.estado = '1' and al.estado = '2' and al.tipoalquiler_idtipoalquiler<>'2' and (EXTRACT(MONTH FROM fecha_ingreso) = '".$mes."' and EXTRACT(YEAR FROM fecha_ingreso) = '".$anio."') GROUP BY pr.idprocedencia,pr.lugar,pr.tipoprocedencia";

		$sql_pernotacion_proc = "SELECT hb.idhabitacion,pr.idprocedencia, hb.nrohabitacion,th.descripcion, sum(al.nrodias) totaldias
			FROM alquiler al INNER JOIN habitacion hb ON (al.habitacion_idhabitacion = hb.idhabitacion) 
			INNER JOIN tipohabitacion th ON (hb.tipohabitacion_idtipohabitacion = th.idtipohabitacion)
			INNER JOIN procedencia pr ON (pr.idprocedencia = al.procedencia_idprocedencia)
			WHERE al.estado = '2' and al.tipoalquiler_idtipoalquiler<>'2' and 
			(EXTRACT(MONTH FROM fecha_ingreso) = '".$mes."' and EXTRACT(YEAR FROM fecha_ingreso) = '".$anio."') 
			GROUP BY hb.idhabitacion,pr.idprocedencia, hb.nrohabitacion,th.descripcion";

		$sql_arrib_motivoviaje = "SELECT mv.idmotivoviaje,pr.tipoprocedencia,mv.descripcion,count(al.idalquiler) nroarribos
		FROM alquiler al INNER JOIN procedencia pr ON (al.procedencia_idprocedencia = pr.idprocedencia) 
		INNER JOIN motivoviaje mv ON (al.motivoviaje_idmotivoviaje = mv.idmotivoviaje)
		WHERE pr.estado = '1' and mv.estado='1' and al.estado = '2' and al.tipoalquiler_idtipoalquiler<>'2' and (EXTRACT(MONTH FROM fecha_ingreso) = '".$mes."' and EXTRACT(YEAR FROM fecha_ingreso) = '".$anio."')
		GROUP BY mv.idmotivoviaje,pr.tipoprocedencia,mv.descripcion";

		$sql_proc_nac = "SELECT * FROM procedencia WHERE estado='1' and tipoprocedencia='N' ORDER BY lugar asc";
		$sql_proc_ext = "SELECT * FROM procedencia WHERE estado='1' and tipoprocedencia='E' ORDER BY lugar asc";

		$sql_motviaj = "SELECT * FROM motivoviaje WHERE estado='1'";





		$data["ind_sinB"] = $this->allmodel->querySql($sql_IsB)->result();
		$data["ind_conB"] = $this->allmodel->querySql($sql_IcB)->result();

		$data["mat_sinB"] = $this->allmodel->querySql($sql_MsB)->result();
		$data["mat_conB"] = $this->allmodel->querySql($sql_McB)->result();

		$data["dob_sinB"] = $this->allmodel->querySql($sql_DsB)->result();
		$data["dob_conB"] = $this->allmodel->querySql($sql_DcB)->result();

		$data["nrocamas_ind"] = $this->allmodel->querySql($sql_nrocamas_ind)->result();
		$data["nrocamas_mat"] = $this->allmodel->querySql($sql_nrocamas_mat)->result();
		$data["nrocamas_dob"] = $this->allmodel->querySql($sql_nrocamas_dob)->result();

		$data["arrib_ind"] = $this->allmodel->querySql($sql_arrib_ind)->result();
		$data["arrib_mat"] = $this->allmodel->querySql($sql_arrib_mat)->result();
		$data["arrib_dob"] = $this->allmodel->querySql($sql_arrib_dob)->result();

		$data["hbnoche_ind"] = $this->allmodel->querySql($sql_habnocheocupadas_ind)->result();
		$data["hbnoche_mat"] = $this->allmodel->querySql($sql_habnocheocupadas_mat)->result();
		$data["hbnoche_dob"] = $this->allmodel->querySql($sql_habnocheocupadas_dob)->result();

		$data["arrib_dias"] = $this->allmodel->querySql($sql_arribos_dias)->result();

		$data["arrib_proc"] = $this->allmodel->querySql($sql_arribos_proc)->result();

		$data["pernt_proc"] = $this->allmodel->querySql($sql_pernotacion_proc)->result();
		$data["arrib_movi"] = $this->allmodel->querySql($sql_arrib_motivoviaje)->result();

		$data["proc_nac"] = $this->allmodel->querySql($sql_proc_nac)->result();
		$data["proc_ext"] = $this->allmodel->querySql($sql_proc_ext)->result();

		$data["motvviaje"] = $this->allmodel->querySql($sql_motviaj)->result();




		$this->load->view("reporte/informe",$data);
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

		
		$data["info"] =  $this->allmodel->querySql($sql)->result();

		$this->load->view("reporte/estanciadia_table",$data);

	}

	function estadodia_imprimir($fecha){

		$politica= $this->allmodel->selectWhere("politicas",array("idpoliticas" => 3))->result();

		$ingresos = "SELECT mo.fecha,po.descripcion,mo.descripcion desmovimiento,mo.monto
		FROM movimiento mo INNER JOIN concepto po ON (po.idconcepto = mo.concepto_idconcepto)
		INNER JOIN tipomovimiento tm ON (tm.idtipomovimiento = po.tipomovimiento_idtipomovimiento)
		WHERE date(mo.fecha) = '".$fecha."' and extract(HOUR from mo.fecha)>=".number_format($politica[0]->numero,'0')." and tm.idtipomovimiento = 1 and mo.estado='1' UNION
		SELECT mo.fecha,po.descripcion,mo.descripcion desmovimiento,mo.monto
		FROM movimiento mo INNER JOIN concepto po ON (po.idconcepto = mo.concepto_idconcepto)
		INNER JOIN tipomovimiento tm ON (tm.idtipomovimiento = po.tipomovimiento_idtipomovimiento)
		WHERE date(mo.fecha) = '".date ('Y-m-d',strtotime('+1 day',strtotime(date($fecha))))."' and extract(HOUR from mo.fecha)<".number_format($politica[0]->numero,'0')." and tm.idtipomovimiento = 1 and mo.estado='1'";

		$egresos = "SELECT mo.fecha,po.descripcion,mo.descripcion desmovimiento,mo.monto
		FROM movimiento mo INNER JOIN concepto po ON (po.idconcepto = mo.concepto_idconcepto)
		INNER JOIN tipomovimiento tm ON (tm.idtipomovimiento = po.tipomovimiento_idtipomovimiento)
		WHERE date(mo.fecha) = '".$fecha."' and extract(HOUR from mo.fecha)>=".number_format($politica[0]->numero,'0')." and tm.idtipomovimiento = 2 and mo.estado='1'
		UNION
		SELECT mo.fecha,po.descripcion,mo.descripcion desmovimiento,mo.monto
		FROM movimiento mo INNER JOIN concepto po ON (po.idconcepto = mo.concepto_idconcepto)
		INNER JOIN tipomovimiento tm ON (tm.idtipomovimiento = po.tipomovimiento_idtipomovimiento)
		WHERE date(mo.fecha) = '".date ('Y-m-d',strtotime('+1 day',strtotime(date($fecha))))."' and extract(HOUR from mo.fecha)<".number_format($politica[0]->numero,'0')." and tm.idtipomovimiento = 2 and mo.estado='1'";

		$dingresos = $this->allmodel->querySql($ingresos)->result(); 
		$degresos = $this->allmodel->querySql($egresos)->result(); 

		$data["ingreso"] = $dingresos;
		$data["egreso"] = $degresos;

		$this->load->view("reporte/movimientosdia_table",$data);
	}


	function adelantosueldo_imprimir($fecha_inicio,$fecha_fin){
		
		$sql = "SELECT mo.*,co.descripcion concepto
				FROM movimiento mo INNER JOIN concepto co ON (mo.concepto_idconcepto = co.idconcepto) WHERE co.idconcepto = 20 and mo.estado = '1' and co.estado='1' and 
					(date(mo.fecha) BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."') ";

	
		$data["data"] = $this->allmodel->querySql($sql)->result(); 

		$this->load->view("reporte/adelantosueldo_table",$data);

	}

	function historialpasajeros_imprimir($fecha_inicio,$fecha_fin){
		
		$sql = "SELECT 
				hb.nrohabitacion,
				date(alq.fecha_ingreso) fecha_ingreso, 
				to_char(alq.fecha_ingreso, 'HH24:MI:SS') hora_ingreso,
				cli.nombres,
				cli.apellidos,
				cli.tipodocumento,
				cli.nrodocumento,
				cli.nacionalidad,
				pr.lugar,
				cli.ocupacion,
				cli.fechanac,
				alq.kit,
				alq.fecha_salida
				FROM 
				alquiler alq INNER JOIN habitacion hb ON (alq.habitacion_idhabitacion = hb.idhabitacion)
				INNER JOIN cliente cli ON (cli.idcliente = alq.cliente_idcliente)
				INNER JOIN procedencia pr ON (pr.idprocedencia = alq.procedencia_idprocedencia)
				WHERE alq.estado='2' AND alq.tipoalquiler_idtipoalquiler <>'2' 
							AND date(alq.fecha_ingreso) BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."' ORDER BY fecha_ingreso asc";

	
		$data["data"] = $this->allmodel->querySql($sql)->result(); 

		$this->load->view("reporte/historialpasajeros_table",$data);

	}	



}
