<?php
	session_start();
	
	unset($_SESSION[$_GET['id']]);
	header('Location: index.php');
?>
<!--script type="text/javascript">
window.location = "index.php";
</script-->