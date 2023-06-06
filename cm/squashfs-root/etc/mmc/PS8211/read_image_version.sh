#!/bin/sh

#Select configuration file
#if file exist in NVRAM choose it, else select default file
if [ -f /nvram/phison.cfg  ]; then
    CFG_FILE="/nvram/phison.cfg";
else
    CFG_FILE="/etc/mmc/PS8211/phison_fw/phison.cfg";
fi

#echo "using $CFG_FILE"

#Parse configuration file
FILE_A=$(cat $CFG_FILE  | grep -v '^ *#' | grep 'man_file' | cut -f2 -d'=' | tr -d "\r\n")
FILE_B=$(cat $CFG_FILE  | grep -v '^ *#'| grep 'fw_file'   | cut -f2 -d'=' | tr -d "\r\n")
VERSION=$(cat $CFG_FILE | grep -v '^ *#' | grep 'version'  | cut -f2 -d'=' | tr -d "\r\n")

#check if first file is valid
if ! phison PS8211 check -man $FILE_A &> /dev/null
then
    echo "Failed: file '$FILE_A' is not valid manufacturer file" >&2
    exit 1
fi

#check if second file is valid
if ! phison PS8211 check -fw $FILE_B &> /dev/null
then
    echo "Failed: file '$FILE_B' is not valid F/W file" >&2
    exit 1
fi

#print F/W version to standard output
echo $VERSION
exit 0

