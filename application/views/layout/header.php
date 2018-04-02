<?php 
    $encabezado = "Hospedaje Martinez";
    $fullname = $this->session->userdata('nombres')." ".$this->session->userdata('apellidos');
    $job = $this->session->userdata('cargo');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!--link rel="icon" type="image/png" sizes="16x16" href="./plugins/images/favicon.png"-->
    <title><?= $encabezado ?></title>
    <!-- Bootstrap Core CSS -->
  
    <link href="<?= base_url(); ?>_static/plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="<?= base_url(); ?>_static/plugins/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="<?= base_url(); ?>_static/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?= base_url(); ?>_static/css/animate.css" rel="stylesheet">
    <
    <!-- Custom CSS -->
    <link href="<?= base_url(); ?>_static/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?= base_url(); ?>_static/css/colors/default.css" id="theme" rel="stylesheet">

    <link href="<?= base_url(); ?>_static/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">

    <link href="<?= base_url(); ?>_static/plugins/datatables.net-responsive-bs/css/responsive.bootstrap.min.css">
    
    <?php if(count($styles)>0): ?>
    <?php foreach($styles as $style): ?>    
    <link href="<?= base_url(); ?>_static/<?= $style; ?>" rel="stylesheet">
    <?php endforeach ?>
    <?php endif?>

    <link href="<?= base_url(); ?>_static/modulos/css/<?= $static_css.".css"; ?>" rel="stylesheet">
    
    <style type="text/css" media="screen">
        #side-menu > li > ul > li > a.active{
            border-left: 3px solid #2cabe3;
        } 
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="index.html">
                        <!-- Logo icon image, you can use font-icon also --><b>
                        <!--This is dark logo icon--><img src="<?= base_url(); ?>_static/img/admin-logo.png" alt="home" class="dark-logo" /><!--This is light logo icon--><img src="<?= base_url(); ?>_static/img/admin-logo-dark.png" alt="home" class="light-logo" />
                     </b>
                        <!-- Logo text image you can use text also --><span class="hidden-xs">
                        <!--This is dark logo text--><img src="<?= base_url(); ?>_static/img/admin-text.png" alt="home" class="dark-logo" /><!--This is light logo text--><img src="<?= base_url(); ?>_static/img/admin-text-dark.png" alt="home" class="light-logo" />
                     </span> </a>
                </div>
                <!-- /Logo -->
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                            <input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>
                    </li>
                    <li>
                        <a class="profile-pic" href="#"> 
                            <img src="<?= base_url(); ?>_static/img/users/varun.jpg" alt="user-img" width="36" class="img-circle">
                            <b class="hidden-xs"><?= $fullname." - <strong>".$job."</strong>"; ?></b>
                        </a>

                    </li>
                    <li>
                     <a href="<?= base_url(); ?>login/Out">
                        <i class="fa fa-sign-out"></i>
                     </a>   
                    </li>
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->