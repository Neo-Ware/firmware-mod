<?
require_once("header.php");

?>
<div class="alert alert-danger" role="danger">Your modem is now rebooting. This may take up to 5 minutes.<br>Do not refresh this page.</br></div>

<?
require_once("footer.php");
shell_exec("reboot");
?>