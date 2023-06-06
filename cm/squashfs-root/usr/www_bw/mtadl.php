<?php
$requestedcert = (int)$_GET['file'];

switch($requestedcert){
	case 0:
		$file = "mtacert.cer";
		break;
	case 1:
		$file = "mtakey.bin";
		break;
	case 2:
		$file = "manuf.cer";
		break;
	case 3:
		$file = "iptel_root.cer";
		break;
	default:
		die("Invalid file");
}


$file = "/nvram/2/certificates/" . $file;
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