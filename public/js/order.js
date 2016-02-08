$(document.body).on('click', '.buy', function(event){
		var id = $(this).attr('data-id');
		$.ajax({
			url: '/image/buy/'+id,
			type: 'GET',
			success: function(){
				$("#buy_"+id).removeClass('btn-success buy')
				.addClass('btn-danger purchased')
				.text('Selecionado');
			}
		});
		event.preventDefault();
	});

$(document.body).on('click', '.purchased', function(event){
	var id = $(this).attr('data-id');
	$.ajax({
		url: '/image/purchased/'+id,
		type: 'GET',
		success: function(){
			$("#buy_"+id).removeClass('btn-danger purchased')
			.addClass('btn-success buy')
			.text('Selecionar');
		}
	});
	event.preventDefault();
});


$('.btn-number').click(function(e){
    e.preventDefault();

    fieldName = $(this).attr('data-field');
		fieldPreco = $('').attr('data-preco');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
		var preco = $("p[name='"+fieldName+"']");
		var total = $("h6[name='"+fieldName+"']");
		var valPreco = parseInt(preco.html());

    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {

            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            }
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }


        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {

    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());

    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('O valor não pode ser menor que 1, se não desejar mais a imagem, pode remover no ícone da lixeira.');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('O número máximo de imagens é 20, caso desejar um número maior entre em contato.');
        $(this).val($(this).data('oldValue'));
    }


});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
});

$('.input-number').change(function() {
	fieldName = $(this).attr('data-field');
	type      = $(this).attr('data-type');
	var input = $("input[name='"+fieldName+"']");
	var preco = $("p[name='"+fieldName+"']");
	var total = $("h6[name='"+fieldName+"']");
	var valPreco = parseInt(preco.html());
	var currentVal = parseInt(input.val());
	var sum = 0;

	var sub = currentVal * valPreco;
	total.html(sub);

	$('.priceSub').each(function() {
	    sum += parseFloat($(this).text());
	});

	granTotal();
});

granTotal();
function granTotal(){
	var sum = 0;
	$('.priceSub').each(function() {
	    sum += parseFloat($(this).text());
	});
	return $('#grandtotal').html('R$ '+ sum);
}


$("#imprime").click(function (){
	$("div#myPrintArea").printArea();
});



$(document.body).on('click', '.del-item-order', function(event){
		var id = $(this).attr('data-id');
		$.ajax({
			url: '/area-do-cliente/cart/remove/'+id,
			type: 'POST',
			success: function(){
				location.reload();
				$("#div-message").removeClass('message-display-none');
			}
		});
		event.preventDefault();
});
