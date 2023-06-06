#! /bin/sh
#

# Export PACM parameters to shell
export SPARESZ=12000

# Kill the current watchdog, and let PCD start and monitor it
    rtwd=`ps|grep watchdog_rt|grep -v grep|cut -c 1-5`

    if [ -n "$rtwd" ]; then
        kill -9 $rtwd ; \
    fi

    # Spawn PCD, start the system
    /usr/sbin/pcd -f /etc/scripts/vsdk.pcd -v -t 20 -e /nvram/pcd_error_log.txt   #ARRIS MODIFY - Removed -d (debug option)


