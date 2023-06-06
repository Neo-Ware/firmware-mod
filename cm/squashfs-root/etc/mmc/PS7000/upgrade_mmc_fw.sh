#!/bin/sh

#Select configuration file
#if file exist in NVRAM choose it, else select default file
if [ -f /nvram/phison.cfg  ]; then
    CFG_FILE="/nvram/phison.cfg";
else
    CFG_FILE="/etc/mmc/PS7000/phison_fw/phison.cfg";
fi

echo "using $CFG_FILE"

#Parse configuration file
FILE_A=$(cat $CFG_FILE  | grep -v '^ *#' | grep 'man_file' | cut -f2 -d'=' | tr -d "\r\n")
FILE_B=$(cat $CFG_FILE  | grep -v '^ *#' | grep 'fw_file'  | cut -f2 -d'=' | tr -d "\r\n")
VERSION=$(cat $CFG_FILE | grep -v '^ *#' | grep 'version'  | cut -f2 -d'=' | tr -d "\r\n")

#check image version 
if [ $VERSION = "6.12_V31" ]
then
    echo "error: illigal to upgrade to version $VERSION !" >&2
    exit 1
fi

#read F/W version
FW_VERSION=$(phison PS7000 info | grep 'FW ver' | cut -f6 -d' ' | tr -d ',')
echo "Current version $FW_VERSION"

#check f/w version 
if [ $FW_VERSION = "6.12_V31" ]
then
    echo "error: version $FW_VERSION is not upgradable !" >&2
    exit 1
fi

#check if first file is valid
echo "Start upgrade"
if ! phison PS7000 upgrade -man $FILE_A -fw $FILE_B
then
    echo "error: upgrade failed" >&2
    exit 1
fi

#read new F/W version
FW_VERSION=$(phison PS7000 info | grep 'FW ver' | cut -f6 -d' ' | tr -d ',')
echo "New version $FW_VERSION"
exit 0



