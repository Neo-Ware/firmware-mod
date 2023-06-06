#! /bin/sh
#

##############################################################
# this is a debug file that will enable Lan Side SNMP for Docsis
##############################################################


# Start up DOCSIS
/usr/sbin/runall -U 1 -D 1 -A 0 -g 128 -m

# Start up Voice Setup
source /etc/scripts/voice_setup.sh

# Start up PACM
source /etc/scripts/pacm_setup.sh


