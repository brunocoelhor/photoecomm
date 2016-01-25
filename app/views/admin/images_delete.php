<section class="content-header">
	<h1>
		<?= $album->name; ?>
		<small>Para deletar uma imagem do site clique no botão "Deletar Imagem"</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="/admin/images"><i class="fa fa-picture-o"></i> Imagens</a></li>
		<li class="active"><a href="#"><i class=""></i> <?= $album->name; ?></a></li>
	</ol>
</section>

<?php foreach($images as $image):?>
<div class="col-md-3 col-sm-6 col-xs-12 bottom-content">
	<a href="#" data-toggle="modal" data-target="#<?= $image->id; ?>">
		<img class="img-responsive" src="/img/photos/thumbs/<?= $image->name; ?>" alt="" >
	</a>
	<button class="btn btn-lg btn-block btn-flat btn-danger btn-delete" data-id="<?= $image->id; ?>">Deletar Imagem</button>
</div>

					<div class="modal fade" id="<?= $image->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  	<div class="modal-dialog">
						    <div class="modal-content">
						      	<div class="modal-body">
									<img class="img-responsive" src="/img/photos/<?= $image->name; ?>" alt="" >
						      	</div>
						    </div>
					    </div>
					</div>
<?php endforeach; ?>
