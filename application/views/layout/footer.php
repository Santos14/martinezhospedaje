</div>
    <!-- /#wrapper -->
    <script type="text/javascript"> var url = "<?= base_url(); ?>"; </script>
    <!-- jQuery -->  
    <script src="<?= base_url(); ?>_static/plugins/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_url(); ?>_static/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?= base_url(); ?>_static/plugins/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="<?= base_url(); ?>_static/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?= base_url(); ?>_static/js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?= base_url(); ?>_static/js/custom.min.js"></script>

    <script src="<?= base_url(); ?>_static/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>_static/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>_static/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url(); ?>_static/plugins/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>

    <script src="<?= base_url(); ?>_static/plugins/toast-master/js/jquery.toast.js"></script>

    <script type="<?= base_url(); ?>_static/js/main.js""></script>

    <?php if(count($scripts)>0): ?>
    <?php foreach($scripts as $script): ?>    
    <script src="<?= base_url(); ?>_static/<?= $script; ?>"></script>
    <?php endforeach ?>
    <?php endif?>

    <script src="<?= base_url(); ?>_static/modulos/js/<?= $static_js.".js"; ?>"></script>

    <script type="text/javascript">
        function alerta(title,body,type){
            "use strict";
             // toat popup js
             $.toast({
                 heading: title,
                 text: body,
                 position: 'top-right',
                 loaderBg: '#fff',
                 icon: type,
                 hideAfter: 3500,
                 stack: 6
             })
        }
        function solonumeros(e){
            tecla = (document.all) ? e.keyCode : e.which;

            //Tecla de retroceso para borrar, siempre la permite
            if (tecla==8){
                return true;
            }
                
            // Patron de entrada, en este caso solo acepta numeros
            patron =/[0-9]/;
            tecla_final = String.fromCharCode(tecla);
            return patron.test(tecla_final);
        }
    </script>

    

</body>

</html>
