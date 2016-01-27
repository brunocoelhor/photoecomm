$('#editCategory').on('show.bs.modal', function (event) {
    var a = $(event.relatedTarget);
    var name = a.data('name');
    var id = a.data('id');
    var slug = a.data('slug');
    var modal = $(this);

    modal.find('.modal-title').text('Editar ' + name);
    modal.find('.modal-body #category-name').val(name);
    modal.find('.modal-body #category-id').val(id);
    modal.find('.modal-body #category-slug').val(slug);
});

$('#delCategory').on('show.bs.modal', function (event) {
    var a = $(event.relatedTarget);
    var name = a.data('name');
    var id = a.data('id');
    var modal = $(this);

    modal.find('.modal-title').text('Deletar ' + name);
    modal.find('.modal-body #album-name').val(name);
    modal.find('.modal-body #album-id').val(id);
    modal.find('.modal-body form').attr('action','/admin/categories/delete/'+id);
});

$('#editCategoryCover').on('show.bs.modal', function (event) {
    var a = $(event.relatedTarget);
    var name = a.data('name');
    var id = a.data('id');
    var cover = a.data('cover');
    var modal = $(this)

    modal.find('.modal-title').text('Cadastrar Capa da Categoria ' + name);
    modal.find('.modal-body #category-id').val(id)
    modal.find('.modal-body form').attr('action','/admin/categories/cover/'+id);
    if( cover.length === 0){
        $('.modal-body p').remove();
        $('.modal-body img').remove();
        modal.find('.modal-body .current-cover').append('<p>Nenhuma imagem cadastrada</p>');
    }else{
        $('.modal-body p').remove();
        $('.modal-body img').remove();
        modal.find('.modal-body .current-cover').append('<img class="img-responsive cover-form" src="" />');
        modal.find('.modal-body img').attr('src','/img/category_cover/' + cover);
    }
});
