<html>
<header>
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="css/simple-sidebar.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
	<title>
	<?php
		$currentpage = basename($_SERVER['PHP_SELF']);
		require_once("pages.php");
		
		if(isset($pages[$currentpage])){
			print($pages[$currentpage] . " - BitWare");
		}else{
			print("Unknown page - BitWare");
		}
	?>
	</title>
	<style>
	.scroll {
		max-height: 385px;
		overflow: auto;
		overflow-x: scroll;
		white-space: nowrap;
	}
	.list-group-custom{
		max-height: 800px;
		margin-bottom: 10px;
		overflow-y:auto;
		-webkit-overflow-scrolling: touch;
	}
	.bg-arris{
		background-color:#5F8AB5;
	}
	</style>
</header>
<body>
  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">BitWare <? echo(file_get_contents("/etc/bwversion")); ?></div>
      <div class="list-group list-group-flush">
	  <!--
        <a href="#" class="list-group-item list-group-item-action bg-primary active">Status</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Logs</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">DHCP</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">BPI</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">CM Config</a>
		<a href="#" class="list-group-item list-group-item-action bg-light">MTA Config</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">SNMP</a>
		<a href="#" class="list-group-item list-group-item-action bg-light">NVRAM</a>
		<a href="#" class="list-group-item list-group-item-action bg-light">eRouter</a>
		-->
		<?php
			
			foreach($pages as $url => $pagename){
				if($url == $currentpage){
					print('<a href="'.$url.'" class="list-group-item list-group-item-action bg-arris active">'.$pagename.'</a>');
				}else{
					print('<a href="'.$url.'" class="list-group-item list-group-item-action bg-light">'.$pagename.'</a>');
				}
			}

		?>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="#"><b>CM State</b>: <? echo(file_get_contents("/proc/net/dbrctl/mode")); ?></a>
            </li>
           
          
          </ul>
        </div>
      </nav>
      <div class="container-fluid">
	  <br>
	  
	  <?php
		if(file_exists("/var/tmp/needreboot")){
			print('<div class="alert alert-warning" role="warning">You have made changes which require a modem reboot to apply.  <button class="btn btn-danger text-light" type="button" onclick="window.open(\'reboot.php\')">Reboot now</button></div>');
		}
	  ?>