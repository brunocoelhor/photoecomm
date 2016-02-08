<section class="content-header">
	<h1>
		Álbuns
		<small>Informações sobre álbuns cadastrados</small>
	</h1>
	<ol class="breadcrumb">
		<li class="active"><a href="#"><i class="fa fa-book"></i> Álbuns</a></li>
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
		<div class="row">
			<div class="box-bottom">
				<a href="#" class="btn btn-flat btn-lg btn-success cad-novo" data-toggle="modal" data-target="#cadAlbum"><i class="fa fa-plus-circle"></i><span> Cadastrar Novo Álbum</span></a>
			</div>
		</div>
		<div class="box">
	        <div class="box-body table-responsive">
	            <table id="example1" class="table table-striped">
	                <thead>
	                    <tr>
							<th>Nome</th>
							<th class="text-center">Editar</th>
							<th class="text-center">Deletar</th>
							<th class="text-center">Capa</th>
	                    </tr>
	                </thead>
	                <tbody>
	                <?php foreach($albums as $album):?>
						<tr>
							<td><?= $album->name; ?></td>
							<td class="text-center"><a href="#" data-id="<?= $album->id; ?>" class="btn btn-flat btn-warning fa fa-edit" data-toggle="modal" data-target="#editAlbum" data-name="<?=$album->name;?>" data-slug="<?php echo $album->slug; ?>" data-price="<?php echo $album->price; ?>" data-category="<?php echo $album->category_id; ?>">Editar</a></td>
							<td class="text-center"><a href="#" data-id="<?= $album->id; ?>" class="btn  btn-flat btn-danger fa fa-trash-o" data-toggle="modal" data-target="#delAlbum" data-name="<?=$album->name;?>"> Excluir</a></td>
							<td class="text-center"><a href="#" data-id="<?php echo $album->id; ?>" class="btn  btn-flat btn-primary fa fa-picture-o" data-toggle="modal" data-target="#editAlbumCover" data-name="<?=$album->name;?>" data-cover="<?=$album->cover;?>"> Gerenciar Capa</a></td>
						</tr>
					<?php endforeach; ?>
	                </tbody>
	            </table>
	        </div><!-- /.box-body -->
	    </div><!-- /.box -->

</section>

<div class="modal fade" id="cadAlbum" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
		        <div class="box">
		            <div class="box-header">
		                <h3 class="box-title">Cadastrar Novo Álbum</h3>
		            </div><!-- /.box-header -->
		            <!-- form start -->
		            <form action="/admin/albums/create/" method="post" enctype="multipart/form-data" role="form">
		                <div class="box-body">
		                    <div class="form-group">
		                    <input type="text" style="display:none" /><input type="password" style="display:none"/>
		                        <label for="album-name">Nome do Álbum</label>
		                        <input type="text" class="form-control" id="album-name" name="album-name" placeholder="Nome do Álbum"/>
		                    </div>
		                    <div class="form-group">
		                        <label for="category">Categoria Relacionada</label>
														<select class="form-control" name="album-category" id="album-category">
														<?php foreach($categories as $category): ?>
															<option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
														<?php endforeach; ?>
														</select>
		                    </div>
		                    <!-- <div class="form-group">
		                        <label for="album-password">Senha</label>
		                        <input type="password" class="form-control" id="album-password" name="album-password" placeholder="Senha para acessar o Álbum"/>
		                    </div> -->
												<!-- <div class="form-group">
		                        <label for="usuario">Usuário Relacionada</label>
														<select class="form-control" name="album-user" id="album-user">
														<?php foreach($customers as $customer): ?>
															<option value="<?php echo $customer->id; ?>"><?php echo $customer->name; ?></option>
														<?php endforeach; ?>
														</select>
		                    </div> -->
		                    <div class="form-group">
		                        <label for="album-price">Preço</label>
		                        <input type="number" class="form-control" id="album-price" name="album-price" placeholder="Preço das Fotos"/>
		                    </div>
		                </div><!-- /.box-body -->
		                <div class="box-footer">
		                	<button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Fechar</button>
		        			<button type="submit" class="btn btn-flat btn-success pull-right">
		  						<span class="fa fa-save"></span> Cadastrar Álbum
							</button>
						</div>
		            </form>
		        </div><!-- /.box -->
	  		</div>
		</div>
	</div>
</div>

<div class="modal fade" id="editAlbum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content box">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Editar </h4>
			</div>
		  	<div class="modal-body">
			    <form action="/admin/albums/edit/<?php echo $category->id; ?>" method="post" enctype="multipart/form-data" role="form">
			        <div class="box-body">
						<div class="form-group">
			                <label for="album-name">Nome do Álbum</label>
			                <input type="text" class="form-control" id="album-name" name="album-name" placeholder="Nome do Álbum"/>
			            </div>
			      <div class="form-group">
			        <label for="category">Categoria Relacionada</label>
							<select class="form-control" name="album-category" id="album-category">
							<?php foreach($categories as $category): ?>
								<option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
							<?php endforeach; ?>
							</select>
			            </div>
			            <!-- <div class="form-group">
			                <label for="album-password">Senha</label>
			                <input type="password" class="form-control" id="album-password" name="album-password" placeholder="Senha para acessar o Álbum"/>
			            </div> -->
			            <div class="form-group">
			                <label for="album-price">Preço</label>
			                <input type="number" class="form-control" id="album-price" name="album-price" placeholder="Preço das Fotos"/>
			            </div>
			            <div class="form-group hidden">
			                <label for="album-id">ID</label>
			                <input type="text" class="form-control" id="album-id" name="album-id">
			            </div>
			            <div class="form-group">
			                <label for="album-slug">Slug do Álbum</label>
			                <input type="text" class="form-control" id="album-slug" name="album-slug" value="<?php echo $category->slug ?>" />
			            </div>
			        </div><!-- .box-body -->
			        <div class="box-footer">
			        	<button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Fechar</button>
						<button type="submit" class="btn btn-flat btn-warning pull-right" id="btn-editar-form">
							<span class="fa fa-edit"></span> Editar Álbum
						</button>
					</div>
			    </form>
		  	</div>
		</div>
	</div>
</div>

<div class="modal fade" id="delAlbum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content box">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Deletar </h4>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data" role="form">
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

<div class="modal fade" id="editAlbumCover" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content box">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Cadastrar Capa da Categoria </h4>
            </div>
            <div class="modal-body">
                <div class="current-cover">
                    <h4>Imagem Atual da Capa</h4>
                        <img class="img-responsive cover-form center" src="" />
                </div>
                <form action="/admin/albums/cover/" method="post" enctype="multipart/form-data">
                    <div class="form-group hidden">
                        <label for="album-id">ID</label>
                        <input type="text" class="form-control" id="album-id" name="album-id">
                    </div>
                    <input id="uploadFile" placeholder="Escolha uma imagem" disabled="disabled" />
                    <div class="fileUpload btn btn-primary">
                        <span>Upload</span>
                        <input id="uploadBtn" type="file" name="foto" class="upload" />
                    </div>
                    <div class="box-footer">
                        <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-flat btn-primary pull-right" id="btn-editar-form">
                            <span class="fa fa-picture-o"></span> Cadastrar Imagem
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.getElementById("uploadBtn").onchange = function () {
        document.getElementById("uploadFile").value = this.value;
    };
</script>
