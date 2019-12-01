$(function(){
	let log = console.log;

	$('#currency').change(function(){
		window.location = 'currency/change?curr=' + $(this).val();
	});

	$('.available select').change(function(){
		let modID = $(this).val();
		let color = $(this).find('option:selected').data('title');
		let price = $(this).find('option:selected').data('price');
		let basePrice = $('#base-price').data('base');
		if(price){
			$('#base-price').text(symbolLeft + price + symbolRight);
		}else{
			$('#base-price').text(symbolLeft + basePrice + symbolRight);
		}
	});

	/*Cart*/
		$('body').on('click', '.add-to-cart-link', function(event){
			event.preventDefault();
			let id = $(this).data('id');
			let qty = $('.quantity input').val() ? $('.quantity input').val() : 1;
			let mod = $('.available select').val();

			$.ajax({
				url : '/cart/add',
				data : {
					id : id,
					qty : qty,
					mod : mod
				},
				type : 'GET',
				success : function(result){
					showCart(result);
				},
				error : function(){
					alert('Ошибка! Попробуйте позже');
				}
			});
		});

		$('#showCart').click(function(event){
			event.preventDefault();
			getCart();
		});

		$('#cart .modal-body').on('click', '.del-item', function(){
			let id = $(this).data('id');
			$.ajax({
				url : 'cart/delete',
				data : {id : id},
				type : 'GET',
				success : function(result){
					showCart(result);
				},
				error : function(){

				}
			});
		});

		function showCart(cart){
			if($.trim(cart) == '<h3>Корзина пуста</h3>'){
				$('#cart .modal-footer a, #cart .modal-footer .btn-danger').hide();
			}else{
				$('#cart .modal-footer a, #cart .modal-footer .btn-danger').show();
			}
			$('#cart .modal-body').html(cart);
			$('#cart').modal();

			if($('.cart-sum').text()){
				$('.simpleCart_total').html($('#cart .cart-sum').text());
			}else{
				$('.simpleCart_total').html('Корзина пуста');
			}
		}
		
		function getCart(){
			$.ajax({
				url : '/cart/show',
				type : 'GET',
				success : function(result){
					showCart(result);
				},
				error : function(){
					alert('Ошибка! Попробуйте позже');
				}
			});
		}
	/*Cart*/
});