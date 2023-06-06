#! /bin/sh

SETTINGS_FILE="/nvram/mmc_settings.cfg"
DEFAULT_SETTINGS_FILE="/etc/mmc/mmc_settings_default.cfg"
EMMC_TYPE_FILE="/nvram/emmc_type.txt"

#if /nvram/mmc_settings.cfg - do nothing and exit.
if [ -f $SETTINGS_FILE ]; then
    #echo "$SETTINGS_FILE exist."
    exit 0
fi

#if /nvram/emmc_type.txt not exit  - do nothing and exit.
if [ ! -f $EMMC_TYPE_FILE ]; then
    #echo "$EMMC_TYPE_FILE NOT exist."
    exit 0
fi

#read type from /nvram/emmc_type.txt
TYPE=$(cat $EMMC_TYPE_FILE)

#translate old "TYPE" to new "TYPE"
# "phison" => "PS7000"
# "incomm" => "369DB"
# else - do not translate, leave it "as is"
if [ $TYPE == "phison" ]; then
    TYPE="PS7000"
else
if [ $TYPE == "incomm" ]; then
    TYPE="369DB"
fi
fi

#Read F/W controller version 
VERSION=$(/etc/mmc/$TYPE/read_mmc_fw_version.sh)
if [ -z $VERSION ]
then
echo "Error"
exit 1
fi

#create the new settings file
cat $DEFAULT_SETTINGS_FILE | while read line 
do
    #grep all line that are not 'comment' (start with '#'), and all line that are not 'empty line'
    echo $line | grep -v '^ *#' | grep -v -e ^$ 1>/dev/null  
    if [ `echo $?` -eq 0 ]
    then
        # grep the line that start with "controller_type" and replace it with new one
        echo $line | grep '^ *controller_type'  1>/dev/null  
        if [ `echo $?` -eq 0 ]
        then
            #create new line
            echo "controller_type=$TYPE" >> $SETTINGS_FILE
        else

        # grep the line that start with "version" and replace it with new one
        echo $line | grep '^ *version'  1>/dev/null  
        if [ `echo $?` -eq 0 ]
        then
            #create new line
            echo "version=$VERSION" >> $SETTINGS_FILE
        else
            #copy line "as is" to output file
            echo $line >> $SETTINGS_FILE
        fi
        fi
    else 
        #copy "comment" line "as is" to output file
        echo $line >> $SETTINGS_FILE
    fi
done

echo "Ctreate new mmc settings file: Type=$TYPE, F/W version=$VERSION."
exit 0






