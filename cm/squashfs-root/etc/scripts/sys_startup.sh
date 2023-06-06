#! /bin/sh
#
# ARRIS MOD Start

if test -f /usr/sbin/nvread
then
    product_type=`nvread 6.1.12 long`
    voice=$(($product_type & 0x0f))    
    if [ "$voice" -ne 0 ]; then        
        if test -f /etc/scripts/voice.pcd
        then
                voice=1             
                echo  "Starting the voice PCD files" 
        else
                voice=0 
                echo  "ERROR : THIS PRODUCT supports voice but it's missing voice related files"
                echo  "ERROR : Starting the non voice PCD" 
        fi
    fi
else
    if test -f /etc/scripts/voice.pcd
    then           
          voice=1
          echo  "ERROR : There is no nvread binary"
          echo  "ERROR : Starting the default voice PCD" 
    else
          voice=0
          echo  "ERROR : There is no nvread file"
          echo  "EEROR : Starting the default non voice PCD"           
    fi
fi


if [ "$voice" -eq 0 ]; then   
    
    # Start up DOCSIS
    echo "starting dsdk"
    runall $1
else
    # Start up DOCSIS
    echo "starting vsdk"
    /usr/sbin/runall -A 0 -m $1
    
    # Start up Voice Setup
    source /etc/scripts/voice_setup.sh
    
    # Start up PACM
    source /etc/scripts/pacm_setup.sh
fi
# ARRIS MOD End


