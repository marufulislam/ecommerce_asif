<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8" />
<meta name="format-detection" content="telephone=no" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.png" rel="icon" />
<title>Test | <?php echo $page_title ?></title>
<META NAME="robots" CONTENT="noindex">
<meta name="description" content="Responsive and clean html template design for any kind of ecommerce webshop">
<!-- CSS Part Start-->
<link rel="stylesheet" type="text/css" href="js/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="css/owl.carousel.css" />
<link rel="stylesheet" type="text/css" href="css/owl.transitions.css" />
<link rel="stylesheet" type="text/css" href="css/responsive.css" />
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans' type='text/css'>

<link rel="stylesheet" href="css/pages/cart.css" type="text/css" />
<!-- CSS Part End-->

<!-- JS Part Start-->
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.easing-1.3.min.js"></script>
<script type="text/javascript" src="js/jquery.dcjqaccordion.min.js"></script>
<script type="text/javascript" src="js/owl.carousel.min.js"></script>



<script src="js/formatCurrency/jquery.formatCurrency-1.4.0.js"></script>
<script src="js/formatCurrency/jquery.formatCurrency.all.js"></script>


<script src="js/jquery.shoppingCart.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/jquery.validate.js"></script>
<!-- JS Part End-->
</head>
<?php
$currency_type = currency_type();
$currency_format = currency_format($currency_type);
?>

<script type="text/javascript">
$(document).ready(function(){
		 
	jQuery('.priceAmountFormat').formatCurrency({ region: '<?php echo $currency_type;?>' });

	$("#checkout_form").validate();

	$(document).shoppingCart({
    
		cartBlock: ".cart",
		shopBlock: "#shop",
		toCart: ".add-to-cart",
		currency: "<?php echo $currency_format;?>",
		quantityLimit: 10,
		checkoutAction: "<?php echo urlroute('checkout');?>"
        
	});
    
});
</script>