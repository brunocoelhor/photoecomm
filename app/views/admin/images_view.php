<section class="content-header">
	<h1 class="title-panel">
		<?= $album->name; ?>
		<small>Para liberar a vizualização das imagem no site clique no botão "Liberar Acesso"</small>
	</h1>
	<ol class="breadcrumb coisa-panel">
		<li><a href="/admin/images"><i class="fa fa-picture-o"></i> Imagens</a></li>
		<li class="active"><a href="#"><i class=""></i> <?= $album->name; ?></a></li>
	</ol>
</section>

<?php foreach($images as $image):?>
	<div class="col-md-3 col-sm-6 col-xs-12 bottom-content">
		<a href="#" data-toggle="modal" data-target="#<?= $image->id; ?>">
			<img class="img-responsive" src="http://localhost:8888/img/photos/thumbs/<?= $image->name; ?>" alt="" >
		</a>
		<button class="btn btn-lg btn-block btn-flat <?php $val = ($image->open == 0) 
			? 'btn-success allow-access' : 'btn-danger deny-access'; echo $val; ?>" data-id="<?= $image->id; ?>" 
			id="allow_<?= $image->id; ?>"><?php $val = ($image->open == 0) ? 'Liberar Acesso' : 'Negar Acesso'; echo $val; ?></button>
	</div>

	<!-- MODAL -->
	<div class="modal fade" id="<?= $image->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  	<div class="modal-dialog">
		    <div class="modal-content">
		      	<div class="modal-body">
					<img class="img-responsive" src="http://localhost:8888/img/photos/<?= $image->name; ?>" alt="" >
		      	</div>
		    </div>
	    </div>
	</div>
<?php endforeach; ?>






