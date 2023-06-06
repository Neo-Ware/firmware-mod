#! /bin/sh
#

exit_failure()
{
echo -e "Please use CLI to set it up (pacm->prod submenu).\n"
# ARRIS don't return failure, as part of feature to boot into app mode with blank nvm
#echo "quit" | /usr/sbin/testmode
#/usr/sbin/pacm_init > /dev/null
#exit 1
# END ARRIS
}

# Add PACM CLI plugin
if [ -e /lib/libpacm_cli_plugin.so ] ; then
echo "/lib/libpacm_cli_plugin.so" >> /var/cli_plugins.conf
fi

# Add PACM Logger plugin
if [ -e /lib/libpacm_logger_plugin.so ] ; then
echo "/lib/libpacm_logger_plugin.so" >> /var/logger_plugins.conf
fi

# Add VOICE Logger plugin
if [ -e /lib/libvoice_logger_plugin.so ] ; then
echo "/lib/libvoice_logger_plugin.so" >> /var/logger_plugins.conf
fi

# Validity checks
if [ ! -f /nvram/2/0 ]; then \
    echo -e "\nPACM production database is not set."; \
    exit_failure; \
fi

MTANI_HWADDR="`nvread 2.0.9 str`"
if test "$MTANI_HWADDR" = '00:00:00:00:00:00' -o -z "$MTANI_HWADDR"; then \
    echo -e "\nMTA Network interface Hardware address is not set."; \
    exit_failure; \
fi

TELE_ID="`nvread 2.0.13 str`"
if test -z "$TELE_ID"; then \
    echo -e "\nSlick is not set."; \
    exit_failure; \
fi
