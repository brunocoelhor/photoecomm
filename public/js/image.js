$(document).ready(function(){
	var allow_access = $('.allow-access');

	allow_access.on('click', function(event){
		var id = $(this).attr('data-id');
		$.ajax({
			url: '/image/allow-access/'+id,
			type: 'GET',
			success: function(){
				$("#allow_"+id).removeClass('btn-success allow-access')
				.addClass('btn-danger deny-access')
				.text('Negar Acesso');
			}
		});
		event.preventDefault();
	});
});


$(document).ready(function(){
	var deny_access = $('.deny-access');
	deny_access.on('click', function(event){
		var id = $(this).attr('data-id');
		$.ajax({
			url: '/image/deny-access/'+id,
			type: 'GET',
			success: function(){
				$("#allow_"+id).removeClass('btn-danger deny-access')
				.addClass('btn-success allow-access')
				.text('Permitir Acesso');
			}
		});
		event.preventDefault();
	});
});

$(document).ready(function(){
	var btn_delete = $('.btn-delete');
	btn_delete.on('click', function(event){
		var id = $(this).attr('data-id');
		$.ajax({
			url: '/image/delete/'+id,
			type: 'DELETE',
			success: function(){
				location.reload();
			}
		});
		event.preventDefault();
	});
});