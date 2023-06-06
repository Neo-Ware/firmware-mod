<?php

$partitionNum = $_REQUEST['p'];

switch($partitionNum){
	case "1":
		$file = "/dev/mmcblk0p1"; //Image1 CM Kernel+BootScript
		$name = "1_cmbootkernel";
		break;
	case "2":
		$file = "/dev/mmcblk0p2"; //Image2 CM Kernel+BootScript
		$name = "2_cmbootkernel";
		break;
	case "3":
		$file = "/dev/mmcblk0p3"; //CM NVRAM
		$name = "cmnvram";
		break;	
	case "4":
		$file = "/dev/mmcblk0p5"; //Image1 CM Rootfs
		$name = "1_cmrootfs";
		break;		
	case "5":
		$file = "/dev/mmcblk0p6"; //Image2 CM Rootfs
		$name = "2_cmrootfs";
		break;	
	case "6":
		$file = "/dev/mmcblk0p7"; //Image1 GW Rootfs
		$name = "1_gwrootfs";
		break;	
	case "7":
		$file = "/dev/mmcblk0p8"; //Image2 GW Rootfs
		$name = "2_gwrootfs";
		break;	
	case "8":
		$file = "/dev/mmcblk0p9"; //Image1 Atom Kernel
		$name = "1_atomkernel";
		break;	
	case "9":
		$file = "/dev/mmcblk0p10"; //Image2 Atom Kernel
		$name = "2_atomkernel";
		break;	
	case "10":
		$file = "/dev/mmcblk0p11"; //Atom NVRAM
		$name = "atomnvram";
		break;	
	case "11":
		$file = "/dev/mmcblk0p12"; //Image1 Atom Rootfs
		$name = "1_atomrootfs";
		break;	
	case "12":
		$file = "/dev/mmcblk0p13"; //Image2 Atom Rootfs
		$name = "2_atomrootfs";
		break;
	default:
		die("Invalid partition");
		break;
}

//$file = "/var/tmp/cmrootfs.sqfs";
shell_exec("dd if=".$file." of=/var/tmp/".$name.".img");

$file = "/var/tmp/".$name.".img";

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
	unlink($file);
    exit;
}

?>