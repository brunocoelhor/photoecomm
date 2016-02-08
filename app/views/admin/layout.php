<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Photo Commerce</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <!-- Favicon -->
        <link rel='shortcut icon' href='/img/favicon.png' />
        <!-- Bootstrap -->
        <link href="/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Font Awesome -->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- <link href="/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->
        <!-- DataTables style -->
        <link href="/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- jQuery -->
        <script src="/js/jquery.min.js"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-orange">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="/painel" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <img src="/img/logo.png" alt="Photo Commerce">
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-camera-retro"></i>
                                <span><?php echo $users->name; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-black">
                                    <img src="/img/users/<?php echo $users->photo; ?>" class="img-circle" alt="User Image" />
                                    <p><?php echo $users->name; ?></p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Perfil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="/logout" class="btn btn-default btn-flat">Sair</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="vert-align text-center image">
                            <img src="/img/users/<?php echo $users->photo; ?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="vert-align text-center info">
                            <p>Olá, <?php echo $users->name; ?></p>
                        </div>
                    </div>
                    <!-- search form -->

                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li>
                            <a href="<?php echo site_url();?>/painel">
                                <i class="fa fa-dashboard"></i> <span>Painel</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url();?>/admin/categories">
                                <i class="fa fa-th"></i>
                                <span>Categorias</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url();?>/admin/albums">
                                <i class="fa fa-book"></i>
                                <span>Álbuns</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url();?>/admin/images">
                                <i class="fa fa-picture-o"></i>
                                <span>Imagens</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url();?>/admin/customers">
                                <i class="fa fa-users"></i>
                                <span>Clientes</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url();?>/admin/orders">
                                <i class="fa fa-line-chart"></i>
                                <span>Pedidos</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url();?>/admin/config">
                                <i class="fa fa-gear"></i>
                                <span>Configurações</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
					<?php require $pagina.'.php';  ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <script src="/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script src="/js/bootstrap-filestyle.min.js"></script>
        <script src="/js/admin/categories.js"></script>
        <script src="/js/admin/albums.js"></script>
        <script src="/js/admin/customers.js"></script>
        <script src="/js/admin/images.js"></script>
        <script src="/js/admin/order.js"></script>

        <!-- AdminLTE App -->
        <script src="/js/AdminLTE/app.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": true
                });
            });

            setTimeout(function(){
                $('#div-alerta').fadeOut(1000);
            },4000);
        </script>
    </body>
</html>
