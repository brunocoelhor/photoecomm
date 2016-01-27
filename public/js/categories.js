$(document).ready(function(){

	var box = $(".box");
	var btn_editar_form = container.find("#btn-editar-form");

	box.on('click', ".delCategory", function(){
		var id = $(this).attr('data-id');
		$.ajax({
			url: '/admin/categories/deletar/'+id,
			type: 'DELETE',
			success: function(data){
				if(data === 'deletou'){
					console.log('Deletou o Post');
					location.reload();
				}else{
					console.log('Não Deletou');
				}
			}
		})
	})

	btn_editar_form.on('click', function(event){
		event.preventDefault();
		console.log("Clicou em Editar");
	});
});
