#!/bin/sh

/bin/echo -e "WAN STATUS:" 
if [ -e /var/tmp/wan_uptime ]; then
	/bin/echo -e "\tInternet is Connection !!"
else
	/bin/echo -e "\tInternet is Disconnected !!"
fi

/bin/echo -e "\nIFCONFIG:"
	/sbin/ifconfig

/bin/echo -e "\nBRIDGE STATUS:"
	/usr/sbin/brctl show

/bin/echo -e "\nROUTE TABLE:"
	/sbin/route -n

/bin/echo -e "\nROUTE TABLE 100:"
	/bin/ip route show table 100

/bin/echo -e "\nShow ip rule:"
	/bin/ip rule

/bin/echo -e "\nCurrent connection track:"
	/bin/cat /proc/net/ip_conntrack

/bin/echo -e "\nPROCESS:"
	/bin/ps

/bin/echo -e "\nDMESG:"
	/bin/dmesg

/bin/echo -e "\nARP TABLE:"
	/sbin/arp -n

/bin/echo -e "\nIPTABLE: (FILTER)"
	/fss/gw/sbin/iptables -L

/bin/echo -e "\nIPTABLE: (NAT)"
	/fss/gw/sbin/iptables -L -t nat

/bin/echo -e "\nMEMORY STATUS:"
	/usr/bin/free


