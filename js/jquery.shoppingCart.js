(function($){
		  
	$.fn.shoppingCart = function(options){

		var element = $(this);
		
		var defaults = {
			cartBlock: 0,
			shopBlock: 0,
			toCart: 0,
			currency: "$",
			quantityLimit: 100,
			checkoutAction: 0
		};
		
		var options = $.extend(defaults, options);
		
		if(element.find(options.cartBlock).length != 0){
			generateShoppingCart(options.cartBlock);
		}

		if(element.find(options.shopBlock).length != 0){
			$(options.shopBlock).find(".item").find(options.toCart).click(function(){
				addToCart($(this).parents(".item").attr("data-id"));
				
				
				var cart = $('.icon-shopcart');
				
				var imgtodrag = $(this).parent('.item').find("img").eq(0);
	
				if (imgtodrag) {
					var imgclone = imgtodrag.clone()
						.offset({
						top: imgtodrag.offset().top,
						left: imgtodrag.offset().left
					})
						.css({
						'opacity': '0.5',
							'position': 'absolute',
							'height': '150px',
							'width': '150px',
							'z-index': '100'
					})
						.appendTo($('body'))
						.animate({
						'top': cart.offset().top + 10,
							'left': cart.offset().left + 10,
							'width': 75,
							'height': 75
					}, 1000, 'easeInOutExpo');
					
					setTimeout(function () {
						cart.effect("shake", {
							times: 2
						}, 200);
					}, 1500);
		
					imgclone.animate({
						'width': 0,
							'height': 0
					}, function () {
						$(this).detach()
					});
				}
				
				
				
			});
		}
		
		function addToCart(itemID){

			if($.cookie("cart")){var cartArray = stringToArray($.cookie("cart"));}
			else{var cartArray = new Array();}
			
		
			var itemName = $(".item[data-id="+itemID+"]").attr("data-name");
			var itemPrice = $(".item[data-id="+itemID+"]").attr("data-price");
			var itemPhoto = $(".item[data-id="+itemID+"]").attr("data-photo");
			
			
			if(cartArray.length == 0){
				var cartItem = [itemID, itemName, itemPrice, 1, itemPhoto];
				cartArray.push(cartItem);
			}
			
			else if(cartArray.length > 0){
				
				for(var i = 0; i < cartArray.length; i++){
					if(cartArray[i][0] == itemID){
						var isInCart = true; index = i;
						break;
					}
					else{isInCart = false;}
				}
				
				if(isInCart){
					var newQuantity = eval(cartArray[index][3]+"+1");
					if(newQuantity > options.quantityLimit){
						newQuantity = options.quantityLimit;
					}
					cartArray[index][3] = newQuantity;
				}
				else{
					var cartItem = [itemID, itemName, itemPrice, 1, itemPhoto];
					cartArray.push(cartItem);
				}
				
			}
			$.cookie("cart", cartArray.join("|"), {path:"/"});
			console.log(cartArray);
			generateShoppingCart(options.cartBlock);
		}

		function removeFromCart(itemID){
			
			if($.cookie("cart")){
			
				var cartArray = stringToArray($.cookie("cart"));
			
				for(var i = 0; i < cartArray.length; i++){
					if(cartArray[i][0] == itemID){
					
						var removeItem = cartArray[i];

						cartArray = jQuery.grep(cartArray, function(value) {
							return value != removeItem;
						});		
					
					}
				}
				
				if(cartArray == 0){emptyCart(); return false;}
				else{$.cookie("cart", cartArray.join("|"), {path:"/"});}
				
			}
			
			generateShoppingCart(options.cartBlock);
			
		}
		
		function updateQuantity(itemID, quantity, inputIndex){
			
			if($.cookie("cart"))
			{
				quantity = jQuery.trim(quantity);
						
					if(quantity != ""){
						if(quantity == "0" || quantity[0] == "0"){
							removeFromCart(itemID);
						}
						else if(isNaN(quantity)){
							quantity = 1;					
						}
						else if(quantity > options.quantityLimit){
							quantity = options.quantityLimit;					
						}
					}
					else{return false;}			
				
				var cartArray = stringToArray($.cookie("cart"));
			
				for(var i = 0; i < cartArray.length; i++){
					if(cartArray[i][0] == itemID){
						cartArray[i][3] = quantity;
					}
				}
			
				$.cookie("cart", cartArray.join("|"), {path:"/"});
				generateShoppingCart(options.cartBlock);
				
				var textInput = $(".cart-table").find("input[type=text]").eq(inputIndex);
				var textInputVal = textInput.val(); 
				
				setTimeout(function(){textInput.focus().val("").val(textInputVal);}, 1);

			}
			else{generateShoppingCart(options.cartBlock);}
			
		}
		
		
		function emptyCart(){
			
			$.cookie("cart", null, {path:"/"});
			generateShoppingCart(options.cartBlock);
			
			
			$('.cart-quantity').html('0');
			$('.cart-total').html('0');
			
		}
		

		function checkOut(){
		
			if($.cookie("cart")){
				
				var cartArray = stringToArray($.cookie("cart"));
				
				if($("#checkout-form").length != 0){$("#checkout-form").remove();}
				
				var checkoutForm = $("<form>", {
					id: "checkout-form",
					action: options.checkoutAction,
					method: "post",
					css: {display:"none"}
				});
				
				var cost = 0;
				
				for(var i = 0; i < cartArray.length; i++){
					
					var itemInputGroup = '<input type="hidden" name="id[]" value="'+cartArray[i][0]+'"/>'+
					'<input type="hidden" name="name[]" value="'+cartArray[i][1]+'"/>'+
					'<input type="hidden" name="price[]" value="'+cartArray[i][2]+' '+options.currency+'"/>'+
					'<input type="hidden" name="quantity[]" value="'+cartArray[i][3]+'"/>';
				
					checkoutForm.append(itemInputGroup);
					cost += (cartArray[i][2] * cartArray[i][3]);
					
				}
				
				checkoutForm.append('<input type="hidden" name="cost" value="'+cost.toFixed(2)+' '+options.currency+'">');
				$("body").append(checkoutForm);
				checkoutForm.submit();
				
			}
			else{generateShoppingCart(options.cartBlock);}
			
		}
		

		function generateShoppingCart(block){
			
			if($.cookie("cart") && $.cookie("cart") != ""){
				
				var cartArray = stringToArray($.cookie("cart"));
				$(block).html("");
				
				var cartTable = $('<table class="cart-table">');
				cartTable.html("");
			
				var cartTableHeader = $("<tr>", {
					id: "cart-table-header",
					html: "<td>Image</td><td>Item name</td><td>Price</td><td>Quantity</td><td>Remove</td>"
				});
			
				var totalCost = 0;
				var totalQuantity = 0;
			
				for(var i=0; i < cartArray.length; i++){
				
					var cartRow = $("<tr>", {
						html:'<td><input type="hidden" name="productId['+i+']" value="'+cartArray[i][0]+'"/><img src="'+cartArray[i][4]+'" width="64" height="64"/></td><td>'+cartArray[i][1]+'</td><td><input type="hidden" name="productPrice['+i+']" value="'+cartArray[i][2]+'"/>'+cartArray[i][2]+' '+options.currency+'</td><td><input name="productQuantity['+i+']" type="hidden" size="2" value="'+cartArray[i][3]+'"/><input name="qty['+i+']" type="text" size="2" value="'+cartArray[i][3]+'"/></td><td><a href="#'+cartArray[i][0]+'" class="remove-item"><span class="icon-remove"></span></a></td>'
					});
				
					cartTable.append(cartRow);
					totalQuantity += parseFloat(cartArray[i][3]);
					totalCost += (cartArray[i][2] * cartArray[i][3]);
					console.log(cartArray);
				}
				
				cartTable.prepend(cartTableHeader);
				
			
				var cartTableFooter = $("<tr>", {
					id:"cart-table-footer",
					html:'<td colspan="5">Total cost: <b>'+totalCost.toFixed(2)+' '+options.currency+'</b><input type="hidden" name="salesTotal" value="'+totalCost.toFixed(2)+'"/><input type="hidden" name="qtyTotal" value="'+totalQuantity+'"/></td>'
				});	
	
				cartTable.append(cartTableFooter);
				
				
				$('.cart-quantity').html(totalQuantity);
				$('.cart-total').html(totalCost.toFixed(2));
			
				var cartActions = '<tr id="cart-actions"><td colspan="4"><input id="empty" type="button" value="Empty Cart"/> <input id="checkout" type="button" value="Checkout"/></td></tr>';
			
				cartTable.append(cartActions);
			
				$(block).append(cartTable);
	
				cartTable.find("a").click(function(e){
					e.preventDefault();
					removeFromCart($(this).attr("href").replace("#",""));						
				});
				
				cartTable.find("input[type=text]").keyup(function(e){
					if(e.keyCode != 37 && e.keyCode != 39 && e.keyCode != 16){
						updateQuantity($(this).attr("name"), $(this).val(), ($(this).parents("tr").index()-1));
					}
				});	
				
				cartTable.find("#empty").click(function(){
					emptyCart();
				});
				
				cartTable.find("#checkout").click(function(){
					checkOut();
				});
				
			}
			else
			{
				$(block).html("Shopping cart is empty!");
				return false;
			}
				
		}


		function stringToArray(string){
			
			if(string){
				y = [];
				if(string.indexOf("|") != -1){
					x = string.split("|");
					for(var i in x){y.push(x[i].split(","));}
				}
				else{y.push(string.split(","));}
				
				return y;
			}
			else{return false;}
			
		}


	}
	
})(jQuery);