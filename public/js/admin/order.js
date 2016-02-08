$('#edit_status').on('show.bs.modal', function (event) {
    var a = $(event.relatedTarget);
    var id = a.data('id');
    var status = a.data('status');
    var modal = $(this);
    modal.find('.modal-body #order-id').val(id);
    modal.find('.modal-body form').attr('action','/admin/orders/orders_detail/edit_status/'+id);

    switch (status){
      case 0:
      modal.find('.modal-body #select-status').empty();
      modal.find('.modal-body #select-status').append("<option value='0'>Pendente</option>");
      modal.find('.modal-body #select-status').append("<option value='1'>Processando</option>");
      modal.find('.modal-body #select-status').append("<option value='2'>Concluído</option>");
      break;
      case 1:
      modal.find('.modal-body #select-status').empty();
      modal.find('.modal-body #select-status').append("<option value='1'>Processando</option>");
      modal.find('.modal-body #select-status').append("<option value='2'>Concluído</option>");
      modal.find('.modal-body #select-status').append("<option value='0'>Pendente</option>");
      break;
      case 2:
      modal.find('.modal-body #select-status').empty();
      modal.find('.modal-body #select-status').append("<option value='2'>Concluído</option>");
      modal.find('.modal-body #select-status').append("<option value='0'>Pendente</option>");
      modal.find('.modal-body #select-status').append("<option value='1'>Processando</option>");
      break;
    }
});


function granTotal(){

	var sum = 0;
	$('.subTotal').each(function() {
	    sum += parseFloat($(this).text());
	});
	return $('#grandtotal').html('R$ '+ sum);
}
granTotal();
