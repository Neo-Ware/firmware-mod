<?php
require_once("header.php");
function getSystemMemInfo() 
{       
    $data = explode("\n", file_get_contents("/proc/meminfo"));
    $meminfo = array();
    foreach ($data as $line) {
        list($key, $val) = explode(":", $line);
        $meminfo[$key] = trim($val);
    }
	array_pop($meminfo);
    return $meminfo;
}

?>
<div class="row">
    <div class="col-sm-12">
		<div class="card">
		<div class="card-header text-light bg-primary">Uname</div>
		  <div class="card-body">
		  <?php echo(php_uname()); ?>
		
		  </div>
		</div>
	</div>
</div>
<br>
<div class="row">
	
	<div class="col-sm-3">
		<div class="card">
		<div class="card-header text-light bg-primary">DOCSIS Registration</div>
		  <div class="card-body">
		  <?php 
		 function getStringBetween($str,$from,$to)
			{
				$sub = substr($str, strpos($str,$from)+strlen($from),strlen($str));
				return substr($sub,0,strpos($sub,$to));
			}
		  $cmdout = shell_exec("/usr/www/cgi-bin/cm_state_cgi");
		  //print($cmdout);
		  $cmdout = str_replace('width="770"', 'class="table"', $cmdout);
		  $cmdout = str_replace('width="490"', '', $cmdout);
		  $cmdout = str_replace('width="500"', '', $cmdout);
		  $cmdout = str_replace('width="270"', '', $cmdout);
		  $cmdout = str_replace('border="1"', '', $cmdout);
		  $cmdout = str_replace(':</b>', ': </b>', $cmdout);
		  
		  
		  $cmdout = str_replace('class="table"', 'class="table table-hover table-striped"', $cmdout);

		  print(getStringBetween($cmdout, "<!-- INSERT ARRIS PAGE CONTENT HERE -->", "<!-- END ARRIS PAGE CONTENT -->"));
		  
		  
		  ?>
		  
		  </div>
		</div>
	</div>
	<div class="col-sm-7">
		<div class="card">
		<div class="card-header text-light bg-primary">DOCSIS Channels</div>
		  <div class="card-body">
		  <?php 
		
		  $cmdout = shell_exec("/usr/www/cgi-bin/status_cgi");
		  //print($cmdout);
		  
		  $cmdout = str_replace('width="770"', 'class="table"', $cmdout);
		  $cmdout = str_replace('width="490"', ' ', $cmdout);
		  $cmdout = str_replace('border="2" cellpadding="0" cellspacing="0"', ' ', $cmdout);
		  $cmdout = str_replace('border="2" width="769"', ' ', $cmdout);
		  $cmdout = str_replace('<table bgcolor="#0c055c" cellpadding="0" cellspacing="0" cols="1" class="table">
<tbody>
<tr>
  <td class="table"><b><font color="#ffffff" size="+1">&nbsp;RF Parameters</font></b></td>
</tr>
</tbody></table>', ' ', $cmdout);
		  $cmdout = str_replace('<table class="table" border="0"><tr><td align="right">
<form name="clear" action="status_cgi" method=post>
    <a href="javascript: clearcounters()">Reset FEC Counters</a>
</form>
</td></tr></table>', ' ', $cmdout);


			$cmdout = str_replace('<table bgcolor="#0c055c" cellpadding="0" cellspacing="0" cols="1" class="table"><tbody><tr>

      <td class="table"><b><font color="#ffffff"size="+1">
&nbsp;Status
</font></b></td></tr></tbody></table>', '<h4> Status </h4>', $cmdout);

		$cmdout = str_replace('cellpadding="0" cellspacing="0"', 'class="table"', $cmdout);
		$cmdout = str_replace('width="160"', ' ', $cmdout);
		$cmdout = str_replace('width="100"', ' ', $cmdout);
		$cmdout = str_replace('width="90"', ' ', $cmdout);
		$cmdout = str_replace('width="60"', ' ', $cmdout);
		$cmdout = str_replace('width="144"', ' ', $cmdout);
		  
		  
		  
		   $cmdout = str_replace('<table bgcolor="#0c055c" class="table" cols="1" class="table"><tbody><tr>
    <td class="table"><b><font color="#ffffff" size="+1">
    &nbsp;Interface Parameters </font></b></td></tr></tbody></table>', '<h4> Interfaces </h4>', $cmdout);
	
		$cmdout = str_replace('<table  >', '<table class="table">', $cmdout);
		
		  $cmdout = str_replace('class="table"', 'class="table table-hover table-striped"', $cmdout);

		  print(getStringBetween($cmdout, "<!-- INSERT ARRIS PAGE CONTENT HERE -->", "<!-- END ARRIS PAGE CONTENT -->"));
		  
		  
		  ?>
		  
		  </div>
		</div>
	</div>
	<div class="col-sm-2">
		<div class="card">
		<div class="card-header text-light bg-primary">Processes</div>
		  <div class="card-body">
		  <b>Total processes:</b> <?php $stats = stat("/proc"); echo($stats[3]); ?><br>
		  </div>
		</div>
		<br>
		<div class="card">
		<div class="card-header text-light bg-primary">Memory Usage</div>
		  <div class="card-body">
		  <ul class="list-group list-group-custom">
		  <?php 
		  $meminfo = getSystemMemInfo();
			foreach($meminfo as $key => $value){
				print('<li class="list-group-item"><b>'.$key.'</b>: '.$value.'</li>');
			}
		  ?>
		  </ul>
		  </div>
		</div>
	</div>
</div>
<br>
<div class="row">
	<div class="col-sm-4">
		
	</div>
	
</div>
<?
require_once("footer.php");
?>