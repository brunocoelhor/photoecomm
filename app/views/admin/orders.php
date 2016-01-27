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
			<div class="box-bottom">
				<a href="#" class="btn btn-flat btn-lg btn-success cad-novo" data-toggle="modal" data-target="#cadOrder"><i class="fa fa-plus-circle"></i><span> Cadastrar Novo Pedido</span></a>
			</div>
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
										echo $order->status = '<p class="text-danger"><i class="fa fa-hourglass-start text-danger fa-2x"></i> Pendente</p>';
										break;
										case 1:
										echo $order->status = '	<p class="text-warning"><i class="fa fa-cogs text-warning fa-2x"></i> Processando</p>';
										break;
										case 2:
										echo $order->status = '<p class="text-success"><i class="fa fa-thumbs-o-up text-success fa-2x"></i> Concluído</p>';
										break;
										default:
       							echo "Erro";

									}
  							?>
								<!-- <p class="text-danger"><i class="fa fa-hourglass-start text-danger fa-2x"></i> Pendente</p>
								<p class="text-warning"><i class="fa fa-cogs text-warning fa-2x"></i> Processando</p>
								<p class="text-success"><i class="fa fa-thumbs-o-up text-success fa-2x"></i> Concluído</p>
								<p class="text-success"><i class="fa fa-check text-success fa-2x"></i> Concluído</p> -->
								<!-- <a href="#" data-id="" class="fa fa-hourglass-start text-danger" data-toggle="modal" data-target="#editCustomer" data-name=""> Pendente</a>
								<a href="#" data-id="" class="fa fa-cogs text-warning" data-toggle="modal" data-target="#editCustomer" data-name=""> Processando</a>
								<a href="#" data-id="" class="fa fa-thumbs-o-up text-success" data-toggle="modal" data-target="#editCustomer" data-name=""> Concluído</a> -->
																		</td>
							<td class="text-center"><a href="#" data-id="" class="btn  btn-flat btn-default fa fa-search" data-toggle="modal" data-target="#delCustomer" data-name=""> Ver Detalhes</a></td>
              <td class="text-center"><a href="<?php echo site_url();?>/admin/customers/albums_manage/" class="btn  btn-flat btn-primary fa fa-book"> Gerenciar Pedido</a></td>
						</tr>
					<?php endforeach; ?>
	                </tbody>
	            </table>
	        </div><!-- /.box-body -->
	    </div><!-- /.box -->
</section><!-- /.content -->
