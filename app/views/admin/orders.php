<section class="content-header">
	<h1>
		Pedidos
		<small>Informações sobre pedidos realizados</small>
	</h1>
	<ol class="breadcrumb">
		<li class="active"><a href="#"><i class="fa fa-line-chart"></i> Pedidos</a></li>
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
			<!-- <div class="box-bottom">
				<a href="#" class="btn btn-flat btn-lg btn-success cad-novo" data-toggle="modal" data-target="#cadOrder"><i class="fa fa-plus-circle"></i><span> Cadastrar Novo Pedido</span></a>
			</div> -->
		</div>
		<div class="box">
	        <div class="box-body table-responsive">
	            <table id="example2" class="table table-striped">
	                <thead>
	                	<tr>
											<th>Código</th>
											<th>Cliente</th>
				              <th>Data</th>
				              <th>Hora</th>
											<th class="text-center">Status</th>
											<th class="text-center">Ver Detalhes</th>

				              <th class="text-center">Gerenciar Álbuns</th>
	                  </tr>
	                </thead>
	                <tbody>
	                <?php foreach($orders as $order):?>
						<tr>
							<td><?php echo $order->id; ?></td>
							<td class=""><?php echo $order->name; ?></td>
              <td class=""><?php echo date('d/m/Y', strtotime($order->date));?></td>
							<td class=""><?php echo date('H:i:s', strtotime($order->date));?></td>

							<td class="text-center">
								<?php
									switch ($order->status){
										case 0:
										echo '<p class="text-danger"><i class="fa fa-hourglass-start text-danger fa-2x"></i> Pendente</p>';
										break;
										case 1:
										echo '<p class="text-warning"><i class="fa fa-cogs text-warning fa-2x"></i> Processando</p>';
										break;
										case 2:
										echo '<p class="text-success"><i class="fa fa-thumbs-o-up text-success fa-2x"></i> Concluído</p>';
										break;
										default:
       							echo "Erro";
									}
  							?>
							</td>
							<td class="text-center"><a href="/admin/orders/orders_detail/<?= $order->id;?>" data-id="" class="btn  btn-flat btn-default fa fa-search"> Ver Detalhes</a></td>
              <td class="text-center"><a href="#" data-id="<?= $order->id; ?>" class="btn btn-flat btn-primary fa fa-book" data-toggle="modal" data-target="#edit_status" data-status="<?= $order->status;?>"> Editar Status</a></td>
						</tr>
					<?php endforeach; ?>
	                </tbody>
	            </table>
	        </div><!-- /.box-body -->
	    </div><!-- /.box -->
</section><!-- /.content -->

<div class="modal fade" id="edit_status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Status</h4>
      </div>
      <div class="modal-body">
				<form  class="form-inline" action="" method="post" enctype="multipart/form-data" role="form">
					<div class="form-group ">
						<input type="hidden" name="order" value="" id="order-id">
						<div class="input-group input-group-lg">
							<select class="form-control" name="select-status" id="select-status">

							</select>
							<span class="input-group-btn">
								<button type="submit" class="btn btn-flat btn-success btn-lg">
								<span class="fa fa-save"></span> Alterar Status
								</button>
							</span>
						</div>
					</div>
				</form>
      </div>
    </div>
  </div>
</div>
