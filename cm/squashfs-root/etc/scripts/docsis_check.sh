#! /bin/sh
#

if test -f /usr/sbin/nvread
then
    enable_docsis=`nvread 0.0.3 long`
    if [ "$enable_docsis" != "0" ]; 
    then 
        cd /var
        # Remove any link to docsis.pcd
        rm -f docsis.pcd
        # Enable DOCSIS 
        ln -sf /etc/scripts/docsis_active.pcd docsis.pcd

        # Add DOCSIS CLI plugin
        if [ -e /lib/libdocsis_cli_plugin.so ] ; then
        echo "/lib/libdocsis_cli_plugin.so" >> /var/cli_plugins.conf
        fi

        # Add DOCSIS Logger plugin
        if [ -e /lib/libdocsis_logger_plugin.so ] ; then
        echo "/lib/libdocsis_logger_plugin.so" >> /var/logger_plugins.conf
        fi
    fi
fi


