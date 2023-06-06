#!/bin/sh

if test ! -f /lib/modules/2.6.39.3/kernel/drivers/net/cat_l2switch_netdev/cat_l2switch_netdev.ko
then
   echo "L2 Switch driver kernel module installation failed - cat_l2switch_netdev.ko not found !!!"
   exit 1
fi

if test ! -f /lib/modules/2.6.39.3/drivers/net/l2switch_proxy_driver.ko
then
   echo "L2 Switch driver kernel module installation failed - l2switch_proxy_driver.ko not found !!!"
   exit 1
fi
	
echo "Installing L2 Switch drivers..."
#
#   This script assumes that the getenv utility is available
#   meaning the bootparams module has been initialized.
#
l2sw_mac=`getenv l2switch_internal_mac_address`
echo "L2switch internal MAC: $l2sw_mac"

insmod /lib/modules/2.6.39.3/kernel/drivers/net/cat_l2switch_netdev/cat_l2switch_netdev.ko inpmac=$l2sw_mac
if test $? -gt 0
then
	echo "Error inserting cat_l2switch_netdev.ko"
	exit 1
fi
   
insmod /lib/modules/2.6.39.3/drivers/net/l2switch_proxy_driver.ko
if test $? -gt 0
then
	echo "Error inserting l2switch_proxy_driver.ko"
    exit 1
fi
   
exit 0
