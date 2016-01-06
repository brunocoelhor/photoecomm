<section class="content-header">
	<h1>
		Home
		<small>Informações Gerais</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	</ol>
</section>
<section class="content">
	<div class="row">
	    <div class="col-lg-6 col-xs-6">
	        <!-- small box -->
	        <div class="small-box bg-aqua">
	            <div class="inner">
	                <h3>
	                    <?php echo count($categories); ?>
	                </h3>
	                <p>
	                    Categorias Cadastradas
	                </p>
	            </div>
	            <div class="icon">
	                <i class="fa fa-th"></i>
	            </div>
	            <a href="<?php echo site_url();?>/admin/categories" class="small-box-footer">
	                Mais informações <i class="fa fa-arrow-circle-right"></i>
	            </a>
	        </div>
	    </div><!-- ./col -->
	    <div class="col-lg-6 col-xs-6">
	        <!-- small box -->
	        <div class="small-box bg-green">
	            <div class="inner">
	                <h3>
	                    <?php echo count($albums); ?>
	                </h3>
	                <p>
	                    Álbuns Cadastrados
	                </p>
	            </div>
	            <div class="icon">
	                <i class="fa fa-book"></i>
	            </div>
	            <a href="<?php echo site_url();?>/admin/albums" class="small-box-footer">
	                Mais informações <i class="fa fa-arrow-circle-right"></i>
	            </a>
	        </div>
	    </div><!-- ./col -->
	    <div class="col-lg-6 col-xs-6">
	        <!-- small box -->
	        <div class="small-box bg-yellow">
	            <div class="inner">
	                <h3>
	                    <?php echo count($images); ?>
	                </h3>
	                <p>
	                    Imagens Cadastradas
	                </p>
	            </div>
	            <div class="icon">
	                <i class="fa fa-picture-o"></i>
	            </div>
	            <a href="<?php echo site_url();?>/admin/images" class="small-box-footer">
	                Mais informações <i class="fa fa-arrow-circle-right"></i>
	            </a>
	        </div>
	    </div><!-- ./col -->
	    <div class="col-lg-6 col-xs-6">
	        <!-- small box -->
	        <div class="small-box bg-red">
	            <div class="inner">
	                <h3>
	                    0
	                </h3>
	                <p>
	                    Pedidos Realizados
	                </p>
	            </div>
	            <div class="icon">
	                <i class="fa fa-line-chart"></i>
	            </div>
	            <a href="#" class="small-box-footer">
	                Mais informações <i class="fa fa-arrow-circle-right"></i>
	            </a>
	        </div>
	    </div><!-- ./col -->
	</div><!-- /.row -->
</section>