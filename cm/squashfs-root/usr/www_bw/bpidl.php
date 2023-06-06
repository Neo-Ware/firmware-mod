<?php
$requestedcert = (int)$_GET['file'];

switch($requestedcert){
	case 0:
		$file = "cm_cert.cer";
		break;
	case 1:
		$file = "cm_key_prv.bin";
		break;
	case 2:
		$file = "mfg_cert.cer";
		break;
	case 3:
		$file = "mfg_key_pub.bin";
		break;
	case 4:
		$file = "root_pub_key.bin";
		break;
	default:
		die("Invalid file");
}


$file = "/nvram/1/security/" . $file;
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
?>