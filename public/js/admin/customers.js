$('#editCustomer').on('show.bs.modal', function (event) {
    var a = $(event.relatedTarget);
    var name = a.data('name');
    var id = a.data('id');
    var email = a.data('email');
    var pass = a.data('pass');
    var modal = $(this);

    modal.find('.modal-title').text('Editar ' + name);
    modal.find('.modal-body #customer-id').val(id);
    modal.find('.modal-body #customer-name').val(name);
    modal.find('.modal-body #customer-email').val(email);
    modal.find('.modal-body #customer-pass').val(pass);
    modal.find('.modal-body #customer-conf-pass').val(pass);
    modal.find('.modal-body form').attr('action','/admin/customers/edit/'+id);
});

$('#delCustomer').on('show.bs.modal', function (event) {
    var a = $(event.relatedTarget);
    var name = a.data('name');
    var id = a.data('id');

    var modal = $(this);
    modal.find('.modal-title').text('Deletar ' + name);
    modal.find('.modal-body #customer-name').val(name);
    modal.find('.modal-body #customer-id').val(id);
    modal.find('.modal-body form').attr('action','/admin/customers/delete/'+id);
});
