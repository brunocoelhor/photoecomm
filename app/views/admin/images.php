<section class="content-header">
	<h1>
		Imagens
		<small>Informações sobre imagens cadastradas</small>
	</h1>
	<ol class="breadcrumb">
		<li class="active"><a href="#"><i class="fa fa-book"></i> Imagens</a></li>
	</ol>
</section>
<section class="content">
  	<?php echo isset($flash['mensagem']) ? $flash['mensagem'] : ''; ?>
	<?php echo isset($flash['erro']) ? '<div id="div-alerta" class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$flash['erro'].'</div>' : ''; ?>
	<?php echo isset($flash['sucesso']) ? '<div id="div-alerta" class="alert alert-success alert-dismissable">
										<i class="fa fa-check"></i>
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$flash['sucesso'].'</div>' : ''; ?>
		<div class="box">
	        <div class="box-body table-responsive">
	            <table id="example1" class="table table-striped">
	                <thead>
	                    <tr>
							<th>Nome</th>
							<!-- <th class="">Categoria</th> -->
							<th class="text-center">Adicionar</th>
							<th class="text-center">Ver</th>
							<th class="text-center">Excluir</th>
	                    </tr>
	                </thead>
	                <tbody>
	                <?php foreach($albums as $album):?>
						<tr>
							<td><?= $album->name; ?></td>
							<!-- <td class=""><?= $album->category_id; ?></td>
							<td><a href="<?php echo site_url();?>/admin/configurar/album/foto/<?php echo $album->id;  ?>" class="btn btn-flat btn-info glyphicon glyphicon-picture"> Imagem</a></td>-->
							<td class="text-center"><a href="#" data-id="<?= $album->id; ?>" class="btn  btn-flat btn-success fa fa-camera" data-toggle="modal" data-target="#cadImage" data-name="<?=$album->name;?>"> Adicionar Fotos</a></td>
							<td class="text-center"><a href="<?php echo site_url();?>/admin/images/photo/view/<?= $album->id; ?>" class="btn btn-flat btn-primary fa fa-eye" > Ver Fotos</a></td>
							<td class="text-center"><a href="<?php echo site_url();?>/admin/images/photo/delete/<?= $album->id; ?>" class="btn  btn-flat btn-danger fa fa-trash-o"> Excluir Fotos</a></td>
						</tr>
					<?php endforeach; ?>
	                </tbody>
	            </table>
	        </div><!-- /.box-body -->
	    </div><!-- /.box -->
</section>

<div class="modal fade" id="cadImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
    	<div class="modal-content box">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="exampleModalLabel">Inserir Fotos em </h4>
      		</div>
            <div class="modal-body">
                <form action="/admin/images/photo/" method="post" enctype="multipart/form-data">
                    <div class="form-group hidden">
                        <label for="album-id">ID</label>
                        <input type="text" class="form-control" id="album-id" name="album-id">
                    </div>
                    <label>Escolha as fotos para o álbum:</label>
                    <input id="uploadFile" placeholder="Escolha uma imagem" disabled="disabled" />
                    <div class="fileUpload btn btn-flat btn-primary">
                        <span>Upload</span>
                        <input id="uploadBtn" type="file" name="foto[]" multiple class="upload" />
                    </div>
                    <div class="box-footer">
                        <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-flat btn-success pull-right" id="btn-editar-form">
                            <span class="fa fa-picture-o"></span> Cadastrar Fotos
                        </button>
                    </div>
                </form>
            </div>


<div class="modal fade" id="delAlbum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content box">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Deletar </h4>
      </div>
      <div class="modal-body">
        <form action="/admin/albums/delete/<?php echo $album->id; ?>" method="post" enctype="multipart/form-data" role="form">
            <div class="box-body">
                <p>Por medida de segurança para deletar um álbum não poderá haver nenhuma foto cadastrada.</p>
                <p>Você tem certeza que deseja deletar este álbum?</p>
            </div><!-- .box-body -->
            <div class="box-footer">
                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-flat btn-danger pull-right" id="btn-editar-form">
                    <span class="fa fa-trash-o"></span> Deletar Álbum
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
