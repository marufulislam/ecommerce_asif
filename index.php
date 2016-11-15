<?php
	require_once('include/connect.php'); 
	require_once('include/view.php');
	require_once('include/html_head.php');
?>


<body>
<div class="wrapper-wide">
  <?php include('include/header.php');?>
  
  <?php print($content);?>
  <!--Footer Start-->
  <?php require_once('include/footer.php');?>
  <!--Footer End-->
 
</div>
<!-- JS Part Start-->
<script type="text/javascript" src="js/custom.js"></script>
<!-- JS Part End-->
</body>

</html>
