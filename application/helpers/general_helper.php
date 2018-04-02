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