<?php
	
	// css,js
	function layoutSystem($url,$data='',$_static = array()){
		$CI =& get_instance();
		$js_static = strdivider($url,"/");

		$css["static_css"] = $js_static[0];
		$js["static_js"] = $js_static[0];
		if(isset($_static["css"])){ $css["styles"] = $_static["css"];}else{$css["styles"] = array();}
		if(isset($_static["js"])){ $js["scripts"] = $_static["js"];}else{ $js["scripts"] = array();}

		if($CI->session->userdata('logged_in')){
			$CI->load->view('layout/header',$css);	
			$CI->load->view('layout/menu');	
			$CI->load->view($url, $data);	
			$CI->load->view('layout/footer',$js);	
		}else{
			redirect(base_url(),'refresh');		
		}
	}

	function pasajerosactuales(){
		$CI =& get_instance();
		$sql1 = "SELECT alq.*,hb.nrohabitacion,hb.precio,cli.nrodocumento,cli.nombres,cli.apellidos,(SELECT sum(am.monto) monto
				FROM amortizacion am INNER JOIN alquiler al ON (al.idalquiler = am.alquiler_idalquiler)
				WHERE am.estado = '1' and al.idalquiler = alq.idalquiler
				GROUP BY al.idalquiler
				) pagado
				FROM alquiler alq INNER JOIN habitacion hb ON (alq.habitacion_idhabitacion = hb.idhabitacion)
				INNER JOIN cliente cli ON (cli.idcliente = alq.cliente_idcliente)
				WHERE alq.estado='1' ORDER BY hb.nrohabitacion asc";

		$alquiler = $CI->allmodel->querySql($sql1)->result();

		$politica = $CI->allmodel->selectWhere("politicas",array("idpoliticas" => 3))->result();


		$hora_termino = $politica[0]->numero;
	  	$minuto_termino = "00";
	  	$segundo_termino = "00";
		//TERNINO DE FIN DEL DIA 
	 	$hora_fin = '02';
	 	$minuto_fin = "59";
	  	$segundo_fin = "59";



	  	//Start
	  	$data_alquiler = array();

	  	 for ($h = 0; $h < count($alquiler) ; $h++) {

	  		$m = false;
	  		$ahora = new DateTime("NOW");
	  		
	  	 	if($alquiler[$h]->tipoalquiler_idtipoalquiler == '3'){
	  	 		$fi = new DateTime($alquiler[$h]->fecha_salida);
	  	 		$diff = $ahora->diff($fi);

	          	$dias = (strtotime(date("Y-m-d"))-strtotime(date_format($fi,"Y-m-d")))/86400;
	         	$dias = abs($dias); $dias = floor($dias); 
	         	if(
	         		$diff->y == 0 && 
	         		date("H")>=$hora_termino && 
	         		date("i")>=$minuto_termino && 
	         		date("s")>=$segundo_termino
	         	){
	         		$m = true;
	         		$f = $alquiler[$h]->fecha_salida;
	         	}
	  	 	}else{
	  	 		$m = true;
	  	 		$f = $alquiler[$h]->fecha_ingreso;
	  	 	}

	  	 	 if($m){

	  	 	//$f = $alquiler[$h]->fecha_ingreso;
	       
	        $fi = new DateTime($f);
	        $diff = $ahora->diff($fi);

	          $dias = (strtotime(date_format($fi,"Y-m-d"))-strtotime(date("Y-m-d")))/86400;
	          $dias = abs($dias); $dias = floor($dias); 

	          $rango=false;

	          if($fi->format('H')>='00' && $fi->format('i') >= '00' && $fi->format('s') >= '00'){
	              if($fi->format('H')<=$hora_fin  && $fi->format('i') <= $minuto_fin  && $fi->format('s') <= $segundo_fin ){
	                $rango = true;
	             }
	          }

	          $cont = 1; 
	          $pen = 0;
	          $s = 0;

	          $f = date_format($fi,"Y-m-d");

	          $pagado = $alquiler[$h]->pagado; 
	          if($dias == "0"): 

	              if($rango){
	                  $n =  date ('Y-m-d',strtotime ('-1 day',strtotime($f)));
	              }else{
	                  $n = $f;
	              }
	            
	               
	                                         
	              if($rango){
	                if(date("H")>=$hora_termino && date("i")>=$minuto_termino && date("s")>=$segundo_termino){
	                    $s = 1;
	                  }
	              }

	              if($pagado==""){
	                  $resto = 0;  
	                  $pen+=$alquiler[$h]->precioxdia;    

	              }else{

	                $resto = $pagado; 
	                if($resto < $alquiler[$h]->precioxdia){
	                    $resto = $alquiler[$h]->precioxdia-$resto;  
	                    $pen+=$resto; 
	                    $resto = 0;
	                }else{
	                    if($resto >= $alquiler[$h]->precioxdia){
	                        $resto = $resto-$alquiler[$h]->precioxdia;         
	                    }
	                }
	              } 

	              for ($i = 0; $i < $s ; $i++){ 
	                $n =  date ('Y-m-d',strtotime ('+1 day',strtotime($n)));  

	                 if($resto != 0){  
	                    if($resto >= $alquiler[$h]->precioxdia){  
	                       $resto = $resto -$alquiler[$h]->precioxdia;  
	                    }else{ 
	                        $resto = $alquiler[$h]->precioxdia - $resto; 
	                        $pen += $resto;
	                    } 
	                  }else{  
	                        $pen+=$alquiler[$h]->precioxdia;     
	                   }  
	              } 


	          else:   

	            $cant = $dias; 

	            if(date("H")>=$hora_termino && date("i")>=$minuto_termino && date("s")>=$segundo_termino){
	                $cant++;
	            }
	            if($rango){
	              $cant++;
	            }
	            if($pagado!=""){
	              $resto = $pagado;  
	            }else{
	              $resto = 0;
	            }
	            
	            $n =  date ('Y-m-d',strtotime ('-1 day',strtotime($f)));
	            for ($i = 0; $i < $cant ; $i++) { 
	            

	                if($rango){
	                  $n =  date ('Y-m-d',strtotime ('+1 day',strtotime($n)));
	                }else{
	                  
	                  $fi->add(new DateInterval('P1D'));
	                }

	                if( $resto != 0){
	                  if( $resto >= $alquiler[$h]->precioxdia){
	                    $resto = $resto - $alquiler[$h]->precioxdia;  
	                  }else{
	                    $r = $alquiler[$h]->precioxdia - $resto; 
	                    $resto =0;
	                    $pen += $r;
	                  } 
	                }else{
	                  $pen+=$alquiler[$h]->precioxdia;  
	                }               
	             }
	                       
	          endif;  
	         }else{
	         	$pen = 0;
	         }

	          


	          $ventas= $CI->allmodel->querySql("SELECT v.*,(
				SELECT sum(dv.precio)
				FROM venta ve INNER JOIN detalle_venta dv ON (ve.idventa = dv.venta_idventa)
				WHERE ve.estado<>'3' and ve.idventa = v.idventa
				GROUP BY ve.idventa
				) total
				FROM alquiler a INNER JOIN venta_alquiler va on(a.idalquiler = va.alquiler_idalquiler)
				INNER JOIN venta v ON(va.venta_idventa = v.idventa)
				WHERE v.estado <> '3' and a.idalquiler =".$alquiler[$h]->idalquiler)->result();

	          $sum_ventas = 0;
	          foreach ($ventas as $venta) {
	          	if($venta->estado == '1'){
	          	 $sum_ventas+=$venta->total;
	          	}
	          }

	          $imprevistos = $CI->allmodel->querySql("SELECT i.*,ti.descripcion tipoimprevisto
					FROM imprevisto i INNER JOIN tipoimprevisto ti ON (i.tipoimprevisto_idtipoimprevisto = ti.idtipoimprevisto)
					WHERE ti.estado <> '0' and alquiler_idalquiler=".$alquiler[$h]->idalquiler)->result();
	          $sum_imprevisto = 0;
	          foreach ($imprevistos as $imprevisto) {
	          	if($imprevisto->estado == '1'){
	          	 $sum_imprevisto+=$imprevisto->monto;
	          	}
	          	
	          }

	          $data_alquiler["alquiler"][] = $alquiler[$h];
	          $data_alquiler["deuda_habitacion"][] = $pen;
	          $data_alquiler["deuda_ventas"][] = $sum_ventas;
	          $data_alquiler["deuda_imprevistos"][] = $sum_imprevisto;
	      }  

	    return $data_alquiler;
	}

	function nombreMes($mes){
		switch ($mes) {
            case '1':
                $nmes = "ENERO";
                break;
             case '2':
                $nmes = "FEBRERO";
                 break;
            case '3':
                $nmes = "MARZO";
                break;
            case '4':
                $nmes = "ABRIL";
                break;
            case '5':
                $nmes = "MAYO";
                # code...
                break;
            case '6':
                $nmes = "JUNIO";
                # code...
                break;
            case '7':
                $nmes = "JULIO";
                # code...
                break;
            case '8':
                $nmes = "AGOSTO";
                # code...
                break;
            case '9':
                $nmes = "SETIEMBRE";
                # code...
                break;
            case '10':
                $nmes = "OCTUBRE";
                # code...
                break;
            case '11':
                $nmes = "NOVIEMBRE";
                # code...
                break;
            case '12':
                $nmes = "DICIEMBRE";
                # code...
                break; 
        }
        return $nmes;
	}




	function getMonthDays($Month, $Year){
	   //Si la extensión que mencioné está instalada, usamos esa.
	   if( is_callable("cal_days_in_month"))
	   {
	      return cal_days_in_month(CAL_GREGORIAN, $Month, $Year);
	   }
	   else
	   {
	      //Lo hacemos a mi manera.
	      return date("d",mktime(0,0,0,$Month+1,0,$Year));
	   }
	}

	function strdivider($cadena,$delimiter){
		$c = array();
		$part = "";
		for ($i = 0; $i < strlen($cadena) ; $i++) {
			if(substr($cadena,$i,1)==$delimiter){
				$c[] = $part;
				$part = "";
			}else{
				$part.=substr($cadena,$i,1);
			}
		}
		$c[] = $part;
		return $c;
	}

?>