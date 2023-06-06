#!/bin/sh

#Select configuration file
#if file exist in NVRAM choose it, else select default file
if [ -f /nvram/phison.cfg  ]; then
    CFG_FILE="/nvram/phison.cfg";
else
    CFG_FILE="/etc/mmc/PS8211/phison_fw/phison.cfg";
fi

echo "using $CFG_FILE"

#Parse configuration file
FILE_A=$(cat $CFG_FILE  | grep -v '^ *#' | grep 'man_file' | cut -f2 -d'=' | tr -d "\r\n")
FILE_B=$(cat $CFG_FILE  | grep -v '^ *#' | grep 'fw_file'  | cut -f2 -d'=' | tr -d "\r\n")
VERSION=$(cat $CFG_FILE | grep -v '^ *#' | grep 'version'  | cut -f2 -d'=' | tr -d "\r\n")

#read F/W version
FW_VERSION=$(phison PS8211 info | grep 'FW ver' | cut -f6 -d' ' | tr -d ',')
echo "Current version $FW_VERSION"

#check if first file is valid
echo "Start upgrade"
if ! phison PS8211 upgrade -man $FILE_A -fw $FILE_B
then
    echo "error: upgrade failed" >&2
    exit 1
fi

#read new F/W version
FW_VERSION=$(phison PS8211 info | grep 'FW ver' | cut -f6 -d' ' | tr -d ',')
echo "New version $FW_VERSION"
exit 0



