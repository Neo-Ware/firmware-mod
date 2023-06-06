<?
require_once("header.php");

?>

 <div class="row">
    <div class="col-sm-6">
		<div class="card">
		  <div class="card-header bg-primary text-light">Kernel Logs</div>
		  <div class="card-body scroll bg-light text-primary">
		  <?php
		  $data = shell_exec("dmesg");
		  $data = str_replace("\n", "<br>", $data);
		  print($data);
		  ?>
		  </diV>
		</div>
	</div>


	<div class="col-sm-6">
		<div class="card">
		  <div class="card-header bg-primary text-light">DOCSIS Logs</div>
		  <div class="card-body scroll bg-light text-primary">
		   <?php
		  $data = file_get_contents("/var/tmp/log2");
		  $data = str_replace("\n", "<br>", $data);
		  print($data);
		  ?>
		  </diV>
		</div>
	</div>
	</div><br>
	 <div class="row">

	<div class="col-sm-6">
		<div class="card">
		  <div class="card-header bg-primary text-light">Reset Log</div>
		  <div class="card-body scroll bg-light text-primary">
		  <?php
		  $data = file_get_contents("/nvram/6/arris_reset.log");
		  $data = str_replace("\n", "<br>", $data);
		  print($data);
		  ?>
		  </diV>
		</div>
	</div>
	

	<div class="col-sm-6">
		<div class="card">
		  <div class="card-header bg-primary text-light">PCD Error log</div>
		  <div class="card-body scroll bg-light text-primary">
		    <?php
		  $data = file_get_contents("/nvram/pcd_error_log.txt");
		  $data = str_replace("\n", "<br>", $data);
		  print($data);
		  ?>
		  </diV>
		</div>
	</div>
	</div>
	</div>
	<br>
<?
require_once("footer.php");
?>