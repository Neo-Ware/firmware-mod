<?php
require_once("header.php");

if(isset($_POST['submit'])){
	if(isset($_FILES)){
		if(isset($_FILES['config'])){
			$location = "/nvram/1/config.cm";
			print('<div class="alert alert-primary" role="primary">Successfully installed force config.</div>');
			unlink($location);
			move_uploaded_file($_FILES['config']["tmp_name"], $location);
			touch("/var/tmp/needreboot");
		}
	}
	if($_POST['submit'] == "Download Installed Config"){
		$file = "/nvram/1/config.cm";
		if (file_exists($file)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'.basename($file).'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			readfile($file);
			exit;
		}else{
			print("<script>window.close()</script>");
		}
	}
	if($_POST['submit'] == "Delete Installed Config"){
		unlink("/nvram/1/config.cm");
		print('<div class="alert alert-primary" role="primary">Successfully uninstalled force config.</div>');
		touch("/var/tmp/needreboot");
	}
}
?>


<div class="row">

	<div class="col-sm-5">
		<div class="card">
			<div class="card-header bg-primary text-light">Cable Modem Config</div>
			<div class="card-body">
			
			<h4>Force config status:</h4><?php
			if(file_exists("/nvram/1/config.cm")){
				print('<b>Currently installed.</b><br><br>
				<form action="forceconfig.php" method="POST" enctype="multipart/form-data">
				<input class="btn bg-arris text-light" name="submit" type="submit" value="Download Installed Config">
				</form>
				<form action="forceconfig.php" method="POST" enctype="multipart/form-data">
				<input class="btn bg-arris text-light" name="submit" type="submit" value="Delete Installed Config">
				</form>
				');
			}else{
				print("Not in use.<br>");
			}
			//
			?>
			<hr>
			<form action="forceconfig.php" method="POST" enctype="multipart/form-data">
			<div class="input-group">
			  <div class="input-group-prepend">
				<span class="input-group-text">Upload Config File</span>
			  </div>
				 
			   <div class="custom-file">
				<input type="file" class="custom-file-input" id="config" name="config">
				<label class="custom-file-label text-truncate" for="config">Choose file</label>
			  </div>
			  
			  

			</div><br>
			<input class="btn bg-arris text-light" name="submit" type="submit" value="Upload Config">
			</form>
			<?php
			//Current config file name:<br>
			//Current config file options:<br>
			
				//$test = snmpget("127.0.0.1", "public", "1.3.6.1.2.1.69.1.4.5.0");
				//print_r($test);
				//if(file_exists("/nvram/1/config.cm"){
				//	
				//}else{
				//	print("N/A");
				//}
			
			//Download current config file:<br>
			
			
			
			?>
			</div>
		</div>
		

	<br>
		<div class="card">
			<div class="card-header bg-primary text-light">MTA Config</div>
			<div class="card-body">
			
			<h4>Force config status:</h4><?php
			if(file_exists("/nvram/1/config.mta")){
				print('<b>Currently installed.</b><br><br>
				<form action="forceconfig.php" method="POST" enctype="multipart/form-data">
				<input class="btn bg-arris text-light" name="submit" type="submit" value="Download Installed Config">
				</form>
				<form action="forceconfig.php" method="POST" enctype="multipart/form-data">
				<input class="btn bg-arris text-light" name="submit" type="submit" value="Delete Installed Config">
				</form>
				');
			}else{
				print("Not in use.<br>");
			}
			//
			?>
			<hr>
			Not yet implemented.
			<!--<form action="forceconfig.php" method="POST" enctype="multipart/form-data">
			<div class="input-group">
			  <div class="input-group-prepend">
				<span class="input-group-text">Upload Config File</span>
			  </div>
				 
			   <div class="custom-file">
				<input type="file" class="custom-file-input" id="config" name="config">
				<label class="custom-file-label text-truncate" for="config">Choose file</label>
			  </div>
			  
			  

			</div><br>
			<input class="btn bg-arris text-light" name="submit" type="submit" value="Upload Config">
			</form>-->
			<?php
			//Current config file name:<br>
			//Current config file options:<br>
			
				//$test = snmpget("127.0.0.1", "public", "1.3.6.1.2.1.69.1.4.5.0");
				//print_r($test);
				//if(file_exists("/nvram/1/config.cm"){
				//	
				//}else{
				//	print("N/A");
				//}
			
			//Download current config file:<br>
			
			
			
			?>
			</div>
</div>
	</div>
<div class="col-sm-7">
		<div class="card">
			<div class="card-header bg-primary text-light">Config Viewer (Installed Config)</div>
			<div class="card-body">
			<?php
			function contains($needle, $haystack)
			{
				return strpos($haystack, $needle) !== false;
			}
			if(file_exists("/nvram/1/config.cm")){
				$data = shell_exec("docsis_config_to_text /nvram/1/config.cm");
				$data_lines = explode("\n", $data);
				$isInPanel = false;
				
				foreach($data_lines as $line){
					if(contains("Parsing",$line)){
						continue;
					}
					if(contains("###",$line)){
						continue;
					}
					if(contains("=", $line)){
						if(!$isInPanel){
							$isInPanel = true;
							print('
							 <div class="card">
							 <div class="card-body">'.$line.'
							');
							
						}else{
							
						print('' . $line . "<br>");	
						}
						
					}else{
						if(strlen($line) > 1){
						if($isInPanel){
							print('
							</div>
							</div>
							');
							//end last panel
						}
						//start panel
						$isInPanel = true;
						print('
							 <div class="card">
							 <div class="card-header">'.$line.'</div>
							 <div class="card-body">');
						}
					}
				}
				print('
				</div>
				</div>
				');
			}else{
				print("No installed config.");
			}
			?>
			</div>
		</div>
		</div>
</div>




<?
require_once("footer.php");
?>