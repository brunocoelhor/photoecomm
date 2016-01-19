<section class="content-header">
	<h1>
		Categorias
		<small>Informações sobre categorias cadastradas</small>
	</h1>
	<ol class="breadcrumb">
		<li class="active"><a href="#"><i class="fa fa-th"></i> Categorias</a></li>
	</ol>
</section>
<section class="content">
	<?php echo isset($flash['erro']) ? '<div id="div-alerta" class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$flash['erro'].'</div>' : ''; ?>
	<?php echo isset($flash['sucesso']) ? '<div id="div-alerta" class="alert alert-success alert-dismissable">
										<i class="fa fa-check"></i>
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$flash['sucesso'].'</div>' : ''; ?>
		<div class="row">
			<div class="box-bottom">
				<a href="#" class="btn btn-flat btn-lg btn-success cad-novo" data-toggle="modal" data-target="#cadCategory"><i class="fa fa-plus-circle"></i><span> Cadastrar Nova Categoria</span></a>
			</div>
		</div>
		<div class="box">
	        <div class="box-body table-responsive">
	            <table id="example1" class="table table-striped">
	                <thead>
	                    <tr>
							<th>Nome</th>
							<th hidden>Categoria</th>
							<th class="text-center">Editar</th>
							<th class="text-center">Deletar</th>
                            <th class="text-center">Capa</th>
	                    </tr>
	                </thead>
	                <tbody>
	                <?php foreach($categories as $category):?>
						<tr>
							<td><?php echo $category->name; ?></td>
							<td class="hidden"></td>
							<td class="text-center"><a href="#" data-id="<?php echo $category->id; ?>" class="btn btn-flat btn-warning fa fa-edit" data-toggle="modal" data-target="#editCategory" data-name="<?=$category->name;?>" data-slug="<?= $category->slug; ?>">Editar</a></td>
							<td class="text-center"><a href="#" data-id="<?php echo $category->id; ?>" class="btn  btn-flat btn-danger fa fa-trash-o" data-toggle="modal" data-target="#delCategory" data-name="<?=$category->name;?>"> Excluir</a></td>
                            <td class="text-center"><a href="#" data-id="<?php echo $category->id; ?>" class="btn  btn-flat btn-primary fa fa-picture-o" data-toggle="modal" data-target="#editCategoryCover" data-name="<?=$category->name;?>" data-cover="<?=$category->cover;?>"> Gerenciar Capa</a></td>
						</tr>
					<?php endforeach; ?>
	                </tbody>
	            </table>
	        </div><!-- /.box-body -->
	    </div><!-- /.box -->
</section><!-- /.content -->

<div class="modal fade" id="cadCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
  		<div class="modal-body">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Cadastrar Nova Categoria</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form action="/admin/categories/create/" method="post" enctype="multipart/form-data" role="form">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="category-name">Nome da Categoria</label>
                            <input type="text" class="form-control" id="category-name" name="category-name" placeholder="Nome da Categoria"/>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                    	<button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Fechar</button>
            			<button type="submit" class="btn btn-flat btn-primary pull-right">
	  						<span class="fa fa-save"></span> Cadastrar Categoria
						</button>
					</div>
                </form>
            </div><!-- /.box -->
      	</div>
    </div>
  </div>
</div>

<div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content box">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Editar </h4>
      </div>
      <div class="modal-body">
        <form action="/admin/categories/edit/<?php echo $category->id; ?>" method="post" enctype="multipart/form-data" role="form">
            <div class="box-body">
                <div class="form-group">
                    <label for="category-name">Nome da Categoria</label>
                    <input type="text" class="form-control" id="category-name" name="category-name" value="<?php echo $category->name ?>" />
                </div>
                <div class="form-group hidden">
                    <label for="category-id">ID</label>
                    <input type="text" class="form-control" id="category-id" name="category-id">
                </div>
                <div class="form-group">
                    <label for="category-slug">Slug da Categoria</label>
                    <input type="text" class="form-control" id="category-slug" name="category-slug" value="<?php echo $category->slug ?>" />
                </div>
            </div><!-- .box-body -->
            <div class="box-footer">
            	<button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Fechar</button>
    			<button type="submit" class="btn btn-flat btn-primary pull-right" id="btn-editar-form">
    				<span class="fa fa-edit"></span> Editar Categoria
				</button>
			</div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="delCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content box">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Deletar </h4>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data" role="form">
            <div class="box-body">
                <p>Por medida de segurança para deletar uma categoria não poderá haver nenhum álbum cadastrado.</p>
            </div><!-- .box-body -->
            <div class="box-footer">
                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-flat btn-danger pull-right" id="btn-editar-form">
                    <span class="fa fa-trash-o"></span> Deletar Categoria
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editCategoryCover" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <form action="/admin/categories/cover/" method="post" enctype="multipart/form-data">
                    <div class="form-group hidden">
                        <label for="category-id">ID</label>
                        <input type="text" class="form-control" id="category-id" name="category-id">
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
