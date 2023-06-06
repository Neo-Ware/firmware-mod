#! /bin/sh

SETTINGS_FILE="/nvram/mmc_settings.cfg"
TEMP_SETTINGS_FILE="/var/tmp/mmc_settings.cfg"

#if /nvram/mmc_settings.cfg - do nothing and exit.
if [ ! -f $SETTINGS_FILE ]; then
    echo "eMMC F/W Auto-Upgrade: $SETTINGS_FILE not exist."
    exit 1
fi


AUTO_UPDATE=$(cat $SETTINGS_FILE  | grep -v '^ *#' | grep -v -e ^$ | grep "auto_update"     | cut -d '=' -f 2)
CTRL_TYPE=$(cat $SETTINGS_FILE    | grep -v '^ *#' | grep -v -e ^$ | grep "controller_type" | cut -d '=' -f 2)
FW_VERSION=$(cat $SETTINGS_FILE   | grep -v '^ *#' | grep -v -e ^$ | grep "version"         | cut -d '=' -f 2)

if [ $AUTO_UPDATE != "enable" ]
then
    echo "eMMC F/W Auto-Update: disabled."
    exit 0
fi

IMG_VERSION=$(/etc/mmc/$CTRL_TYPE/read_image_version.sh)
if [ $? != 0 ]
then
    echo "Error: failed to read image version"
    exit 1
fi

if [ -z $IMG_VERSION ]
then
    echo "Error: failed to read image version"
    exit 1
fi

if [ $FW_VERSION == $IMG_VERSION ]
then
    echo "eMMC F/W Auto-Uprade: not needed."
    exit 0
fi

#Read Real F/W controller version 
FW_VERSION=$(/etc/mmc/$CTRL_TYPE/read_mmc_fw_version.sh)
if [ $FW_VERSION == $IMG_VERSION ]
then
    echo "eMMC F/W Auto-Uprade: not needed."
    echo "eMMC F/W Auto-Uprade: Warning: /nvram/mmc_settings.cfg file is not up-to-date with real F/W version."
    exit 0
fi

echo "eMMC F/W Auto-Upgrade: Starting"
/etc/mmc/$CTRL_TYPE/upgrade_mmc_fw.sh
if [ $? != 0 ]
then
    echo "eMMC F/W Auto-Upgrade: Failed"
    #disable auto-upgrade
    #Update new 'Disable' to temporary settings file
    cat $SETTINGS_FILE | while read line 
    do
        #grep all line that start with 'version'
        echo $line | grep '^ *auto_update' 1>/dev/null  
        if [ `echo $?` -eq 0 ]
        then
            echo "auto_update=disable" >> $TEMP_SETTINGS_FILE
        else 
            #copy the line "as is" to output file
            echo $line >> $TEMP_SETTINGS_FILE
        fi
    done
    #copy the temporary file to nvram
    cp $TEMP_SETTINGS_FILE $SETTINGS_FILE
    rm $TEMP_SETTINGS_FILE
    echo "eMMC F/W Auto-Upgrade: Disabled"
    exit 1
fi
echo "eMMC F/W Auto-Upgrade: Done"

#Read Real F/W controller version 
FW_VERSION=$(/etc/mmc/$CTRL_TYPE/read_mmc_fw_version.sh)

#Update new F/W to temporary settings file
cat $SETTINGS_FILE | while read line 
do
    #grep all line that start with 'version'
    echo $line | grep '^ *version' 1>/dev/null  
    if [ `echo $?` -eq 0 ]
    then
        echo "version=$FW_VERSION" >> $TEMP_SETTINGS_FILE
    else 
        #copy the line "as is" to output file
        echo $line >> $TEMP_SETTINGS_FILE
    fi
done

#copy the temporary file to nvram
cp $TEMP_SETTINGS_FILE $SETTINGS_FILE
rm $TEMP_SETTINGS_FILE

echo "eMMC F/W Auto-Upgrade: reboot."
reboot



