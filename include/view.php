
<?php 
	require('functions.php');
	$htaccess = isset($_SERVER['HTACCESS']);

	if(isset($_GET['view'])){
	 	@$view = $_GET['view'];
	}
	else {
	 	$view = 'home';
	}
	//echo $view;
	
	$page = $view.'_asoft.php';
	
	if(!is_file($page))
		$page = '404.php';
	ob_start();
	include($page);
	$content = ob_get_clean();
	
?>
