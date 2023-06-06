<?php
require_once("header.php");
?>

<?php
if(isset($_POST['submit'])){
	print('<div class="alert alert-primary" role="primary">');
	print("Uploading certificates...<br>");
	foreach($_FILES as $key => $file){
		switch($key){
			case "cmcert":
				if($file['error'] == 0){
					print("Installing CM Cert...<br>");
					$location = "/nvram/1/security/cm_cert.cer";
					unlink($location);
					move_uploaded_file($file["tmp_name"], $location);
					touch("/var/tmp/needreboot");
				}
				break;
			case "cmkey":
				if($file['error'] == 0){
					print("Installing CM Key...<br>");
					$location = "/nvram/1/security/cm_key_prv.bin";
					unlink($location);
					move_uploaded_file($file["tmp_name"], $location);
					touch("/var/tmp/needreboot");
				}
				break;
			case "mfgcert":
				if($file['error'] == 0){
					print("Installing MFG Cert...<br>");
					$location = "/nvram/1/security/mfg_cert.cer";
					unlink($location);
					move_uploaded_file($file["tmp_name"], $location);
					touch("/var/tmp/needreboot");
				}
				break;
			case "mfgkey":
				if($file['error'] == 0){
					print("Installing MFG Key...<br>");
					$location = "/nvram/1/security/mfg_key_pub.bin";
					unlink($location);
					move_uploaded_file($file["tmp_name"], $location);
					touch("/var/tmp/needreboot");
				}
				break;
			case "rootkey":
				if($file['error'] == 0){
					print("Installing Root Key...<br>");
					$location = "/nvram/1/security/root_pub_key.bin";
					unlink($location);
					move_uploaded_file($file["tmp_name"], $location);
					touch("/var/tmp/needreboot");
				}
				break;
				
				
			case "mtacert":
				if($file['error'] == 0){
					print("Installing MTA Cert...<br>");
					$location = "/nvram/2/certificates/mtacert.cer";
					unlink($location);
					move_uploaded_file($file["tmp_name"], $location);
					touch("/var/tmp/needreboot");
				}
				break;
			case "mtakey":
				if($file['error'] == 0){
					print("Installing MTA Key...<br>");
					$location = "/nvram/2/certificates/mtakey.bin";
					unlink($location);
					move_uploaded_file($file["tmp_name"], $location);
					touch("/var/tmp/needreboot");
				}
				break;
			case "mtamfgcert":
				if($file['error'] == 0){
					print("Installing MTA MFG Cert...<br>");
					$location = "/nvram/2/certificates/manuf.cer";
					unlink($location);
					move_uploaded_file($file["tmp_name"], $location);
					touch("/var/tmp/needreboot");
				}
				break;
			case "mtaroot":
				if($file['error'] == 0){
					print("Installing Root Cert...<br>");
					$location = "/nvram/2/certificates/iptel_root.cer";
					unlink($location);
					move_uploaded_file($file["tmp_name"], $location);
					touch("/var/tmp/needreboot");
				}
				break;
		}
	}
	print('</div>');

}

?>

  <div class="row">
    <div class="col-sm-6">
		<div class="card">
		  <div class="card-header bg-primary text-light">Cable Modem Certificates</div>
		  <div class="card-body">
		  
			<div class="row">
				<div class="col-sm-12">
					
					<form action="bpi.php" method="POST" enctype="multipart/form-data">
												
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">Upload CM Cert</span>
						  </div>
						 
						   <div class="custom-file">
							<input type="file" class="custom-file-input" id="cmcert" name="cmcert">
							<label class="custom-file-label text-truncate" for="cmcert">Choose file</label>
						  </div>
						  <div class="input-group-append">
							<button class="btn bg-arris text-light" type="button" onclick="window.open('bpidl.php?file=0')">Download</button>
						  </div>
						</div>
						<br>
						
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">Upload CM Private Key</span>
						  </div>
						   <div class="custom-file">
							<input  type="file" class="custom-file-input" id="cmkey" name="cmkey">
							<label class="custom-file-label text-truncate" for="cmkey">Choose file</label>
						  </div>
						  <div class="input-group-append">
							<button class="btn bg-arris text-light" type="button" onclick="window.open('bpidl.php?file=1')">Download</button>
						  </div>
						</div>
						<br>
						
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">Upload MFG Certificate</span>
						  </div>
						   <div class="custom-file">
							<input  type="file" class="custom-file-input" id="mfgcert" name="mfgcert">
							<label class="custom-file-label text-truncate" for="mfgcert">Choose file</label>
						  </div>
						  <div class="input-group-append">
							<button class="btn bg-arris text-light" type="button" onclick="window.open('bpidl.php?file=2')">Download</button>
						  </div>
						</div>
						<br>
						
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">Upload MFG Public Key</span>
						  </div>
						   <div class="custom-file">
							<input  type="file" class="custom-file-input" id="mfgkey" name="mfgkey">
							<label class="custom-file-label text-truncate" for="mfgkey">Choose file</label>
						  </div>
						  <div class="input-group-append">
							<button class="btn bg-arris text-light" type="button" onclick="window.open('bpidl.php?file=3')">Download</button>
						  </div>
						</div>
						<br>
						
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">Upload Root Public Key</span>
						  </div>
						   <div class="custom-file">
							<input  type="file" class="custom-file-input" id="rootkey" name="rootkey">
							<label class="custom-file-label text-truncate" for="rootkey">Choose file</label>
						  </div>
						  <div class="input-group-append">
							<button class="btn bg-arris text-light" type="button" onclick="window.open('bpidl.php?file=4')">Download</button>
						  </div>
						</div>
						<br>
					
						<input class="btn bg-arris text-light" name="submit" type="submit" value="Upload CM Certificates">
					</form>
					
				</div>
			</div>
				 
		  </div>
		</div>
    </div>
  
    <div class="col-sm-6">
		<div class="card">
		  <div class="card-header bg-primary text-light">Telephony/MTA Certificates</div>
		  <div class="card-body">
		  <div class="row">
				<div class="col-sm-12">
					
					<form action="bpi.php" method="POST" enctype="multipart/form-data">
												
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">Upload MTA Cert</span>
						  </div>
						 
						   <div class="custom-file">
							<input type="file" class="custom-file-input" id="mtacert" name="mtacert">
							<label class="custom-file-label text-truncate" for="mtacert">Choose file</label>
						  </div>
						  <div class="input-group-append">
							<button class="btn bg-arris text-light" type="button" onclick="window.open('mtadl.php?file=0')">Download</button>
						  </div>
						</div>
						<br>
						
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">Upload MTA Private Key</span>
						  </div>
						   <div class="custom-file">
							<input  type="file" class="custom-file-input" id="mtakey" name="mtakey">
							<label class="custom-file-label text-truncate" for="mtakey">Choose file</label>
						  </div>
						  <div class="input-group-append">
							<button class="btn bg-arris text-light" type="button" onclick="window.open('mtadl.php?file=1')">Download</button>
						  </div>
						</div>
						<br>
						
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">Upload MTA MFG Certificate</span>
						  </div>
						   <div class="custom-file">
							<input  type="file" class="custom-file-input" id="mtamfgcert" name="mtamfgcert">
							<label class="custom-file-label text-truncate" for="mtamfgcert">Choose file</label>
						  </div>
						  <div class="input-group-append">
							<button class="btn bg-arris text-light" type="button" onclick="window.open('mtadl.php?file=2')">Download</button>
						  </div>
						</div>
						<br>
						
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">Upload MTA Root Certificate</span>
						  </div>
						   <div class="custom-file">
							<input  type="file" class="custom-file-input" id="mtaroot" name="mtaroot">
							<label class="custom-file-label text-truncate" for="mtaroot">Choose file</label>
						  </div>
						  <div class="input-group-append">
							<button class="btn bg-arris text-light" type="button" onclick="window.open('mtadl.php?file=3')">Download</button>
						  </div>
						</div>
						<br>
					
						<input class="btn bg-arris text-light" name="submit" type="submit" value="Upload MTA Certificates">
					</form>
					
				</div>
			</div>
				 
		  </div>
		  </div>
		</div>
    </div>
  </div>
<?
require_once("footer.php");
?>