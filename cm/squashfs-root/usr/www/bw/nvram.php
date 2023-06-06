<?php
include_once("header.php");

$nvmeditor = "nvm";

$proddata = shell_exec($nvmeditor . " getinfo x 2>&1");

$lines = preg_split( '/\r\n|\r|\n/', $proddata);

$prodDB = array();

foreach($lines as $line){
	if(strpos($line, ':') !== false){
		$aaa = explode(":", $line);
		$prodDB[$aaa[0]] = trim($aaa[1]);
	}
}

function is_hex($hex_code) {
        return @preg_match("/^[a-f0-9]{2,}$/i", $hex_code) && !(strlen($hex_code) & 1);
}

function notify($type, $message){
	print('<div class="alert alert-'.$type.'" role="'.$type.'">');
	print($message . "<br></div>");
}

if(isset($_REQUEST['submit'])){
	if($_REQUEST['submit'] == "Update MAC Addresses"){
		if($_REQUEST['cmmac'] != $prodDB['CMMAC']){
			if(strlen($_REQUEST['cmmac']) != 12){
				notify("danger", "CM MAC invalid! Not 12 characters.");
			}else{
				if(!is_hex($_REQUEST['cmmac'])){
					notify("danger", "CM MAC invalid! Not hexadecimal.");
				}else{
					notify("primary", "CM MAC Updated");
					shell_exec($nvmeditor . " proddb setcmmac 0x" . $_REQUEST['cmmac']);
					touch("/var/tmp/needreboot");
				}		
			}
		}
		if($_REQUEST['lanmac'] != $prodDB['LANMAC']){
			if(strlen($_REQUEST['lanmac']) != 12){
				notify("danger", "LAN MAC invalid! Not 12 characters.");
			}else{
				if(!is_hex($_REQUEST['lanmac'])){
					notify("danger", "LAN MAC invalid! Not hexadecimal.");
				}else{
					notify("primary", "LAN MAC Updated");
					shell_exec($nvmeditor . " proddb setlanmac 0x" . $_REQUEST['lanmac']);
					touch("/var/tmp/needreboot");
				}		
			}
		}
		if($_REQUEST['l2swmac'] != $prodDB['L2SWMAC']){
			if(strlen($_REQUEST['l2swmac']) != 12){
				notify("danger", "L2SW MAC invalid! Not 12 characters.");
			}else{
				if(!is_hex($_REQUEST['l2swmac'])){
					notify("danger", "L2SW MAC invalid! Not hexadecimal.");
				}else{
					notify("primary", "L2SW MAC Updated");
					shell_exec($nvmeditor . " proddb setl2swmac 0x" . $_REQUEST['l2swmac']);
					touch("/var/tmp/needreboot");
				}		
			}
	    }
	}
	if($_REQUEST['submit'] == "Update MFG/Serial"){
		if($_REQUEST['mfg'] != $prodDB['MFG']){
			if(strlen($_REQUEST['mfg']) > 250){
				notify("danger", "MFG too long. Maximum of 250.");
			}else{
				notify("primary", "MFG Updated");
				shell_exec($nvmeditor . " proddb setmfg \"" . $_REQUEST['mfg'] . "\"");
				touch("/var/tmp/needreboot");
			}
		}
		if($_REQUEST['serial'] != $prodDB['Serial']){
			if(strlen($_REQUEST['serial']) != 12){
				notify("danger", "Invalid serial! Not 12 characters.");
			}else{
				notify("primary", "Serial Updated");
				shell_exec($nvmeditor . " proddb setserial " . $_REQUEST['serial']);
				touch("/var/tmp/needreboot");
			}
		}
	}
	if($_REQUEST['submit'] == "Update Filenames"){
		if($_REQUEST['sector0'] != $prodDB['Sector0']){
			if(strlen($_REQUEST['sector0']) > 64){
				notify("danger", "Image1 name too long. Maximum of 64.");
			}else{
				notify("primary", "Image1 name Updated");
				shell_exec($nvmeditor . " proddb setsectorname 0 " . $_REQUEST['sector0']);
				touch("/var/tmp/needreboot");
			}
		}
		if($_REQUEST['sector1'] != $prodDB['Sector1']){
			if(strlen($_REQUEST['sector1']) > 64){
				notify("danger", "Image2 name too long. Maximum of 64.");
			}else{
				notify("primary", "Image2 name Updated");
				shell_exec($nvmeditor . " proddb setsectorname 1 " . $_REQUEST['sector1']);
				touch("/var/tmp/needreboot");
			}
		}
	}
}


$proddata = shell_exec($nvmeditor . " getinfo x 2>&1");

$lines = preg_split( '/\r\n|\r|\n/', $proddata);

$prodDB = array();

foreach($lines as $line){
	if(strpos($line, ':') !== false){
		$aaa = explode(":", $line);
		$prodDB[$aaa[0]] = trim($aaa[1]);
	}
}
//print_r($prodDB);



?>

<div class="row">


<div class="col-sm-4">
	<div class="card">
		<div class="card-header text-light bg-primary">MAC Addresses</div>
		<div class="card-body">
		
		<form action="nvram.php" method="POST" enctype="multipart/form-data">
												
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">CM MAC</span>
						  </div>
							<input type="text" class="form-control" id="cmmac" name="cmmac" value="<?php print($prodDB['CMMAC']); ?>"></input>
						</div>
						<br>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">LAN MAC</span>
						  </div>
							<input type="text" class="form-control" id="lanmac" name="lanmac" value="<?php print($prodDB['LANMAC']); ?>"></input>
						</div>
						
						<br>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">L2SW MAC</span>
						  </div>
							<input type="text" class="form-control" id="l2swmac" name="l2swmac" value="<?php print($prodDB['L2SWMAC']); ?>"></input>
						</div>
						<br>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">MTA MAC</span>
						  </div>
							<input type="text" class="form-control" id="mtamac" name="mtamac" value="<?php print($prodDB['MTAMAC']); ?>" disabled></input>
						</div>
						
				<br>
			<input class="btn bg-arris text-light" name="submit" type="submit" value="Update MAC Addresses">
		</form>
		</div>
	</div>
</div>




<div class="col-sm-4">
	<div class="card">
		<div class="card-header text-light bg-primary">BPI MFG/Serial</div>
		<div class="card-body">
		
		<form action="nvram.php" method="POST" enctype="multipart/form-data">
												
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">MFG Name</span>
						  </div>
							<input type="text" class="form-control" id="mfg" name="mfg" value="<?php print($prodDB['MFG']); ?>"></input>
						</div>
						<br>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">Serial Number</span>
						  </div>
							<input type="text" class="form-control" id="serial" name="serial" value="<?php print($prodDB['Serial']); ?>"></input>
						</div>
						
				<br>
			<input class="btn bg-arris text-light" name="submit" type="submit" value="Update MFG/Serial">
		</form>
		</div>
	</div>
</div>


<div class="col-sm-4">
	<div class="card">
		<div class="card-header text-light bg-primary">Filenames</div>
		<div class="card-body">
		
		<form action="nvram.php" method="POST" enctype="multipart/form-data">
												
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">Image 1</span>
						  </div>
							<input type="text" class="form-control" id="sector0" name="sector0" value="<?php print($prodDB['Sector0']); ?>"></input>
						</div>
						<br>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">Image 2</span>
						  </div>
							<input type="text" class="form-control" id="sector1" name="sector1" value="<?php print($prodDB['Sector1']); ?>"></input>
						</div>
						
				<br>
			<input class="btn bg-arris text-light" name="submit" type="submit" value="Update Filenames">
		</form>
		</div>
	</div>
</div>


</div>

<?php
include_once("footer.php");
?>
