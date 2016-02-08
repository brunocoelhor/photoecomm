<section class="content-header">
	<h1>
		Cliente - <?= $customer->name; ?>
		<small>Para relacionar um novo Álbum  com <strong><?= $customer->name; ?></strong> encontre o Álbum no campo abaixo e clique em "Relacionar Álbum"</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="/admin/customers"><i class="fa fa-picture-o"></i> Clientes</a></li>
		<li><a href="/admin/customers"><i class="fa fa-picture-o"></i> Gerenciar Álbuns</a></li>
		<li class="active"><a href="#"><i class=""></i> <?= $customer->name; ?></a></li>
	</ol>
</section>

<div class="row">
	<div class="col-md-6 col-md-offset-3">
			<h3 class="text-center">Relacionar um Novo Álbum</h3>
		<form  class="form-inline" action="/admin/customers/albums_manage/album_add" method="post" enctype="multipart/form-data" role="form">
			<div class="form-group ">
				<input type="hidden" name="customer" value="<?= $customer->id; ?>" >
				<div class="input-group input-group-lg">
					<select class="form-control" name="album" id="album">
						<option value=""></option>
					<?php foreach($albums as $album): ?>
						<option value="<?php echo $album->id; ?>"><?php echo $album->name; ?></option>
					<?php endforeach; ?>
					</select>
					<span class="input-group-btn">
						<button type="submit" class="btn btn-flat btn-success btn-lg">
						<span class="fa fa-save"></span> Relacionar Álbum
						</button>
					</span>
				</div>
			</div>
		</form>
	</div>
</div> <!--row -->
<hr>

<?php echo isset($flash['erro']) ? '<div id="div-alerta" class="alert alert-danger alert-dismissable">
																			<i class="fa fa-ban"></i>
																			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$flash['erro'].'</div>' : ''; ?>
<?php echo isset($flash['sucesso']) ? '<div id="div-alerta" class="alert alert-success alert-dismissable">
									<i class="fa fa-check"></i>
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$flash['sucesso'].'</div>' : ''; ?>

<div class="row-fluid">
<?php foreach($manages as $manage):?>
    <div class="col-md-3 col-sm-6 col-xs-12 bottom-content">
    	<img class="img-responsive" src="/img/album_cover/<?= $manage->cover; ?>" alt="" >
    	<button class="btn btn-lg btn-block btn-flat btn-danger btn-manage" data-id="<?= $manage->ab; ?>">Retirar relação</button>
    </div>
<?php endforeach; ?>
</div>
