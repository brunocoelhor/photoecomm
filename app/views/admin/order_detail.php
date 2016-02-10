<section class="content-header">
	<h1>
		Detalhes do Pedido
		<small>Informações sobre pedido realizado</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-line-chart"></i> Pedidos</a></li>
    <li class="active"><a href="#">Detalhes do Pedidos</a></li>
	</ol>
</section>
<section class="content">
  <div class="table-responsive">
    <table class="table table-condensed">
      <thead>
          <tr>
            <td class="text-center"><strong>Imagem</strong></td>
            <td class="text-center"><strong>Código</strong></td>
            <td class="text-center"><strong>Quantidade</strong></td>
            <td class="text-center"><strong>Total</strong></td>
          </tr>
      </thead>
      <tbody>
        <?php foreach ($items_order as $item_order): ?>
            <tr>
              <td><img class="item-img" src="/img/photos/thumbs/<?= $item_order->name; ?>" alt=""></td>
              <td class="text-center"><?= $item_order->image_id;?></td>
              <td class="text-center"><p> <?= $item_order->amount;?></p></td>
              <td class="text-center price">R$ <p name="quant-{{item_order.id}}" class="subTotal"> <?= $item_order->total;?></p></td>
            </tr>
        <?php endforeach; ?>
        <tr>
          <td class="thick-line"></td>
          <td class="thick-line"></td>
          <td class="thick-line text-center"><strong>Total</strong></td>
          <td class="thick-line text-right"><p id="grandtotal"></p></td>
        </tr>
      </tbody>
    </table>
  </div>

</section><!-- /.content -->
