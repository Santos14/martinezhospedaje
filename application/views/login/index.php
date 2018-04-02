<?php 
    $usuario = array(
        'class' => 'form-control',
        'name' => 'usuario',
        'placeholder' => 'Usuario',
        'autofocus' => 'autofocus',
        'maxlength' => '50'
    );
    $password = array(
        'class' => 'form-control',
        'type' => 'password',
        'name' => 'clave',
        'placeholder' => 'Contraseña',
        'maxlength' => '50'
    );
    $login = array(
        'type' => 'submit',
        'class' => 'btn btn-lg btn-success btn-block',
        'name' => 'btn_login',
        'value' => 'Login'
    );

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $name_system ?></title>
    <!-- Bootstrap Core CSS -->
   <link href="<?= base_url(); ?>_static/plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="<?= base_url(); ?>_static/css/style.css" rel="stylesheet">
    
    <link href="<?= base_url(); ?>_static/css/colors/default.css" id="theme" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-4" >
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center"><strong>SIGN IN</strong></h3>
                    </div>
                    <div class="panel-body">
                        <?= form_open("login/In",array())?>
                                <div class="form-group"><?= form_input($usuario) ?></div>
                                <div class="form-group"><?= form_input($password) ?></div>
                                <?= form_input($login) ?>  
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="<?= base_url(); ?>_static/plugins/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?= base_url(); ?>_static/plugins/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>
