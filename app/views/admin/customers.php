<section class="content-header">
	<h1>
		Clientes
		<small>Informações sobre clientes cadastradas</small>
	</h1>
	<ol class="breadcrumb">
		<li class="active"><a href="#"><i class="fa fa-th"></i> Clientes</a></li>
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
				<a href="#" class="btn btn-flat btn-lg btn-success cad-novo" data-toggle="modal" data-target="#cadCustomer"><i class="fa fa-plus-circle"></i><span> Cadastrar Novo Cliente</span></a>
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
                            <th class="text-center">Gerenciar Álbuns</th>
	                    </tr>
	                </thead>
	                <tbody>
	                <?php foreach($customers as $customer):?>
						<tr>
							<td><?php echo $customer->name; ?></td>
							<td class="hidden"></td>
							<td class="text-center"><a href="#" data-id="<?php echo $customer->id; ?>" class="btn btn-flat btn-warning fa fa-edit" data-toggle="modal" data-target="#editCustomer" data-name="<?=$customer->name;?>" data-email="<?= $customer->email; ?>" data-pass="<?= $customer->password; ?>">Editar</a></td>
							<td class="text-center"><a href="#" data-id="<?php echo $customer->id; ?>" class="btn  btn-flat btn-danger fa fa-trash-o" data-toggle="modal" data-target="#delCustomer" data-name="<?=$customer->name;?>"> Excluir</a></td>
                            <td class="text-center"><a href="#" data-id="<?php echo $customer->id; ?>" class="btn  btn-flat btn-primary fa fa-book" data-toggle="modal" data-target="#manAlbums" data-name="<?=$customer->name;?>"> Gerenciar Álbuns</a></td>
						</tr>
					<?php endforeach; ?>                   
	                </tbody>
	            </table>
	        </div><!-- /.box-body -->
	    </div><!-- /.box -->
</section><!-- /.content -->

<div class="modal fade" id="cadCustomer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
  		<div class="modal-body">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Cadastrar Novo Cliente</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form action="/admin/customers/create/" method="post" enctype="multipart/form-data" role="form">
                    <div class="box-body">
        			    <div class="form-group col-lg-6">
            				<label for="customer-name">Nome do Cliente</label>
            				<input type="text" class="form-control" name="customer-name" placeholder="Nome do Cliente" value="<?php echo isset($flash['nomeUsuario']) ? $flash['nomeUsuario'] : '';?>"/>
        				</div>
            			<div class="form-group col-lg-6">
            				<label for="customer-email">E-mail</label>
            				<input type="text" class="form-control" name="customer-email" placeholder="E-mail do Cliente" value="<?php echo isset($flash['emailUsuario']) ? $flash['emailUsuario'] : '';?>"/>
            			</div>
                		<div class="">
                			<div class="form-group col-lg-6 ">
                				<label for="customer-pass">Senha</label>
                				<input type="password" class="form-control" name="customer-pass" placeholder="Senha" value="<?php echo isset($flash['senhaUsuario']) ? $flash['senhaUsuario'] : '';?>"/>
                			</div>
                			<div class="form-group col-lg-6">
                				<label for="conf-pass-customer">Confirmar Senha</label>
                				<input type="password" class="form-control" name="customer-conf-pass" placeholder="Confirmar a Senha" value="<?php echo isset($flash['slugProduto']) ? $flash['slugProduto'] : '';?>"/>
                			</div>
                		</div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                    	<button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Fechar</button>
            			<button type="submit" class="btn btn-flat btn-success pull-right">
	  						<span class="fa fa-save"></span> Cadastrar Cliente
						</button>
					</div>
                </form>
            </div><!-- /.box -->
      	</div>
    </div>
  </div>
</div>

<div class="modal fade" id="editCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content box">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Editar </h4>
            </div>
            <div class="modal-body">
                <form action="/admin/customers/edit/<?php echo $customer->id; ?>" method="post" enctype="multipart/form-data" role="form">
                    <div class="box-body">
                        <div class="form-group hidden">
                            <label for="customer-id">ID</label>
                            <input type="text" class="form-control" id="customer-id" name="customer-id">
                        </div>                     
                        <div class="form-group col-lg-6">
                            <label for="name-customer">Nome do Cliente</label>
                            <input type="text" class="form-control" name="customer-name" id="customer-name" placeholder="Nome do Cliente" value="<?php echo isset($flash['nomeUsuario']) ? $flash['nomeUsuario'] : '';?>"/>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="email-customer">E-mail</label>
                            <input type="text" class="form-control" name="customer-email" id="customer-email" placeholder="E-mail do Client" value="<?php echo isset($flash['emailUsuario']) ? $flash['emailUsuario'] : '';?>"/>
                        </div>
                        <div class="">
                            <div class="form-group col-lg-6 ">
                                <label for="pass-customer">Senha</label>
                                <input type="password" class="form-control" name="customer-pass" id="customer-pass" placeholder="Senha" value="<?php echo isset($flash['senhaUsuario']) ? $flash['senhaUsuario'] : '';?>"/>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="conf-pass-customer">Confirmar Senha</label>
                                <input type="password" class="form-control" name="customer-conf-pass" id="customer-conf-pass" placeholder="Confirmar a Senha" value="<?php echo isset($flash['slugProduto']) ? $flash['slugProduto'] : '';?>"/>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-flat btn-warning pull-right">
                            <span class="fa fa-edit"></span> Editar Cliente
                        </button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content box">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Deletar </h4>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data" role="form">
            <div class="box-body">
                <p>Tem certeza que deseja deletar o cadastro do cliente?</p>                                      
            </div><!-- .box-body -->
            <div class="box-footer">
                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-flat btn-danger pull-right" id="btn-editar-form">
                    <span class="fa fa-trash-o"></span> Deletar Cliente
                </button>
            </div>
        </form>   
      </div>
    </div>
  </div>
</div>

