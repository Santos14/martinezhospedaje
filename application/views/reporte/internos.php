<!DOCTYPE html>
<html>
	<?php include("public/private/css.php"); ?>

	<body class="nav-md">
		<div class="container body">
      			<div class="main_container">
      				<?php include("public/private/menu.php"); ?>

      				<div class="right_col" role="main">
				          	<div class="clearfix"></div>
				         	<div class="row">
				               	<div class="col-md-12 col-sm-12 col-xs-12">
					                	<div class="x_panel">
						                  	<div class="x_title">
						                    		<h2 align="center"> <i class="fa fa-book"></i> REPORTE INTERNOS X MES </h2>
						                    		<div class="clearfix"></div>
						                  	</div>
						                  	<div class="x_content">
						                  		<iframe id="iframe-reporte" src="" style="width: 100%; height:450px;"> </iframe>
						                  	</div>
					                	</div>
				              	</div>
				          	</div>
				</div>
			        	<?php include("public/private/footer.php"); ?>
      			</div>
      		</div>
      		<?php include("public/private/js.php"); ?>
      		<script>
      			personal();
      			function personal(){
			    	var urlenvio = url+"reporte/internos_imprimir";
			    	$("#iframe-reporte").attr("src",urlenvio); 
			}
      		</script>
	</body>
</html>