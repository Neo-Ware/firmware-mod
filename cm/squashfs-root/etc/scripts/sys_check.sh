# !/bin/sh
if [ -f /usr/sbin/nvread ]; then
	enable_startup=`nvread 0.0.2 long`  
	startup_file=`nvread 0.0.1 str`
	
	if [ -z $enable_startup ] || [[ $startup_file != /etc/scripts/sys_startup.sh ]]; then \
		echo "Warning: system startup is not initialized, applying default values." ;\
		if test -f /usr/sbin/setstartup ;\
                then \
	       	    /usr/sbin/setstartup --default ;\
		    enable_startup=`nvread 0.0.2 long`; \
		else \
		    echo "Cannot set default values, missing setstartup utility." ;\
		fi; \
	fi
	if [ $enable_startup -eq 1 ]; then \
		startup_file=`nvread 0.0.1 str`; \
		if [ ! -f $startup_file ]; then \
			echo "Error: unable to find the selected startup file ($startup_file)."; \
			echo "Please use CLI to setup the system startup (system->startup menu)."; \
			exit 1; \
		fi; \
	fi
else
	enable_startup=0;
fi

#
# Should we set panic --> Reboot?
#
if [ -e "/etc/config" ]; then
    . /etc/config
fi
if [ "$CONFIG_TI_LOGGER_REBOOT_ON_FATAL" == "y" ]
then
    # kernal panic should reboot
    # Value is timeout (0 does not reboot)
    sysctl -w kernel.panic=5
fi

